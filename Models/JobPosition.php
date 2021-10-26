<?php

    namespace Models;

    class JobPosition
    {
        private $id;
        private $career;
        private $description;

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
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }
    }