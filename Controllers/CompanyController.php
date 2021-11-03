<?php

    namespace Controllers;

    use Models\Company as Company;
    use DAO\CompanyDAO as CompanyDAO;

    use Models\User as User;

    use Models\Student as Student;
    use DAO\StudentDAO as StudentDAO;

    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;

    class CompanyController
    {
        private $companyDAO;
        private $careerDAO;
        private $studentDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
            $this->careerDAO = new CareerDAO();
            $this->studentDAO = new StudentDAO();
        }

        public function adminVIew()
        {
            if($this->isAdmin()) {
                require_once(VIEWS_PATH . "Admin/adminCompany.php");
            } else {
                $this->Index();
            }
        }

        public function addVIew()
        {
            if($this->isAdmin()) {
                require_once(VIEWS_PATH . "Admin/addCompany.php");
            } else {
                $this->Index();
            }
        }

        public function add($name, $city, $address, $email, $phoneNumber, $cuit)
        {
            if($this->isAdmin()) {
                $company = $this->companyDAO->getCompany($email);

                if($company) {
                    echo "<script> if(confirm('El email ya esta registrado. Por favor vuelva a intentarlo.')); </script>";

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
            if($this->isAdmin()) {
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
            if($this->isAdmin()) {
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
            if(isset($_SESSION["loggedUser"])) {
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

         
    }
