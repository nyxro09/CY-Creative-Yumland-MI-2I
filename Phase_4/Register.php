<?php 
require_once('fonctions.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$nouvelUtilisateur = [
"id" => "U" . time(),
"nom" => trim($_POST['nom']),
"prenom" => trim($_POST['prenom']),
"email" => trim($_POST['email']),
"mot_de_passe" => trim($_POST['password']),
"role" => "client",
"adresse" => trim($_POST['adresse']),
"points_fidelite" => 0,
"est_bloque" => false
];
ajouterUtilisateur($nouvelUtilisateur);
header("Location: Login.php");
exit();
}
?>

<?php include('header.php'); ?>
    <main>
        <section id="register">
            <h1>Rejoignez-nous !</h1>
            <p>Inscrivez-vous pour cumuler des points bonus et profiter d'avantages.</p>
            
            <form action="Register.php" method="POST">
                <div>
                    <label>Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                
                <div>
                    <label>Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                
                <div>
                    <label>Date de naissance :</label>
                    <input type="date" name="date">
                </div>
                
                <div>
                    <label>Adresse :</label>
                    <input type="text" id="adresse" name="adresse" placeholder="N°, rue,..." required>  
                </div>
                
                <div>
                    <label>Adresse Email :</label>
                    <input type="email" id="email" name="email" placeholder="exemple@gmail.com" required>
                </div>
                
                <div style="position: relative; margin-bottom: 25px;">
                <label>Mot de Passe :</label>
                <input type="password" id="password" name="password" required style="padding-right: 40px;">
                <button type="button" id="toggle-pwd" style="position: absolute; right: 10px; top: 32px; background: none; border: none; font-size: 1.2rem; width: auto; padding: 0; cursor: pointer; margin-top: 0;">👁️</button>
                <small id="char-count" style="position: absolute; bottom: -20px; left: 0; font-weight: bold; color: var(--texte-principal);">0/20 caractères</small>
            </div>
                
                <button type="submit">S'inscrire</button>
                <button type="reset">Réinitialiser</button> 
                <p style="text-align: center; margin-top: 15px;">Déjà un compte ? <a href="Login.php">Connectez-vous ici</a></p>
            </form>
        </section>
    </main>

    <?php include('footer.php'); ?>
