<?php

    namespace DAO;

    use Models\Postulation as Postulation;

    class PostulationDAO implements iPostulationDAO
    {
        private $connection;
        private $tableName = "postulations";

        public function add(Postulation $postulation) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (user_id, offer_id, user_curriculum, user_message) VALUES (:user_id, :offer_id, :user_curriculum, :user_message);";

                $parameters["user_id"]= $postulation->getUser();
                $parameters["offer_id"]= $postulation->getOffer();
                $parameters["user_curriculum"]= $postulation->getCurriculum();
                $parameters["user_message"]= $postulation->getMessage();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete(Postulation $postulation)
        {
            try 
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE (postulation_id = :postulation_id);";

                $this->connection = Connection::GetInstance();

                $parameters['postulation_id'] = $postulation->getId();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function getPostulation($id) {
            try {
                $parameters['postulation_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (postulation_id = :postulation_id);";
                
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

        public function getPostulationByUser($userId) {
            try {
                $parameters['user_id'] = $userId;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (user_id = :user_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet;
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getPostulationByOffer($offerId) {
            try {
                $parameters['offer_id'] = $offerId;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (offer_id = :offer_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet;
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
                $postulation = new Postulation();
                $postulation->setId($p['postulation_id']);
                $postulation->setUser($p['user_id']);
                $postulation->setOffer($p['offer_id']);
                $postulation->setCurriculum($p['user_curriculum']);
                $postulation->setMessage($p['user_message']);         

                return $postulation;
            }, $value);

            return $resp;
        }
    }
