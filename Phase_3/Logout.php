<?php
session_start();

// On vide toutes les variables de session en cours
$_SESSION = array();

session_destroy();

// On redirige automatiquement le visiteur vers l'accueil
header("Location: Accueil.php");
exit();
?>
