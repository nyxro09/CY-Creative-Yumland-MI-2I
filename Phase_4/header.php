<?php 
if(session_status() === PHP_SESSION_NONE){  
    session_start();
}
include_once('fonctions.php'); 

// RAFRAÎCHISSEMENT FORCÉ EN TEMPS RÉEL 
if (isset($_SESSION['user_id'])) {
    $tousLesMembres = getUtilisateurs();
    $compteValide = false;

    foreach ($tousLesMembres as $membre) {
        if ($membre['id'] === $_SESSION['user_id']) {
            $compteValide = true;
            
            // MISE À JOUR DU RÔLE 
            $_SESSION['role'] = $membre['role'];

            // VÉRIFICATION DU BANNISSEMENT
            if (isset($membre['est_bloque']) && $membre['est_bloque'] === true) {
                session_unset();
                session_destroy();
                header("Location: Login.php?statut=banni");
                exit();
            }
            break;
        }
    }
    
    // VÉRIFICATION DE LA SUPPRESSION DU COMPTE
    if (!$compteValide) {
        session_unset();
        session_destroy();
        header("Location: Login.php?statut=supprime");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mosaïque Yum - Accueil</title>
    <link rel="stylesheet" href="style.css">
    <script src="theme.js" defer></script>
    <script src="formulaire.js" defer></script>
    <script src="restaurateur.js" defer></script>
    <script src="catalogue.js" defer></script>
    <script src="admin.js" defer></script>
    <script src="livreur.js" defer></script>
</head>
<body class="<?php echo (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') ? 'dark-theme' : ''; ?>">

    <header class="navbar">
        <a href="Accueil.php">
            <img src="images/Logo.png" alt="Logo Mosaïque" class="logo-img">
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

        <li>
            <button id="theme-toggle" style="background: none; border: none; font-size: 1.3rem; cursor: pointer; padding: 5px 10px; margin-left: 15px; vertical-align: middle;">
                <?php echo (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') ? '☀️' : '🌙'; ?>
            </button>
        </li>
    </ul>
</nav>
        </header>

