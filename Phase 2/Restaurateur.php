<?php include('header.php'); ?>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            if ($_POST['action'] === 'prete') {
                modifierStatutCommande($_POST['id_commande'], 'en_livraison');
            }
            header('Location: Restaurateur.php');
            exit();
        }
    ?>

    <main class="dashboard-main">
        <h1 class="dashboard-title">Tableau de Bord - Commandes</h1>
        
        <div class="dashboard-columns">
            
            <section class="dashboard-col col-prep">
                <h2>👨‍🍳 En attente de préparation</h2>
                
               <?php
                    $commandes = getCommandes();
                    $commandesEnAttente = array_filter($commandes, fn($c) => $c['statut'] === 'en_attente');
                ?>

                <?php if (empty($commandesEnAttente)) : ?>
                    <p>Aucune commande en attente.</p>
                <?php endif; ?>

                <?php foreach ($commandesEnAttente as $commande) : ?>
                    <div class="boite-commande boite-commande-prep">
                        <h3>Commande #<?php echo substr($commande['id'], -6); ?> - <?php echo $commande['date']; ?></h3>
                        <p><strong>Client :</strong> <?php echo $commande['client']; ?></p>
                        <hr>
                        <ul class="list-commande">
                            <?php foreach ($commande['articles'] as $article) : ?>
                                <li><?php echo $article['quantite']; ?>x <?php echo $article['nom']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <hr>

                        <form action="Restaurateur.php" method="POST">
                            <input type="hidden" name="action" value="prete">
                            <input type="hidden" name="id_commande" value="<?php echo $commande['id']; ?>">
                            <button type="submit" class="btn-order btn-full">Prête</button>
                        </form>
                    </div>
                    <?php endforeach; ?>

            </section>

            <section class="dashboard-col col-livraison">
                <h2>🛵 En cours de livraison</h2>

                <?php
                    $commandesLivraison = array_filter($commandes, fn($c) => $c['statut'] === 'en_livraison');
                ?>

                <?php if (empty($commandesLivraison)) : ?>
                    <p>Aucune commande en livraison.</p>
                 <?php endif; ?>

                <?php foreach ($commandesLivraison as $commande) : ?>
                <div class="boite-commande boite-commande-livraison">
                    <h3>Commande #<?php echo substr($commande['id'], -6); ?> - <?php echo $commande['date']; ?></h3>
                    <p><strong>Client :</strong> <?php echo $commande['client']; ?></p>
                    <hr>
                    <p class="statut-en-cours">Statut : En cours d'acheminement</p>
                 </div>
        <?php endforeach; ?>

            </section>



        </div>
    </main>

<?php include('footer.php'); ?>
