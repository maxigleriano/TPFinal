<?php
    
    namespace Controllers;

    use Models\Postulation as Postulation;
    use DAO\PostulationDAO as PostulationDAO;

    use Models\Offer as Offer;
    use DAO\OfferDAO as OfferDAO;

    use Models\Company as Company;
    use DAO\CompanyDAO as CompanyDAO;

    use Models\JobPosition as Position;
    use DAO\JobPositionDAO as PositionDAO;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;

    use Models\Student as Student;
    use DAO\StudentDAO as StudentDAO;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    class PostulationController
    {
        private $postulationDAO;
        private $offerDAO;
        private $companyDAO;
        private $positionDAO;
        private $userDAO;
        private $studentDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->postulationDAO = new PostulationDAO();
            $this->offerDAO = new OfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->positionDAO = new PositionDAO();
            $this->userDAO = new UserDAO();
            $this->studentDAO = new StudentDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function adminView()
        {
            if($this->isAdmin()) {
                require_once(VIEWS_PATH . "Admin/adminPostulation.php");
            } else {
                $this->Index();
            }
        }

        public function addView($offerId)
        {
            if($this->isStudent()) {
                $offer = $this->offerDAO->getOffer($offerId);

                if($offer) {
                    $company = $this->companyDAO->getCompanyById($offer->getCompany());
                    $offer->setCompany($company);
    
                    $position = $this->positionDAO->getJobPosition($offer->getPosition());
                    $offer->setPosition($position);

                    require_once(VIEWS_PATH . "addPostulation.php");
                }

            } else {
                $this->Index();
            }   
        }

        public function add($offer, $curriculum, $message="")
        {
            if($this->isStudent()) {
                $user = $_SESSION["loggedUser"];
                $postulation = $this->postulationDAO->getPostulationByUser($user->getId());

                if($postulation) {
                    echo "<script> if(confirm('Este usuario ya tiene una postulacón activa.')); </script>";
                    $this->Index();
                } else {
                    $offer = $this->offerDAO->getOffer($offer);
                    $student = $this->studentDAO->getStudent($user->getEmail());

                    if($offer->getCareer() == $student->getcareer()) {
                        try {
                            $fileName = $curriculum["name"];
                            $tempFileName = $curriculum["tmp_name"];
                            $type = $curriculum["type"];
                            
                            $filePath = UPLOADS_PATH.basename($fileName);            
            
                            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            
                            $imageSize = getimagesize($tempFileName);
            
                            if($imageSize == false) {
                                if (move_uploaded_file($tempFileName, $filePath)) {
                                    $postulation = new Postulation();
                                    $postulation->setOffer($offer->getId());
                                    $postulation->setUser($_SESSION["loggedUser"]->getId());
                                    $postulation->setCurriculum($fileName);
                                    $postulation->setMessage($message);
        
                                    $this->postulationDAO->add($postulation);
            
                                    echo "<script> if(confirm('Postulación exitosa.')); </script>";
                                    $this->Index();
                                } else {
                                    echo "<script> if(confirm('Error en la subida del archivo. Por favor vuelva a intentarlo.')); </script>";
                                    $this->Index();
                                }
                            } else {
                                echo "<script> if(confirm('El formato de imagen es incorrecto. Por favor vuelva a intentarlo.')); </script>";
                                $this->Index();
                            }
                        } catch(Exception $ex) {
                            $message = $ex->getMessage();
                        }
                    } else {
                        echo "<script> if(confirm('La carrera de la oferta no coincide con la del alumno.')); </script>";
                        $this->Index();
                    }   
                }
            } else {
                $this->Index();
            } 
        } 

        public function list()
        {
            if(isset($_SESSION["loggedUser"])) {
                $postulationList = $this->postulationDAO->getAll();

                if($postulationList) {
                    foreach($postulationList as $postulation) {
                        $offer = $this->offerDAO->getOffer($postulation->getOffer());

                        $company = $this->companyDAO->getCompanyById($offer->getCompany());
                        $offer->setCompany($company);

                        $position = $this->positionDAO->getJobPosition($offer->getPosition());
                        $offer->setPosition($position);

                        $postulation->setOffer($offer);

                        $user = $this->userDAO->getUserById($postulation->getUser());
                        $student =  $this->studentDAO->getStudent($user->getEmail());
                        $postulation->setUser($student);
                    }
                    require_once(VIEWS_PATH . "listPostulation.php");
                } else {
                    echo "<script> if(confirm('No hay nada para mostrar.')); </script>";
                    $this->Index();
                }
                
            } else {
                $this->Index();
            }
        }

        public function listByOffer($offerId)
        {
            if(isset($_SESSION["loggedUser"])) {
                $postulationList = $this->postulationDAO->getPostulationByOffer($offerId);

                if($postulationList) {
                    foreach($postulationList as $postulation) {
                        $offer = $this->offerDAO->getOffer($postulation->getOffer());

                        $company = $this->companyDAO->getCompanyById($offer->getCompany());
                        $offer->setCompany($company);

                        $position = $this->positionDAO->getJobPosition($offer->getPosition());
                        $offer->setPosition($position);

                        $postulation->setOffer($offer);

                        $user = $this->userDAO->getUserById($postulation->getUser());
                        $student =  $this->studentDAO->getStudent($user->getEmail());
                        $postulation->setUser($student);
                    }
                    require_once(VIEWS_PATH . "listPostulation.php");
                } else {
                    echo "<script> if(confirm('No hay nada para mostrar.')); </script>";
                    $this->Index();
                }
                
            } else {
                $this->Index();
            }
        }

        public function listByUser($userId)
        {
            if(isset($_SESSION["loggedUser"])) {
                $postulationList = $this->postulationDAO->getPostulationByuser($userId);

                if($postulationList) {
                    foreach($postulationList as $postulation) {
                        $offer = $this->offerDAO->getOffer($postulation->getOffer());

                        $company = $this->companyDAO->getCompanyById($offer->getCompany());
                        $offer->setCompany($company);

                        $position = $this->positionDAO->getJobPosition($offer->getPosition());
                        $offer->setPosition($position);

                        $postulation->setOffer($offer);

                        $user = $this->userDAO->getUserById($postulation->getUser());
                        $student =  $this->studentDAO->getStudent($user->getEmail());
                        $postulation->setUser($student);
                    }
                    require_once(VIEWS_PATH . "listPostulation.php");
                } else {
                    echo "<script> if(confirm('No hay nada para mostrar.')); </script>";
                    $this->Index();
                }
                
            } else {
                $this->Index();
            }
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

        private function isAdmin()
        {
            if(isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getRole() == 1)) {
                return true;
            } else {
                return false;
            }
        }   

        private function isStudent()
        {
            if(isset($_SESSION["student"])) {
                return true;
            } else {
                return false;
            }
        }  
    }