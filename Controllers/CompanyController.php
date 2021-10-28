<?php

    namespace Controllers;

    use Models\Company as Company;
    use DAO\CompanyDAO as CompanyDAO;

    use Models\User as User;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
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
            if($this->isAdmin()) {
                $companyList = $this->companyDAO->getAll();

                if($companyList) {
                    require_once(VIEWS_PATH . "Admin/listCompany.php");
                } else {
                    echo "<script> if(confirm('No hay empresas para mostrar.')); </script>";
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
