<?php
session_start();
include('controleur.php');

	if (!isset($leControleur))
	{
		$leControleur = new controleur();
		$leControleur->afficheEntete();
	}
	
	if ((isset($_GET['vue'])) && (isset($_GET['action'])))
	{
		require "menu.php";
		$leControleur->affichePage($_GET['action'],$_GET['vue']);
	}
	else
	{
		require "menu.php";
	}
	
	//if (!isset($monControleur))
	//{
		$leControleur->affichePiedPage();
	//}
?>