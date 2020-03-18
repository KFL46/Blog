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

		//	Récupération de l'utilisateur
		$query = 'SELECT id, passwordHash FROM redacteurs WHERE email = :email';
		$sth = $dbh->prepare($query);
		$sth->bindValue(':email', trim($_POST['email']), PDO::PARAM_STR);
		$sth->execute();
		$user = $sth->fetch();

		//	S'il l'authentification est réussie…
		if($user !== false AND password_verify(trim($_POST['password']), $user['passwordHash']))
		{
			session_start();

			$_SESSION['authentication'] = intval($user['id']);

			//	Redirection vers la page privée
			header('Location: ./private-page.php');
			exit;
		}
		//	Sinon…
		else
		{
			//	Redirection vers la page d'accueil
			header('Location: ./');
			exit;
		}
	}