<?php 

    namespace DAO;

    use Models\Company as Company;
    use DAO\Connection as Connection;

    class CompanyDAO 
    {
        private $connection;
        private $tableName = "Companies";

        public function add(Company $company) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (company_name, company_city, company_address, company_email, company_phone, company_cuit, company_description) VALUES (:company_name, :company_city, :company_address, :company_email, :company_phone, :company_cuit, :company_description);";

                $parameters["company_name"] = $company->getName();
                $parameters["company_city"] = $company->getCity();
                $parameters["company_address"] = $company->getAddress();
                $parameters["company_email"] = $company->getEmail();
                $parameters["company_phone"] = $company->getPhoneNumber();
                $parameters["company_cuit"] = $company->getCuit();
                $parameters["company_description"] = $company->getDescription();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify(Company $company) {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET company_name = :company_name, company_city = :company_city, company_address = :company_address, company_email = :company_email, company_cuit = :company_cuit, company_description = :company_description WHERE (company_id = :company_id);";

                $this->connection = Connection::GetInstance();

                $parameters["company_id"] = $company->getId();
                $parameters["company_name"] = $company->getName();
                $parameters["company_city"] = $company->getCity();
                $parameters["company_address"] = $company->getAddress();
                $parameters["company_email"] = $company->getEmail();
                $parameters["company_phone"] = $company->getPhoneNumber();
                $parameters["company_cuit"] = $company->getCuit();
                $parameters["company_description"] = $company->getDescription();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function getCompany($id) {
            try {
                $parameters['company_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (company_id = :company_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet[0];
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getAll() {
            try {
                $query = "SELECT * FROM " . $this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  false;

            }
            
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function mapear($value) {
            
            $resp = array_map(function($p) {
                $company = new Company();
                $company->setId($p['company_id']);
                $company->setName($p['company_name']);
                $company->setCity($p['company_city']);
                $company->setAddress($p['company_address']);
                $company->setEmail($p['company_email']);
                $company->setPhoneNumber($p['company_phone']);
                $company->setCuit($p['company_cuit']);
                $company->setDescription($p['company_description']);
                

                return $company;
            }, $value);

            return $resp;
        }
    }
