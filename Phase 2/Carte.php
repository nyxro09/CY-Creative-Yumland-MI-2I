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

        <section class="menu-category">
            <h2>🍕 Toutes nos Pizzas</h2>
            <div class="grid-plats">

                <article class="card">
                    <div class="badge">Nouveau</div>
                    <img src="images/pizza-mosaique.jpg" alt="La Mosaïque">
                    <div class="card-content">
                        <h3>La Mosaïque</h3>
                        <p>Crème fraîche, Mozzarella, Poulet, Poivrons, Olives.</p>
                        <div class="card-footer">
                            <span class="price">8,90€</span>
                            <button class="btn-order">COMMANDER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/pizza-margherita.jpg" alt="Margherita">
                    <div class="card-content">
                        <h3>La Margherita</h3>
                        <p>Sauce tomate, Mozzarella, Basilic frais.</p>
                        <div class="card-footer">
                            <span class="price">7,50€</span>
                            <button class="btn-order">COMMANDER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/pizza-Calzone.jpg" alt="Calzone">
                    <div class="card-content">
                        <h3>La Calzone</h3>
                        <p>Sauce tomate, Fromage, Jambon, Champignon de Paris, Oeuf.</p>
                        <div class="card-footer">
                            <span class="price">7,50€</span>
                            <button class="btn-order">COMMANDER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/pizza-4Fromages.jpg" alt="4 Fromages">
                    <div class="card-content">
                        <h3>La 4 Fromages</h3>
                        <p>Sauce tomate, Mozzarella, Reblochon, Chèvre, Bleu d'Auvergnes, Olives.</p>
                        <div class="card-footer">
                            <span class="price">7,50€</span>
                            <button class="btn-order">COMMANDER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/pizza-Reine.jpg" alt="Reine">
                    <div class="card-content">
                        <h3>La Reine</h3>
                        <p>Sauce Tomate, Mozzarella, Jambon de dinde et Champignons.</p>
                        <div class="card-footer">
                            <span class="price">7,50€</span>
                            <button class="btn-order">COMMANDER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/pizza-Orientale.jpg" alt="Orientale">
                    <div class="card-content">
                        <h3>L'Orientale</h3>
                        <p>Sauce Tomate, Mozzarella, Merguez, Poivrons, Oignons.</p>
                        <div class="card-footer">
                            <span class="price">7,50€</span>
                            <button class="btn-order">COMMANDER</button>
                        </div>
                    </div>
                </article>

            </div>
        </section>

        <section class="menu-category">
            <h2>🥗 Nos Salades</h2>
            <div class="grid-plats">

                <article class="card">
                    <img src="images/SaladeCesar.jpg" alt="Salade Cesar">
                    <div class="card-content">
                        <h3>Salade Cesar</h3>
                        <p>Laitue, Parmesan, Oeuf dur, Crouton, Sauce César.</p>
                        <div class="card-footer">
                            <span class="price">6,50€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/salade-grecque.jpg" alt="Salade Grecque">
                    <div class="card-content">
                        <h3>Salade Grecque</h3>
                        <p>Tomate, olive, concombre, poivrons vert.</p>
                        <div class="card-footer">
                            <span class="price">6,50€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>

            </div>
        </section>

        <section class="menu-category">
            <h2>🍰 Nos Desserts</h2>
            <div class="grid-plats">
                <article class="card">
                    <img src="images/tiramisu.jpg" alt="Tiramisu">
                    <div class="card-content">
                        <h3>Tiramisu Maison</h3>
                        <p>Véritable recette italienne au café.</p>
                        <div class="card-footer">
                            <span class="price">4,50€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/Cookie.jpg" alt="Cookie">
                    <div class="card-content">
                        <h3>Cookie</h3>
                        <p>Cookie au chocolat.</p>
                        <div class="card-footer">
                            <span class="price">4,50€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/Brownie.jpg" alt="Brownie">
                    <div class="card-content">
                        <h3>Brownie</h3>
                        <p>Brownie au chocolat et aux noix</p>
                        <div class="card-footer">
                            <span class="price">4,50€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/salade-fruits.jpg" alt="Salade de fruits">
                    <div class="card-content">
                        <h3>Salade de fruits</h3>
                        <p>Fruits frais de saison.</p>
                        <div class="card-footer">
                            <span class="price">5,00€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="menu-category">
            <h2>🥤 Nos Boissons</h2>
            <div class="grid-plats">
                <article class="card">
                    <img src="images/coca.jpg" alt="Coca-Cola">
                    <div class="card-content">
                        <h3>Coca-Cola</h3>
                        <p>Canette 33cl bien fraîche.</p>
                        <div class="card-footer">
                            <span class="price">1,20€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/oasis.jpg" alt="Oasis Tropical">
                    <div class="card-content">
                        <h3>Oasis Tropical</h3>
                        <p>Canette 33cl.</p>
                        <div class="card-footer">
                            <span class="price">1,20€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/fanta.jpg" alt="Fanta Orange">
                    <div class="card-content">
                        <h3>Fanta Orange</h3>
                        <p>Canette 33cl.</p>
                        <div class="card-footer">
                            <span class="price">1,20€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <img src="images/evian.jpg" alt="Evian">
                    <div class="card-content">
                        <h3>Eau Évian</h3>
                        <p>Bouteille 50cl.</p>
                        <div class="card-footer">
                            <span class="price">1,20€</span>
                            <button class="btn-order">AJOUTER</button>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </main>

<?php include('footer.php'); ?>