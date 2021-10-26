<?php 

    namespace DAO;

    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO 
    {
        private $connection;
        private $tableName = "users";

        public function add(User $user) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (user_role, user_name, user_last_name, user_email, user_password, user_phone) VALUES (:user_role, :user_name, :user_last_name, :user_email, :user_password, :user_phone);";

                $parameters["user_role"] = $user->getRole();
                $parameters["user_name"] = $user->getName();
                $parameters["user_last_name"] = $user->getLastName();
                $parameters["user_email"] = $user->getEmail();
                $parameters["user_password"] = $user->getPass();
                $parameters["user_phone"] = $user->getPhoneNumber();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify(User $user) {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET user_name = :user_name, user_last_name = :user_last_name, user_email = :user_email, user_password = :user_password, user_phone = :user_phone WHERE (user_id = :user_id);";

                $this->connection = Connection::GetInstance();

                $parameters["user_id"] = $user->getId();
                $parameters["user_name"] = $user->getName();
                $parameters["user_last_name"] = $user->getLastName();
                $parameters["user_email"] = $user->getEmail();
                $parameters["user_password"] = $user->getPass();
                $parameters["user_phone"] = $user->getPhoneNumber();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function getUser($email) {
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

        public function getUserById($id) {
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
                $user = new User();
                $user->setId($p['user_id']);
                $user->setRole($p['user_role']);
                $user->setName($p['user_name']);
                $user->setLastName($p['user_last_name']);
                $user->setEmail($p['user_email']);
                $user->setPass($p['user_password']);
                $user->setPhoneNumber($p['user_phone']);
                

                return $user;
            }, $value);

            return $resp;
        }
    }
