<?php

	session_start();

	//	Si l'utilisateur n'est pas authentifié
	if(!array_key_exists('authentication', $_SESSION))
	{
		//	Redirection vers la page d'accueil
		header('Location: ./');
		exit;
	}

	//	Inclusion du HTML
	include 'page-privee.phtml';