<?php include('header.php'); ?>

    <main>
        <div style="text-align:right; padding: 10px 20px;">
            <a href="Panier.php" class="btn-order">🛒 Voir mon panier</a>
        </div>

        <section class="filter-container">
            <div class="search-box">
                <input type="text" placeholder="Rechercher (ex: Margherita, Tiramisu)...">
            </div>
            <div class="filters">
                <button class="filter-btn" onclick="chargerPlats('Pizza')">Pizzas</button>
                <button class="filter-btn" onclick="chargerPlats('Salade')">Salades</button>
                <button class="filter-btn" onclick="chargerPlats('Dessert')">Desserts</button>
                <button class="filter-btn" onclick="chargerPlats('Boisson')">Boissons</button>
                <button class="filter-btn" onclick="chargerPlats('')">Tout voir</button>
            </div>
        </section>

        <section class="menu-category">
            <h2 id="titre-categorie">Toute notre carte</h2>
            
            <div id="grille-dynamique" class="grid-plats">
                </div>
        </section>
        
    </main>

    <script src="catalogue.js"></script>

<?php include('footer.php'); ?>