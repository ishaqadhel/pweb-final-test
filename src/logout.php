<?php

    require_once 'core/init.php';
    
    session_destroy();

    header('Location: login.php');

    error_reporting(0);

?>