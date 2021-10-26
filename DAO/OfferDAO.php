<?php

    namespace DAO;

    use Models\Offer as Offer;

    class OfferDAO implements iOfferDAO
    {
        private $connection;
        private $tableName = "offers";

        public function add(Offer $offer) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (company_id, job_position, career_id, beginning_date, ending_date) VALUES (:company_id, :job_position, :career_id, :beginning_date, :ending_date);";

                $parameters["company_id"] = $offer->getCompany();
                $parameters["job_position"] = $offer->getPosition();
                $parameters["career_id"] = $offer->getCareer();
                $parameters["beginning_date"] = $offer->getBeginningDate();
                $parameters["ending_date"] = $offer->getEndingDate();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify(Offer $offer) {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET company_id = :company_id, job_position = :job_position, career_id = :career_id, beginning_date = :beginnig_date, ending_date = :ending_date WHERE (offer_id = :offer_id);";

                $this->connection = Connection::GetInstance();

                $parameters["offer_id"] = $offer->getId();
                $parameters["company_id"] = $offer->getCompany();
                $parameters["job_position"] = $offer->getPosition();
                $parameters["career_id"] = $offer->getCareer();
                $parameters["beginning_date"] = $offer->getBeginningDate();
                $parameters["ending_date"] = $offer->getEndingDate();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function getOffer($id) {
            try {
                $parameters['offer_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (offer_id = :offer_id);";
                
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

        private function mapear($value) {
            
            $resp = array_map(function($p) {
                $offer = new Offer();
                $offer->setId($p['offer_id']);
                $offer->setCompany($p['company_id']);
                $offer->setPosition($p['job_position']);
                $offer->setCareer($p['career_id']);
                $offer->setBegnningDate($p['beginning_date']);
                $offer->setEndingDate($p['ending_date']);           

                return $offer;
            }, $value);

            return $resp;
        }
    }
