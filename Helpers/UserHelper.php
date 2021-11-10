<?php

    namespace Helpers;

    use Models\User as User;

    class UserHelper
    {
        public function isLogged()
        {
            if(isset($_SESSION["loggedUser"])) {
                return true;
            } else {
                return false;
            }
        }

        public function isAdmin()
        {
            if(isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getRole() == 1)) {
                return true;
            } else {
                return false;
            }
        }

        public function isStudent()
        {
            if(isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getRole() == 2)) {
                return true;
            } else {
                return false;
            }
        }
    }
