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

		//	Ajout de l'utilisateur
		$query = 'INSERT INTO redacteurs (nom, passwordhash) VALUES (?, ?)';
		$sth = $dbh->prepare($query);
		$sth->bindValue(1, trim($_POST['pseudo']), PDO::PARAM_STR);
		$sth->bindValue(2, password_hash(trim($_POST['passwordhash']), PASSWORD_BCRYPT), PDO::PARAM_STR);
		$sth->execute();
	}
	

	//	Redirection vers la page d'accueil
	header('Location:./').
	exit;