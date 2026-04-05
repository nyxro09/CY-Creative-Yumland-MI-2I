<?php include('header.php'); ?>

    <main class="dashboard-main">
        <h1 class="dashboard-title">Tableau de Bord - Commandes</h1>
        
        <div class="dashboard-columns">
            
            <section class="dashboard-col col-prep">
                <h2>👨‍🍳 En attente de préparation</h2>
                
                <div class="boite-commande boite-commande-prep">
                    <h3>Commande #403 - 19h45</h3>
                    <p><strong>Client :</strong> Youcef (À Emporter)</p>
                    <hr>
                    <ul class="list-commande">
                        <li>2x Pizza Mosaïque</li>
                        <li>1x Salade César</li>
                    </ul>
                    <hr>
                    <button class="btn-order btn-full">Prête</button>
                </div>

                <div class="boite-commande boite-commande-prep">
                    <h3>Commande #404 - 19h50</h3>
                    <p><strong>Client :</strong> Ronyx (Livraison)</p>
                    <hr>
                    <ul class="list-commande">
                        <li>1x Pizza Margherita</li>
                        <li>1x Tiramisu Maison</li>
                    </ul>
                    <hr>
                    <button class="btn-order btn-full">Prête</button>
                </div>
            </section>

            <section class="dashboard-col col-livraison">
                <h2>🛵 En cours de livraison</h2>
                
                <div class="boite-commande boite-commande-livraison">
                    <h3>Commande #402 - 19h20</h3>
                    <p><strong>Livreur :</strong> Paul (En route)</p>
                    <p><strong>Client :</strong> Zachary (12 Rue de la Pizza)</p>
                    <hr>
                    <p class="statut-en-cours">Statut : En cours d'acheminement</p>
                </div>
                
                <div class="boite-commande boite-commande-livraison">
                    <h3>Commande #401 - 19h05</h3>
                    <p><strong>Livreur :</strong> Fiora (Sur place)</p>
                    <p><strong>Client :</strong> Faker (8 Avenue du Fromage)</p>
                    <hr>
                    <p class="statut-en-cours">Statut : Arrivé chez le client</p>
                </div>
            </section>

        </div>
    </main>

<?php include('footer.php'); ?>