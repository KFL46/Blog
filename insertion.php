<?php
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
    var_dump($_POST);
    session_start();

    //	Ajout de l'utilisateur
    $query = 'INSERT INTO articles (titre, corps, idredacteur) VALUES (?, ?, ?)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(1, trim($_POST['titre']), PDO::PARAM_STR);
    $sth->bindValue(2, trim($_POST['corps']), PDO::PARAM_STR);
    $sth->bindValue(3, trim($_SESSION['formulaire']));
    var_dump($_SESSION);
    $sth->execute();

    var_dump($sth);
}
