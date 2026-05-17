<?php include('header.php'); ?>

    <main>
        <section id="notation">
            <h1>Donnez-nous votre avis !</h1>
            <p>Votre commande #402 a été livrée. Comment s'est passée votre expérience ?</p>
            
            <form action="Profil.php" method="POST">
                
                <div>
                    <label>🛵 Qualité de la livraison :</label>
                    <select name="note-livraison" required>
                        <option value="">-- Choisissez une note --</option>
                        <option value="5">⭐⭐⭐⭐⭐ Parfait !</option>
                        <option value="4">⭐⭐⭐⭐ Très bien</option>
                        <option value="3">⭐⭐⭐ Correct</option>
                        <option value="2">⭐⭐ Moyen</option>
                        <option value="1">⭐ Mauvais</option>
                    </select>
                </div>

                <div>
                    <label>🍕 Qualité des produits :</label>
                    <select name="note-produits" required>
                        <option value="">-- Choisissez une note --</option>
                        <option value="5">⭐⭐⭐⭐⭐ Délicieux !</option>
                        <option value="4">⭐⭐⭐⭐ Très bon</option>
                        <option value="3">⭐⭐⭐ Bon</option>
                        <option value="2">⭐⭐ Décevant</option>
                        <option value="1">⭐ Immangeable</option>
                    </select>
                </div>

                <div>
                    <label>📝 Un commentaire (optionnel) :</label>
                    <textarea name="commentaire" rows="4" placeholder="Dites-nous tout..."></textarea>
                </div>

                <button type="submit">Envoyer mon avis</button>
            </form>
        </section>
    </main>

<?php include('footer.php'); ?>
