<?php
// Détruire la session
session_start();
session_destroy();

// Rediriger vers la page d'accueil
header("Location: index.php");
exit();
?>