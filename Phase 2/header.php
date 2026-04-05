<?php 
if(session_status() === PHP_SESSION_NONE){  
session_start();
}
include_once('fonctions.php'); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mosaïque Yum - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="navbar">
        <a href="Accueil.php">
            <img src="images/logo.png" alt="Logo Mosaïque" class="logo-img">
        </a>
        <nav>
    <ul class="nav-links">
        <li><a href="Accueil.php">ACCUEIL</a></li>
        <li><a href="Carte.php">LA CARTE</a></li>

        <?php 
        // Si la personne N'EST PAS connectée
        if (!isset($_SESSION['role'])) : 
        ?>
            <li><a href="Login.php">CONNEXION</a></li>
            <li><a href="Register.php">INSCRIPTION</a></li>

        <?php 
        // Si c'est un CLIENT
        elseif ($_SESSION['role'] === 'client') : 
        ?>
            <li><a href="Profil.php">MON PROFIL</a></li>
            <li><a href="Panier.php">MON PANIER</a></li>
            <li><a href="Logout.php">DÉCONNEXION</a></li>

        <?php 
        // Si c'est le RESTAURATEUR
        elseif ($_SESSION['role'] === 'restaurateur') : 
        ?>
            <li><a href="Restaurateur.php">GESTION COMMANDES</a></li>
            <li><a href="Logout.php">DÉCONNEXION</a></li>

        <?php 
        // Si c'est un LIVREUR
        elseif ($_SESSION['role'] === 'livreur') : 
        ?>
            <li><a href="Livreur.php">MA TOURNÉE</a></li>
            <li><a href="Logout.php">DÉCONNEXION</a></li>

        <?php 
        // Si c'est l'ADMINISTRATEUR
        elseif ($_SESSION['role'] === 'admin') : 
        ?>
            <li><a href="Admin.php">DASHBOARD ADMIN</a></li>
            <li><a href="Logout.php">DÉCONNEXION</a></li>

        <?php endif; ?>
    </ul>
</nav>
        </header>

