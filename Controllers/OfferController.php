<?php

    namespace Controllers;

    use Models\Offer as Offer;
    use DAO\OfferDAO as OfferDAO;

    use Models\Company as Company;
    use DAO\CompanyDAO as CompanyDAO;

    use Models\User as User;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    use Models\JobPosition as JobPosition;
    use DAO\JobPositionDAO as JobPositionDAO;

    class OfferController
    {
        private $offerDAO;
        private $companyDAO;
        private $careerDAO;
        private $positionDAO;

        public function __construct()
        {
            $this->offerDAO = new OfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->careerDAO = new CareerDAO();
            $this->positionDAO = new JobPositionDAO();
        }

        public function adminView()
        {
            if($this->isAdmin()) {
                require_once(VIEWS_PATH . "Admin/adminOffer.php");
            } else {
                $this->Index();
            }
        }

        public function addView()
        {
            if($this->isAdmin()) {
                $companyList = $this->companyDAO->getAll();

                if($companyList) {
                    $careerList = $this->careerDAO->getAll();

                    require_once(VIEWS_PATH . "Admin/addOffer.php");
                } else {
                    echo "<script> if(confirm('Para añadir una oferta tiene que haber empresas cargadas.')); </script>";

                    $this->adminView();
                }
            } else {
                $this->Index();
            }
        }

        public function add($company, $career, $position, $beginningDate, $endingDate)
        {
            if($this->isAdmin()) {
                $todayDate = getdate();
                $todayDate = $todayDate["year"] . "-" . $todayDate["mon"] . "-" . $todayDate["mday"];

                if($todayDate <= $beginningDate) {
                    if($beginningDate <= $endingDate) {
                        $position = $this->positionDAO->getJobPosition($position);

                        if($position->getCareer() == $career) {
                            $offer = new Offer();
                            $offer->setCompany($company);
                            $offer->setCareer($career);
                            $offer->setPosition($position->getId());
                            $offer->setBeginningDate($beginningDate);
                            $offer->setEndingDate($endingDate);
    
                            $this->offerDAO->add($offer);
    
                            echo "<script> if(confirm('Oferta agregada correctamente.')); </script>";
                            $this->addView();
                        } else {
                            echo "<script> if(confirm('Error. La posicion debe estar relacionada con la carrera seleccionada.')); </script>";
                            $this->addView();
                        }
                    } else {
                        echo "<script> if(confirm('Error. La fecha de cierre no puede ser anterior a la fecha de inicio.')); </script>";
                        $this->addView();
                    }
                    
                } else {
                    echo "<script> if(confirm('Error. La fecha de inicio no puede ser anterior a la fecha actual.')); </script>";
                    $this->addView();
                }
                
            } else {
                $this->Index();
            }
        }

        public function modify($id, $company, $career, $position, $beginningDate, $endingDate) 
        {
            if($this->isAdmin()) {
                $offer = $this->offerDAO->getOffer($id);

                if($offer) {
                    $todayDate = getdate();
                    $todayDate = $todayDate["year"] . "-" . $todayDate["mon"] . "-" . $todayDate["mday"];
    
                    if($todayDate <= $beginningDate) {
                        if($beginningDate <= $endingDate) {
                            $position = $this->positionDAO->getJobPosition($position);
    
                            if($position->getCareer() == $career) {
                                $offer = new Offer();
                                $offer->setId($id);
                                $offer->setCompany($company);
                                $offer->setCareer($career);
                                $offer->setPosition($position->getId());
                                $offer->setBeginningDate($beginningDate);
                                $offer->setEndingDate($endingDate);
        
                                $this->offerDAO->modify($offer);
        
                                echo "<script> if(confirm('Oferta modificada correctamente.')); </script>";
                                $this->list();
                            } else {
                                echo "<script> if(confirm('Error. La posicion debe estar relacionada con la carrera seleccionada.')); </script>";
                                $this->list();
                            }
                        } else {
                            echo "<script> if(confirm('Error. La fecha de cierre no puede ser anterior a la fecha de inicio.')); </script>";
                            $this->list();
                        }
                        
                    } else {
                        echo "<script> if(confirm('Error. La fecha de inicio no puede ser anterior a la fecha actual.')); </script>";
                        $this->list();
                    }
                } else {
                    echo "<script> if(confirm('No se encontró la oferta seleccionada. Por favor vuelva a intentarlo.')); </script>";
                    $this->list();
                }
            } else {
                $this->Index();
            }
        }

        public function delete($id)
        {
            if($this->isAdmin()) {
                $offer = $this->offerDAO->getOffer($id);

                if($offer) {
                    $this->offerDAO->delete($offer);

                    echo "<script> if(confirm('Oferta eliminada con exito.')); </script>";
                    $this->list();
                } else {
                    echo "<script> if(confirm('No se encontró la empresa seleccionada. Por favor vuelva a intentarlo.')); </script>";
                    $this->list();
                }
            } else {
                $this->Index();
            }
        }

        public function list()
        {
            if($this->isAdmin()) {
                $offerList = $this->offerDAO->getAll();

                if($offerList) {
                    $companyList = $this->companyDAO->getAll();
                    $careerList = $this->careerDAO->getAll();
                    
                    foreach($offerList as $offer) {
                        $company = $this->companyDAO->getCompanyById($offer->getCompany());
                        $offer->setCompany($company);
    
                        $career = $this->careerDAO->getCareer($offer->getCareer());
                        $offer->setCareer($career);
    
                        $position = $this->positionDAO->getJobPosition($offer->getPosition());
                        $offer->setPosition($position);
                    }
                    require_once(VIEWS_PATH . "Admin/listOffer.php");
                } else {
                    echo "<script> if(confirm('No hay ofertas para mostrar.')); </script>";
                    $this->adminView();
                }
                
            } else {
                $this->Index();
            }
        }

        private function Index($message = "")
        {
            if(isset($_SESSION["loggedUser"]))
            {
                require_once(VIEWS_PATH . "index.php");
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
    }
