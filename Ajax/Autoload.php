<?php
    spl_autoload_register(function ($className)
    {
        $className = str_replace('\\', '/', $className);

        $fileName = dirname(__DIR__)."/".$className.".php";

        require_once($fileName);       
    });
?>