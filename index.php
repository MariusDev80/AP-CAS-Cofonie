<?php
//Inclusion du controleur
include_once('autoload.php');
session_start();

	if (!isset($leControleur))
	{
		$leControleur = new controleur();
		$leControleur->afficheEntete();
	}
	// si sur la page de connexion alors acceder 
	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'connexion' && $_GET['action'] == 'connexion' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'connexion' && $_GET['action'] == 'connexion' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])) && (isset($_SESSION['role'])))
	{
		require "menu-user.php";
		$leControleur->affichePage($_GET['action'],$_GET['vue']);
	}
	else
	{
		require "menu.php";
	}
	$leControleur->affichePiedPage();
?>