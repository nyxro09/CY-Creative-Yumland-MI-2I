<?php include('header.php'); ?>
<?php 
    // On récupère la liste complète des plats depuis les fonctions
    $tousLesPlats = getPlats();
    
    $platsAccueil = array_slice($tousLesPlats, 0, 3);
?>
    <main>
        <section class="promo-banner">
            <h1>1 PIZZA ACHETÉE = 1 PIZZA OFFERTE*</h1>
            <p>*Sur les formats Super et Famille. Voir conditions.</p>
        </section>

        <section class="menu-category">
            <h2>🔥 Nos Stars du Moment</h2>
            <div class="grid-plats">
                
                <?php foreach ($platsAccueil as $plat) : ?>
                
                <article class="card">
                    <?php if (!empty($plat['badge'])) : ?>
                        <div class="badge"><?php echo $plat['badge']; ?></div>
                    <?php endif; ?>
                    
                    <img src="<?php echo $plat['image']; ?>" alt="<?php echo $plat['nom']; ?>">
                    
                    <div class="card-content">
                        <h3><?php echo $plat['nom']; ?></h3>
                        <p><?php echo $plat['description']; ?></p>
                        
                        <div class="card-footer">
                            <span class="price"><?php echo number_format($plat['prix'], 2, ',', ' '); ?>€</span>
                            <button class="btn-order">COMMANDER</button>
                        </div>
                    </div>
                </article>

                <?php endforeach; ?>
                </div>
        </section>
    </main>

<?php include('footer.php'); ?>