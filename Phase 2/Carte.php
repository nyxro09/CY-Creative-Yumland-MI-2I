<?php include('header.php'); ?>

    <main>
        <section class="filter-container">
            <div class="search-box">
                <input type="text" placeholder="Rechercher (ex: Margherita, Tiramisu)...">
            </div>
            <div class="filters">
                <button class="filter-btn">Pizzas</button>
                <button class="filter-btn">Salades</button>
                <button class="filter-btn">Desserts</button>
                <button class="filter-btn">Boissons</button>
            </div>
        </section>

        <?php
$categories = [
    'Pizza'   => '🍕 Toutes nos Pizzas',
    'Salade'  => '🥗 Nos Salades',
    'Dessert' => '🍰 Nos Desserts',
    'Boisson' => '🥤 Nos Boissons',
];

foreach ($categories as $categorie => $titre) :
    $platsCategorie = array_filter(getPlats(), fn($p) => $p['categorie'] === $categorie);
?>
    <section class="menu-category">
        <h2><?php echo $titre; ?></h2>
        <div class="grid-plats">

            <?php foreach ($platsCategorie as $plat) : ?>
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
                        
                        <form action="Panier.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="ajouter">
                            <input type="hidden" name="id" value="<?php echo $plat['id']; ?>">
                            <input type="hidden" name="nom" value="<?php echo $plat['nom']; ?>">
                            <input type="hidden" name="prix" value="<?php echo $plat['prix']; ?>">
                            <button type="submit" class="btn-order">AJOUTER</button>
                        </form>
                        
                    </div>
                </div>

            </article>
            <?php endforeach; ?>

        </div>
    </section>
<?php endforeach; ?>
    </main>

<?php include('footer.php'); ?>
