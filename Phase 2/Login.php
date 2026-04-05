<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('fonctions.php');

$erreur = ""; // Variable vide par défaut, servira si le client se trompe

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $emailSaisi = $_POST['email'];
    $passwordSaisi = $_POST['password'];
    
    $utilisateurs = getUtilisateurs();
    $connexionReussie = false;
    
    //On fouille dans la base de données
    foreach ($utilisateurs as $user) {
        
        // Si on trouve le bon compte
        if ($user['email'] === $emailSaisi && $user['mot_de_passe'] === $passwordSaisi) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['nom'] = $user['nom'];
            
            $connexionReussie = true;
            
            if ($user['role'] === 'admin') {
                header("Location: Admin.php"); // L'admin va sur son dashboard
            } else {
                header("Location: Accueil.php"); // Le client va sur l'accueil
            }
            exit();
        }
    }
    
    // Si la boucle est terminée et qu'on n'a rien trouvé
    if (!$connexionReussie) {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>

<?php include('header.php'); ?>

<main>
    <section id="login">
        <h1>Connexion Client</h1>
        <p>Heureux de vous voir ! Connectez-vous pour voir vos commandes précédentes.</p>
        
        <?php if (!empty($erreur)) : ?>
            <p style="color: red; text-align: center; font-weight: bold; background-color: #ffe6e6; padding: 10px; border-radius: 5px;">
                <?php echo $erreur; ?>
            </p>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div>
                <label>Adresse Email :</label>
                <input type="email" id="email" name="email" placeholder="exemple@gmail.com" required>
            </div>
            
            <div>
                <label>Mot de Passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Se connecter</button> 
            <p style="text-align: center; margin-top: 15px;">Pas encore inscrit ? <a href="Register.php">Cliquez ici</a></p>
        </form>
    </section>
</main>

<?php include('footer.php'); ?>
