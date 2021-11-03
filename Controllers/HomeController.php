<?php

    namespace Controllers;

    use Models\Student as Student;
    use DAO\StudentDAO as StudentDAO;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    class HomeController
    {
        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->careerDAO = new CareerDAO();
        }
        
        public function Index($message = "")
        {
            if(isset($_SESSION["loggedUser"]))
            {
                if($_SESSION["loggedUser"]->getRole() == 1) {
                    require_once(VIEWS_PATH . "Admin/adminView.php");
                } else {
                    $student = $this->studentDAO->getStudent($_SESSION["loggedUser"]->getEmail());
    
                    $career = $this->careerDAO->getCareer($student->getCareer());
                    $student->setCareer($career);
                        
                    require_once(VIEWS_PATH . "studentInfo.php");
                }
            } else {
                require_once(VIEWS_PATH . "login.php");
            }
        }   
        
        public function adminView() 
        {
            if(isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getRole() == 1)) {
                require_once(VIEWS_PATH . "Admin/adminView.php");
            } else {
                $this->Index();
            }
        }
    }
