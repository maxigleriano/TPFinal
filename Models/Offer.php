<?php

    namespace Models;

    class Offer
    {
        private $id;
        private $company;
        private $position;
        private $career;
        private $beginningDate;
        private $endingDate;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of company
         */ 
        public function getCompany()
        {
                return $this->company;
        }

        /**
         * Set the value of company
         *
         * @return  self
         */ 
        public function setCompany($company)
        {
                $this->company = $company;

                return $this;
        }

        /**
         * Get the value of position
         */ 
        public function getPosition()
        {
                return $this->position;
        }

        /**
         * Set the value of position
         *
         * @return  self
         */ 
        public function setPosition($position)
        {
                $this->position = $position;

                return $this;
        }

        /**
         * Get the value of career
         */ 
        public function getCareer()
        {
                return $this->career;
        }

        /**
         * Set the value of career
         *
         * @return  self
         */ 
        public function setCareer($career)
        {
                $this->career = $career;

                return $this;
        }

        /**
         * Get the value of beginningDate
         */ 
        public function getBeginningDate()
        {
                return $this->beginningDate;
        }

        /**
         * Set the value of beginningDate
         *
         * @return  self
         */ 
        public function setBeginningDate($beginningDate)
        {
                $this->beginningDate = $beginningDate;

                return $this;
        }

        /**
         * Get the value of endingDate
         */ 
        public function getEndingDate()
        {
                return $this->endingDate;
        }

        /**
         * Set the value of endingDate
         *
         * @return  self
         */ 
        public function setEndingDate($endingDate)
        {
                $this->endingDate = $endingDate;

                return $this;
        }
    }