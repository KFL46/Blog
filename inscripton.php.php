<?php

	//	Traitement du formulaire d'inscription s'il a été soumis
	if(!empty($_POST))
	{
		//	Connexion à la base de données
		$dbh = new PDO
		(
			'mysql:host=localhost;dbname=Authentication;charset=utf8',
			'root',
			'',
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]
		);

		//	Ajout de l'utilisateur
		$query = 'INSERT INTO Users (email, passwordHash) VALUES (:email, :passwordHash)';
		$sth = $dbh->prepare($query);
		$sth->bindValue(':email', trim($_POST['email']), PDO::PARAM_STR);
		$sth->bindValue(':passwordHash', password_hash(trim($_POST['password']), PASSWORD_BCRYPT), PDO::PARAM_STR);
		$sth->execute();
	}

	//	Redirection vers la page d'accueil
	header('Location: ./');
	exit;