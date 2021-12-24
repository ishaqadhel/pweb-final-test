<?php
    require_once 'core/init.php';  

    /* if auth is false redirect to login */
    if ( !Session::exists('email') )
    {
        Session::flash('login', 'Anda harus Login');
        header('Location: login.php');
    }

    echo "Your are running PHP with Docker.";
?>