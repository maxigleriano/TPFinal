<?php

    namespace DAO;

    use Models\Career as Career;

    class CareerDAO
    {
        private $careerList = array();
        private $url;

        public function __construct()
        {
            $this->url = 'https://utn-students-api.herokuapp.com/api/Career';
        }

        public function getAll()
        {
            $this->retrieveData();

            return $this->careerList;
        }

        public function getCareer($id)
        {
            $this->retrieveData();

            foreach($this->careerList as $career) {
                if($career->getId() == $id) {

                    return $career;
                }
            }

            return null;
        }


        private function retrieveData()
        {
            $this->careerList = array();

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
                $career = new Career();
                $career->setId($valuesArray["careerId"]);
                $career->setDescription($valuesArray["description"]);
                $career->setActive($valuesArray["active"]);

                array_push($this->careerList, $career);
            }
        }
    }
