<?php

    namespace Controllers;

    use Models\User as User;

    use Models\Student as Student;
    use DAO\StudentDAO as StudentDAO;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    use Helpers\UserHelper as UserHelper;

    class StudentController
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

        public function studentInfo($email) 
        {
            if($this->userHelper->isLogged()) {
                $student = $this->studentDAO->getStudent($email);
    
                if($student) {
                    $career = $this->careerDAO->getCareer($student->getCareer());
                    $student->setCareer($career);
                    
                    require_once(VIEWS_PATH . "studentInfo.php");
                } else {
                    $this->index(); 
                }
            } else {
                $this->index(); 
            }    
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
    }
