<?php

    namespace Ajax;

    require "Autoload.php";

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    use Models\JobPosition as JobPosition;
    use DAO\JobPositionDAO as JobPositionDAO;

    define("API_KEY", "4f3bceed-50ba-4461-a910-518598664c08");

    if(isset($_POST["career"]) && !empty($_POST["career"])) {
        $careerId = $_POST["career"];

        $careerDAO = new CareerDAO();
        $positionDAO = new JobPositionDAO();

        $career = $careerDAO->getCareer($careerId);
        $positionList = $positionDAO->getJobPositionsByCareer($careerId);

        $html = "<option value=''>Seleccione una</option>";

        foreach($positionList as $position) {
            $id = $position->getId();
            $desc = $position->getDescription();
            $html = $html . "<option value='$id'>$desc</option>";
        }
        
        echo $html;
    }
    
?>