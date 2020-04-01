<?php

session_start();

//	ajout d'un article
if(!array_key_exists('formulaire', $_SESSION))
{
    //	Redirection vers la page d'accueil
    header('Location: ./');
    exit;
}


//	Inclusion du HTML
include 'profil.phtml';

