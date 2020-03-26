<?php

	//	Traitement du formulaire d'authentification s'il a été soumis
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

		//	Connexion de l'utilisateur
		$query = 'SELECT id, passwordhash FROM redacteurs WHERE nom = ?';
		var_dump($query);
		
		$sth = $dbh->prepare($query);
		$sth->bindValue(1, trim($_POST['pseudo']), PDO::PARAM_STR);
		$sth->execute();
		$user = $sth->fetch();
		var_dump($_POST);
		exit;

		//	S'il l'authentification est réussie…
		if($user !== false AND password_verify(trim($_POST['passwordhash']), $user['passwordhash']))
		{
			session_start();

			$_SESSION['formulaire'] = intval($user['id']);

			//	Redirection vers la page privée
			header('Location: ./profil.php');

		}
		//	Sinon…
		else
		{
			//	Redirection vers la page d'accueil
			header('Location: ./');
			exit;
		}
	}

