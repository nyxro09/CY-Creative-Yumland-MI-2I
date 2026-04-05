<?php include('header.php'); ?>

    <main class="profil-main">
        <div class="profil-container admin-container">
            
            <section class="profil-infos">
                <h2>Tableau de Bord Administrateur</h2>
                <p>Gestion des utilisateurs du système.</p>

                <div class="filter-container admin-filters">
                    <div class="search-box">
                        <input type="text" placeholder="Rechercher un utilisateur...">
                    </div>
                    <div class="filters">
                        <button class="filter-btn active">Tous</button>
                        <button class="filter-btn">Clients</button>
                        <button class="filter-btn">Livreurs</button>
                        <button class="filter-btn">Restaurateurs</button>
                    </div>
                </div>

                <table class="table-commandes">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom & Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Commandes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#U001</td>
                            <td>Dupont Jean</td>
                            <td>jean.dupont@email.com</td>
                            <td><strong>Client</strong></td>
                            <td>12</td>
                            <td>
                                <a href="Profil.html" class="filter-btn btn-small" style="display: inline-block;">Voir Profil</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#U002</td>
                            <td>Youcef</td>
                            <td>youcef.client@gmail.com</td>
                            <td><strong>Client</strong></td>
                            <td>3</td>
                            <td>
                                <a href="Profil.html" class="filter-btn btn-small" style="display: inline-block;">Voir Profil</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#U003</td>
                            <td>Ronyx</td>
                            <td>ronyx.livreur1@gmail.com</td>
                            <td class="role-livreur"><strong>Livreur</strong></td>
                            <td>-</td>
                            <td>
                                <a href="Profil.html" class="filter-btn btn-small" style="display: inline-block;">Voir Profil</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#U004</td>
                            <td>Zachary</td>
                            <td>zachary.resto@hotmail.com</td>
                            <td class="role-restaurateur"><strong>Restaurateur</strong></td>
                            <td>-</td>
                            <td>
                                <a href="Profil.html" class="filter-btn btn-small" style="display: inline-block;">Voir Profil</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </div>
    </main>

<?php include('footer.php'); ?>