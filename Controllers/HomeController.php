<?php

    namespace Controllers;

    use Models\Student as Student;
    use DAO\StudentDAO as StudentDAO;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    use Helpers\UserHelper as UserHelper;

    class HomeController
    {
        private $studentDAO;
        private $careerDAO;
        private $userHelper;
        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->careerDAO = new CareerDAO();
            $this->userHelper = new UserHelper();
        }
        
        public function Index($message = "")
        {
            if($this->userHelper->isLogged())
            {
                if($this->userHelper->isAdmin()) {
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
            if($this->userHelper->isAdmin()) {
                require_once(VIEWS_PATH . "Admin/adminView.php");
            } else {
                $this->Index();
            }
        }
    }
