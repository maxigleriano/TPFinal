<?php

    namespace DAO;

    use Models\Student as Student;

    class StudentDAO
    {
        private $studentList = array();
        private $url;

        public function __construct()
        {
            $this->url = 'https://utn-students-api.herokuapp.com/api/Student';
        }

        public function getAll()
        {
            $this->retrieveData();

            return $this->studentList;
        }

        public function getStudent($email)
        {
            $this->retrieveData();

            foreach($this->studentList as $student) {
                if($student->getEmail() == $email) {
                    
                    return $student;
                }
            }

            return null;
        }


        private function retrieveData()
        {
            $this->studentList = array();

            $httpheader = ['x-api-key: ' . API_KEY];

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $this->url); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

            $result = curl_exec($curl); 

            curl_close($curl);

            $arrayToDecode = ($result) ? json_decode($result, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $student = new Student();
                $student->setStudentId($valuesArray["studentId"]);
                $student->setCareer($valuesArray["careerId"]);
                $student->setName($valuesArray["firstName"]);
                $student->setLastName($valuesArray["lastName"]);
                $student->setDni($valuesArray["dni"]);
                $student->setFileNumber($valuesArray["fileNumber"]);
                $student->setGender($valuesArray["gender"]);
                $student->setBirthDate(date("d/m/Y", strtotime($valuesArray["birthDate"])));
                $student->setPhoneNumber($valuesArray["phoneNumber"]);
                $student->setActive($valuesArray["active"]);
                $student->setEmail($valuesArray["email"]);

                array_push($this->studentList, $student);
            }
        }
    }
