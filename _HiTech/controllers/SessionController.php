<?php
class SessionController
{
    //construteur qui vérifie l'existence de la session de l'administrateur
    function __construct() 
    {
        if(isset($_SESSION['user']))
        {
            $_SESSION['flash']['danger'] = 'Erreur';
        }
        //si la session n'existe pas --> redirige vers le form de connexion
        else
        {
            header("location:admin");
            session_destroy();
        }
    }

    public function logout()
    {
        header("location:admin");
        session_destroy();
    }
}