<?php
    require_once 'core/init.php';  

    /* if auth is false redirect to login */
    if ( !Session::exists('email') )
    {
        Session::flash('login', 'Anda harus Login');
        header('Location: login.php');
    }

    switch($user->getRole(Session::get('email')))
    {
        case 'admin':
            header('Location: index.php');
        default:
            header('Location: admin-index.php');
    }
?>