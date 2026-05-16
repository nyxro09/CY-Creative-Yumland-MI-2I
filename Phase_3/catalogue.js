async function chargerPlats(categorie = '') {
    try {
        let url = 'api_get_plats.php';
        if (categorie !== '') {
            url += '?categorie=' + encodeURIComponent(categorie);
        }

        const reponse = await fetch(url);

        if (!reponse.ok) {
            throw new Error(`Erreur HTTP: ${reponse.status}`);
        }

        const plats = await reponse.json();
        afficherPlats(plats, categorie);

    } catch (erreur) {
        console.error("Problème lors de la récupération des plats :", erreur);
    }
}

function afficherPlats(plats, categorie) {
    const conteneur = document.getElementById('grille-dynamique');
    const titre = document.getElementById('titre-categorie');
    
    // On met à jour le titre selon le filtre
    if (categorie === '') titre.innerText = 'Toute notre carte';
    else titre.innerText = 'Nos ' + categorie + 's';

    // On vide la grille
    conteneur.innerHTML = ''; 

    if (plats.length === 0) {
        conteneur.innerHTML = '<p>Aucun plat trouvé pour cette catégorie.</p>';
        return;
    }

    // On reconstruit les cartes HTML exactes, mais en JS
    plats.forEach(plat => {
        
        // Gestion du badge s'il existe
        let badgeHtml = '';
        if (plat.badge && plat.badge !== "") {
            badgeHtml = `<div class="badge">${plat.badge}</div>`;
        }

        // Formatage du prix pour avoir la virgule (ex: 7,50)
        let prixFormate = parseFloat(plat.prix).toFixed(2).replace('.', ',');

        const carteHtml = `
            <article class="card">
                ${badgeHtml}
                <img src="${plat.image}" alt="${plat.nom}">

                <div class="card-content">
                    <h3>${plat.nom}</h3>
                    <p>${plat.description}</p>
                    <div class="card-footer">
                        <span class="price">${prixFormate} €</span>
                        
                        <form action="Panier.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="ajouter">
                            <input type="hidden" name="id" value="${plat.id}">
                            <input type="hidden" name="nom" value="${plat.nom}">
                            <input type="hidden" name="prix" value="${plat.prix}">
                            <button type="submit" class="btn-order">AJOUTER</button>
                        </form>
                    </div>
                </div>
            </article>
        `;
        
        conteneur.innerHTML += carteHtml;
    });
}

// Au chargement initial de la page, on affiche tout
document.addEventListener('DOMContentLoaded', () => {
    chargerPlats(''); 
});