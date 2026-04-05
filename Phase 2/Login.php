<?php include('header.php'); ?>
    <main>
        <section id="login">
            <h1>Connexion Client</h1>
            <p>Heureux de vous voir ! Connectez-vous pour voir vos commandes précédentes.</p>
            
            <form action="Profil.html" method="POST">
                <div>
                    <label>Adresse Email :</label>
                    <input type="email" id="email" name="email" placeholder="exemple@gmail.com" required>
                </div>
                
                <div>
                    <label>Mot de Passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit">Se connecter</button> 
                <p>Pas encore inscrit ? <a href="Register.html">Cliquez ici</a></p>
            </form>
        </section>
    </main>

<?php include('footer.php'); ?>
