<?php 

    namespace DAO;

    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO implements iUserDAO
    {
        private $connection;
        private $tableName = "users";

        public function add(User $user) 
        {
            try {
                $query = "INSERT INTO " . $this->tableName . " (user_role, user_name, user_last_name, user_email, user_password) VALUES (:user_role, :user_name, :user_last_name, :user_email, :user_password);";

                $parameters["user_role"] = $user->getRole();
                $parameters["user_name"] = $user->getName();
                $parameters["user_last_name"] = $user->getLastName();
                $parameters["user_email"] = $user->getEmail();
                $parameters["user_password"] = $user->getPass();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getUser($email) 
        {
            try {
                $parameters['user_email'] = $email;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (user_email = :user_email);";
                
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

        public function getUserById($id) 
        {
            try {
                $parameters['user_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (user_id = :user_id);";
                
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
                $user = new User();
                $user->setId($p['user_id']);
                $user->setRole($p['user_role']);
                $user->setName($p['user_name']);
                $user->setLastName($p['user_last_name']);
                $user->setEmail($p['user_email']);
                $user->setPass($p['user_password']);

                return $user;
            }, $value);

            return $resp;
        }
    }
