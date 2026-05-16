<?php include('header.php'); ?>
    <main>
        <section id="register">
            <h1>Rejoignez-nous !</h1>
            <p>Inscrivez-vous pour cumuler des points bonus et profiter d'avantages.</p>
            
            <form action="Profil.html" method="POST">
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
                
                <div>
                    <label>Mot de Passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit">S'inscrire</button>
                <button type="reset">Réinitialiser</button> 
                <p style="text-align: center; margin-top: 15px;">Déjà un compte ? <a href="Login.html">Connectez-vous ici</a></p>
            </form>
        </section>
    </main>

    <?php include('footer.php'); ?>
