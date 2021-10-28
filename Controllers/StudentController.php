<?php

    namespace Controllers;

    use Models\User as User;

    use Models\Student as Student;
    use DAO\StudentDAO as StudentDAO;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    class StudentController
    {
        private $studentDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function studentInfo() 
        {
            if(isset($_SESSION["loggedUser"])) {
                $email = $_SESSION["loggedUser"]->getEmail();
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
            if(isset($_SESSION["loggedUser"]))
            {
                require_once(VIEWS_PATH . "index.php");
            } else {
                require_once(VIEWS_PATH . "login.php");
            }
        }   
    }
