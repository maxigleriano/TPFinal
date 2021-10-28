<?php 

    namespace DAO;

    use Models\Company as Company;
    use DAO\Connection as Connection;

    class CompanyDAO implements iCompanyDAO
    {
        private $connection;
        private $tableName = "companies";

        public function add(Company $company) 
        {
            try {
                $query = "INSERT INTO " . $this->tableName . " (company_name, company_city, company_address, company_email, company_phone, company_cuit) VALUES (:company_name, :company_city, :company_address, :company_email, :company_phone, :company_cuit);";

                $parameters["company_name"] = $company->getName();
                $parameters["company_city"] = $company->getCity();
                $parameters["company_address"] = $company->getAddress();
                $parameters["company_email"] = $company->getEmail();
                $parameters["company_phone"] = $company->getPhoneNumber();
                $parameters["company_cuit"] = $company->getCuit();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify(Company $company)
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET company_name = :company_name, company_city = :company_city, company_address = :company_address, company_email = :company_email, company_phone = :company_phone, company_cuit = :company_cuit WHERE (company_id = :company_id);";

                $this->connection = Connection::GetInstance();

                $parameters["company_id"] = $company->getId();
                $parameters["company_name"] = $company->getName();
                $parameters["company_city"] = $company->getCity();
                $parameters["company_address"] = $company->getAddress();
                $parameters["company_email"] = $company->getEmail();
                $parameters["company_phone"] = $company->getPhoneNumber();
                $parameters["company_cuit"] = $company->getCuit();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function delete(Company $company)
        {
            try 
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE (company_id = :company_id);";

                $this->connection = Connection::GetInstance();

                $parameters['company_id'] = $company->getId();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function getCompany($email) 
        {
            try {
                $parameters['company_email'] = $email;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (company_email = :company_email);";
                
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

        public function getCompanyById($id) 
        {
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

        public function getAll() 
        {
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

        private function mapear($value) 
        {
            $resp = array_map(function($p) {
                $company = new Company();
                $company->setId($p['company_id']);
                $company->setName($p['company_name']);
                $company->setCity($p['company_city']);
                $company->setAddress($p['company_address']);
                $company->setEmail($p['company_email']);
                $company->setPhoneNumber($p['company_phone']);
                $company->setCuit($p['company_cuit']);

                return $company;
            }, $value);

            return $resp;
        }
    }
