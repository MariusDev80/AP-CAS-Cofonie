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
		if (isset($_GET['role']))
		{
			if($_GET['role'] != 0)
			{	$leControleur->afficheEnteteDeconnexion();
				require "menu-user.php";
			}
			else
			{	$leControleur->afficheEntete();
				require "menu.php";
			}
		}
		else
		{
			$leControleur->afficheEntete();
			require "menu.php";
		}
	}
	else
	{
		require "menu.php";
	}
	/*if ((isset($_GET['vue'])) && (isset($_GET['action'])))
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

	if ((isset($_GET['vue'])) && (isset($_GET['action'])) && (isset($_GET['role'])))
	{
		require "menu-user.php";
		$leControleur->affichePage($_GET['action'],$_GET['vue']);
	}
	else
	{
		
	}*/
	$leControleur->affichePiedPage();
?>


