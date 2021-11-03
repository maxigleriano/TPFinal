<?php

    namespace Models;

    class Postulation
    {
        private $id;
        private $user;
        private $offer;
        private $curriculum;
        private $message;

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
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        /**
         * Get the value of offer
         */ 
        public function getOffer()
        {
                return $this->offer;
        }

        /**
         * Set the value of offer
         *
         * @return  self
         */ 
        public function setOffer($offer)
        {
                $this->offer = $offer;

                return $this;
        }

        /**
         * Get the value of curriculum
         */ 
        public function getCurriculum()
        {
                return $this->curriculum;
        }

        /**
         * Set the value of curriculum
         *
         * @return  self
         */ 
        public function setCurriculum($curriculum)
        {
                $this->curriculum = $curriculum;

                return $this;
        }

        /**
         * Get the value of message
         */ 
        public function getMessage()
        {
                return $this->message;
        }

        /**
         * Set the value of message
         *
         * @return  self
         */ 
        public function setMessage($message)
        {
                $this->message = $message;

                return $this;
        }
    }