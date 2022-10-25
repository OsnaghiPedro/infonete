<?php

class Session{


    public function __construct()
    {

        if(session_status() == PHP_SESSION_NONE)
            session_start();
    }

    public function setAuthUser($user){
        $_SESSION['user'] = $user;
    }

    public function getAuthUser(){
        return $_SESSION['user'] ?? false;
    }

    public function setParameter($key, $value){
        $_SESSION[$key] = $value;
    }

    public function getParameter($key){
        return $_SESSION[$key];
    }


    public function closeSession(){
        session_unset();
        session_destroy();
    }
    
}