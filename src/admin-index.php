<?php
    require_once 'core/init.php';  

    /* if auth is false redirect to login */
    if ( !Session::exists('email') )
    {
        Session::flash('login', 'Anda harus Login');
        header('Location: login.php');
    }

    if ( $user->getRole(Session::get('email')) != 'admin' )
    {
        header('Location: index.php');
    }

    echo "admin page";
?>