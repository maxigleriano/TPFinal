<?php

    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;

    use Models\Student as Student;
    use DAO\StudentDAO as StudentDAO;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    class UserController
    {
        private $userDAO;
        private $studentDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->studentDAO = new StudentDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function login($email, $pass)
        {
            $user = $this->userDAO->getUser($email);

            if($user)
            {
                if($user->getEmail() == $email && password_verify($pass, $user->getPass()))
                {
                    if($user->getRole() == 1)
                    {
                        $_SESSION["loggedUser"] = $user;
                        $this->index();
                    }
                    else
                    {
                        $student = $this->studentDAO->getStudent($email);                    

                        if($student->getActive())
                        {
                            $_SESSION["loggedUser"] = $user;
                            $_SESSION["student"] = $student;
                            $this->index();
                        }
                        else
                        {
                            echo "<script> if(confirm('Este estudiante ya no se encuentra activo en nuestro sistema.')); </script>";
                            $this->loginView();
                        }
                    }                    
                }
                else
                {
                    echo "<script> if(confirm('Email o contreña incorrectas. Por favor vuelva a intentarlo.')); </script>";
                    $this->loginView();
                }
            }
            else
            {
                echo "<script> if(confirm('Email o contreña incorrectas. Por favor vuelva a intentarlo.')); </script>";
                $this->loginView();
            }
        }

        public function signup()
        {
            require_once(VIEWS_PATH."signup.php");
        }

        private function add(User $user) 
        {
            $this->userDAO->add($user);
        }

        public function addNewUser($email, $pass1, $pass2, $role=2)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(!$this->userDAO->getUser($email)) {                   
                    if($pass1 == $pass2) {
                        if($role == 2) {
                            $student = $this->studentDAO->getStudent($email);
    
                            if($student && $student->getActive()) {
                                $user = new User();
                                $user->setEmail($email);
                                $user->setPass(password_hash($pass1, PASSWORD_DEFAULT));
                                $user->setRole($role);
                                $user->setName($student->getName());
                                $user->setLastName($student->getLastName());
                                $user->setPhoneNumber($student->getPhoneNumber());
            
                                $this->userDAO->add($user);
        
                                echo "<script> if(confirm('Usuario registrado correctamente.')); </script>";  
                            
                                $this->Index();
        
                            } else {
                                echo "<script> if(confirm('El email no corresponde con ningun estudiante o no se encuentra activo. Por favor vuelva a intentarlo.')); </script>"; 
                                $this->signup();  
                            }
                        } else {
                            $user = new User();
                            $user->setEmail($email);
                            $user->setPass(password_hash($pass1, PASSWORD_DEFAULT));
                            $user->setRole($role);
                            $user->setName("");
                            $user->setLastName("");
                            $user->setPhoneNumber("");
        
                            $this->userDAO->add($user);
    
                            echo "<script> if(confirm('Usuario registrado correctamente.')); </script>";  
                        
                            $this->Index();
                        }   
                    } else {
                        echo "<script> if(confirm('Las contraseñas no coinciden. Por favor vuelva a intentarlo.')); </script>"; 
                        $this->signup(); 
                    }
                } else {
                    echo "<script> if(confirm('Este mail ya esta registrado. Por favor vuelva a intentarlo.')); </script>"; 
                    $this->signup();  
                }
            } else {
                echo "<script> if(confirm('Formato de email incorrecto. Por favor vuelva a intentarlo.')); </script>"; 
                $this->signup();   
            }
            
        }

        public function logout()
        {
            unset($_SESSION["loggedUser"]);

            $this->loginView();
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

        public function loginView()
        {
            require_once(VIEWS_PATH . "login.php");
        } 

        private function isAdmin()
        {
            if(isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getRole() == 1)) {
                return true;
            } else {
                return false;
            }
        }   
    }
