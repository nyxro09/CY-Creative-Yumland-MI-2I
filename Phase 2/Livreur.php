<?php include('header.php'); ?>

    <main>
        <section id="page-livreur">
            <h2>Course en cours #402</h2>

            <div class="boite-client">
                <h3>Infos Client</h3>
                <p>👤 Dupont Jean</p>
                <p>📞 06 12 34 56 78</p>
                <hr>
                <p>📍 12 Rue de la Pizza, 75000 Paris</p>
                <p>🏢 3ème étage, Porte Gauche</p>
                <p>🔑 Interphone : 1234</p>
                <hr>
                <p>📝 <em>Note : "Attention au chien en rentrant s'il vous plaît"</em></p>
            </div>

            <div class="boite-commande">
                <h3>Détail Commande</h3>
                <p>1x La Mosaïque</p>
                <p>1x Tiramisu</p>
                <p><strong>Total payé : 13,40€ (Déjà réglé)</strong></p>
            </div>

            <a href="https://maps.google.com/?q=12+Rue+de+la+Pizza,+75000+Paris" target="_blank" class="gros-bouton bleu" style="display: block; text-align: center; text-decoration: none; box-sizing: border-box;">🗺️ OUVRIR GPS</a>

            <a href="tel:0612345678" class="gros-bouton bleu" style="display: block; text-align: center; text-decoration: none; box-sizing: border-box;">📞 APPELER</a>

            <button class="gros-bouton vert">✅ LIVRAISON TERMINÉE</button>
            <button class="gros-bouton rouge">❌ PROBLÈME</button>

        </section>
    </main>

<?php include('footer.php'); ?>
