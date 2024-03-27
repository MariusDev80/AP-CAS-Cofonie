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

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'signup' && $_GET['action'] == 'signup' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'signup' && $_GET['action'] == 'signup' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'afficherUtilisateurs' && $_GET['action'] == 'afficherUtilisateurs' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'afficherUtilisateurs' && $_GET['action'] == 'afficherUtilisateurs' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'texte' && $_GET['action'] == 'texte' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'texte' && $_GET['action'] == 'texte' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'amendement' && $_GET['action'] == 'amendement' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'amendement' && $_GET['action'] == 'amendement' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'institution' && $_GET['action'] == 'institution' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'institution' && $_GET['action'] == 'institution' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'organe' && $_GET['action'] == 'organe' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'organe' && $_GET['action'] == 'organe' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'role' && $_GET['action'] == 'role' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'role' && $_GET['action'] == 'role' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'avancement' && $_GET['action'] == 'avancement' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'avancement' && $_GET['action'] == 'avancement' && (isset($_GET['role'])))
		{	
			require "menu-user.php";
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
	}

	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		if ($_GET['vue'] == 'modifRole' && $_GET['action'] == 'modifRole' && (!isset($_GET['role'])))
		{
			$leControleur->affichePage($_GET['action'],$_GET['vue']);
		}
		if ($_GET['vue'] == 'modifRole' && $_GET['action'] == 'modifRole' && (isset($_GET['role'])))
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