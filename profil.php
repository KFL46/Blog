<?php

session_start();

//	ajout d'un article
if(!array_key_exists('formulaire', $_SESSION))
{
    //	Redirection vers la page d'accueil
    header('Location: ./');
    exit;
}
//	Traitement du formulaire d'inscription s'il a été soumis
if(!empty($_POST))
{
//	Connexion à la base de données
    $dbh = new PDO
    (
        'mysql:host=localhost;dbname=formulaire;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    //	Ajout de l'utilisateur
    $query = 'INSERT INTO articles (titre, "text"; idredacteur) VALUES (?, ?, ?)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(1, trim($_POST['titre']), PDO::PARAM_STR);
    $sth->bindValue(2, trim($_POST['text']), PDO::PARAM_STR);
    $sth->bindValue(3, trim($_POST['idredacteur']), PDO::PARAM_STR);

    $sth->execute();
}


//	Redirection vers la page d'accueil
header('Location:./').
exit;


//	Inclusion du HTML
include 'profil.phtml';

