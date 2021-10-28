<?php

    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            if(isset($_SESSION["loggedUser"]))
            {
                require_once(VIEWS_PATH . "index.php");
            } else {
                require_once(VIEWS_PATH . "login.php");
            }
        }   
        
        public function adminView() 
        {
            if(isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getRole() == 1)) {
                require_once(VIEWS_PATH . "Admin/adminView.php");
            } else {
                $this->Index();
            }
        }
    }
