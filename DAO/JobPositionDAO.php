<?php

    namespace DAO;

    use Models\JobPosition as JobPosition;

    class JobPositionDAO implements iJobPositionDAO
    {
        private $jobPositionList = array();
        private $url;

        public function __construct()
        {
            $this->url = 'https://utn-students-api.herokuapp.com/api/JobPosition';
        }

        public function getAll()
        {
            $this->retrieveData();

            return $this->jobPositionList;
        }

        public function getJobPosition($id)
        {
            $this->retrieveData();

            foreach($this->jobPositionList as $jobPosition) {
                if($jobPosition->getId() == $id) {

                    return $jobPosition;
                }
            }

            return null;
        }

        public function getJobPositionsByCareer($career)
        {
            $this->retrieveData();

            $result = array();

            foreach($this->jobPositionList as $jobPosition) {
                if($jobPosition->getCareer() == $career) {

                    array_push($result, $jobPosition);
                }
            }

            return $result;
        }


        private function retrieveData()
        {
            $this->jobPositionList = array();

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
                $jobPosition = new JobPosition();
                $jobPosition->setId($valuesArray["jobPositionId"]);
                $jobPosition->setCareer($valuesArray["careerId"]);
                $jobPosition->setDescription($valuesArray["description"]);

                array_push($this->jobPositionList, $jobPosition);
            }
        }
    }
