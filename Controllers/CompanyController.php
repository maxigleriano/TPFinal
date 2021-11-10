<?php

    namespace Controllers;

    use Models\Company as Company;
    use DAO\CompanyDAO as CompanyDAO;

    use Models\User as User;

    use Models\Student as Student;
    use DAO\StudentDAO as StudentDAO;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    use Helpers\UserHelper as UserHelper;

    class CompanyController
    {
        private $companyDAO;
        private $careerDAO;
        private $studentDAO;
        private $userHelper;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
            $this->careerDAO = new CareerDAO();
            $this->studentDAO = new StudentDAO();
            $this->userHelper = new UserHelper();
        }

        public function adminVIew()
        {
            if($this->userHelper->isAdmin()) {
                require_once(VIEWS_PATH . "Admin/adminCompany.php");
            } else {
                $this->Index();
            }
        }

        public function addVIew()
        {
            if($this->userHelper->isAdmin()) {
                require_once(VIEWS_PATH . "Admin/addCompany.php");
            } else {
                $this->Index();
            }
        }

        public function add($name, $city, $address, $email, $phoneNumber, $cuit)
        {
            if($this->userHelper->isAdmin()) {
                $findEmail = $this->companyDAO->getCompany($email);
                $findName = $this->companyDAO->getCompanyByName($name);
                $findCuit = $this->companyDAO->getCompanyByCuit($cuit);

                if($findEmail || $findName || $findCuit) {
                    echo "<script> if(confirm('Eesta empresa ya está registrada. Por favor vuelva a intentarlo.')); </script>";

                    $this->addVIew();
                } else {
                    $company = new Company();
                    $company->setName($name);
                    $company->setCity($city);
                    $company->setAddress($address);
                    $company->setEmail($email);
                    $company->setPhoneNumber($phoneNumber);
                    $company->setCuit($cuit);

                    $this->companyDAO->add($company);

                    echo "<script> if(confirm('Empresa agregada correctamente.')); </script>";
                    $this->addVIew();
                }

            } else {
                $this->Index();
            }
        }

        public function modify($id, $name, $city, $address, $email, $phoneNumber, $cuit) 
        {
            if($this->userHelper->isAdmin()) {
                $company = $this->companyDAO->getCompanyById($id);

                if($company) {
                    $newCompany = new Company();
                    $newCompany->setId((int)$id);
                    $newCompany->setName($name);
                    $newCompany->setCity($city);
                    $newCompany->setAddress($address);
                    $newCompany->setEmail($email);
                    $newCompany->setPhoneNumber($phoneNumber);
                    $newCompany->setCuit($cuit);

                    $this->companyDAO->modify($newCompany);

                    echo "<script> if(confirm('Empresa modificada correctamente.')); </script>";
                    $this->list();
                } else {
                    echo "<script> if(confirm('No se encontró la empresa seleccionada. Por favor vuelva a intentarlo.')); </script>";
                    $this->list();
                }
            } else {
                $this->Index();
            }
        }

        public function delete($id)
        {
            if($this->userHelper->isAdmin()) {
                $company = $this->companyDAO->getCompanyById($id);

                if($company) {
                    $this->companyDAO->delete($company);

                    echo "<script> if(confirm('Empresa eliminada con exito.')); </script>";
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
            if($this->userHelper->isLogged()) {
                $companyList = $this->companyDAO->getAll();

                if($companyList) {
                    require_once(VIEWS_PATH . "listCompany.php");
                } else {
                    echo "<script> if(confirm('No hay empresas para mostrar.')); </script>";
                    $this->Index();
                }
                
            } else {
                $this->Index();
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
