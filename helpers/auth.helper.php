<?php



class AuthHelper {


    public function __construct() {
    }


    public function login($user) {
        // INICIO LA SESSION Y LOGUEO AL USUARIO
        session_start();
        $_SESSION['ID_USER'] = $user->id_users;
        $_SESSION['USERNAME'] = $user->email;

    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function checkLoggedIn() {
       session_start();
        if (!isset($_SESSION['ID_USER'])) {
            $logged = false;
        }
        else if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {  
            $this->logout(); // cierra la sesión tras 10 minutos.
        } 
        else {
            $logged = true;
        } 
        
        $_SESSION['LAST_ACTIVITY'] = time();

        return $logged;
    }

 }    