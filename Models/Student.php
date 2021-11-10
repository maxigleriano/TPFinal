<?php

    namespace Models;

    use Models\User as User;

    class Student extends User 
    {
        private $studentId;
        private $career;
        private $dni;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $active;
        private $phoneNumber;

        /**
         * Get the value of studentId
         */ 
        public function getStudentId()
        {
                return $this->studentId;
        }

        /**
         * Set the value of studentId
         *
         * @return  self
         */ 
        public function setStudentId($studentId)
        {
                $this->studentId = $studentId;

                return $this;
        }

        /**
         * Get the value of careerId
         */ 
        public function getCareer()
        {
                return $this->career;
        }

        /**
         * Set the value of careerId
         *
         * @return  self
         */ 
        public function setCareer($career)
        {
                $this->career = $career;

                return $this;
        }

        /**
         * Get the value of dni
         */ 
        public function getDni()
        {
                return $this->dni;
        }

        /**
         * Set the value of dni
         *
         * @return  self
         */ 
        public function setDni($dni)
        {
                $this->dni = $dni;

                return $this;
        }

        /**
         * Get the value of fileNumber
         */ 
        public function getFileNumber()
        {
                return $this->fileNumber;
        }

        /**
         * Set the value of fileNumber
         *
         * @return  self
         */ 
        public function setFileNumber($fileNumber)
        {
                $this->fileNumber = $fileNumber;

                return $this;
        }

        /**
         * Get the value of gender
         */ 
        public function getGender()
        {
                return $this->gender;
        }

        /**
         * Set the value of gender
         *
         * @return  self
         */ 
        public function setGender($gender)
        {
                $this->gender = $gender;

                return $this;
        }

        /**
         * Get the value of birthDate
         */ 
        public function getBirthDate()
        {
                return $this->birthDate;
        }

        /**
         * Set the value of birthDate
         *
         * @return  self
         */ 
        public function setBirthDate($birthDate)
        {
                $this->birthDate = $birthDate;

                return $this;
        }

        /**
         * Get the value of active
         */ 
        public function getActive()
        {
                return $this->active;
        }

        /**
         * Set the value of active
         *
         * @return  self
         */ 
        public function setActive($active)
        {
                $this->active = $active;

                return $this;
        }

        /**
         * Get the value of phoneNumber
         */ 
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        /**
         * Set the value of phoneNumber
         *
         * @return  self
         */ 
        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }
    }
