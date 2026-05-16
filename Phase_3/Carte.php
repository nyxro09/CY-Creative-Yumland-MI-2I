<?php include('header.php'); ?>

    <main>
        <div style="text-align:right; padding: 10px 20px;">
            <a href="Panier.php" class="btn-order">🛒 Voir mon panier</a>
        </div>

        <section class="filter-container" style="flex-direction: column; align-items: stretch;">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-wrap: wrap; gap: 15px;">
                <div class="search-box">
                    <input type="text" placeholder="Rechercher (ex: Margherita)...">
                </div>
                <div class="filters">
                    <button class="filter-btn" onclick="chargerPlats('Pizza')">Pizzas</button>
                    <button class="filter-btn" onclick="chargerPlats('Salade')">Salades</button>
                    <button class="filter-btn" onclick="chargerPlats('Dessert')">Desserts</button>
                    <button class="filter-btn" onclick="chargerPlats('Boisson')">Boissons</button>
                    <button class="filter-btn" onclick="chargerPlats('')">Tout voir</button>
                </div>
            </div>
            
            <div class="sort-container" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border-color); text-align: right;">
                <strong style="color: var(--texte-principal); margin-right: 10px;">Trier par :</strong>
                <button class="filter-btn" onclick="trierPlats('croissant')">Prix Croissant ⬆️</button>
                <button class="filter-btn" onclick="trierPlats('decroissant')">Prix Décroissant ⬇️</button>
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
