// 1. VARIABLE GLOBALE : Elle mémorise les plats affichés pour pouvoir les trier sans rappeler le serveur
let platsActuels = [];
let categorieActuelle = ''; // Mémorise la catégorie pour l'affichage du titre

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
        
        // 2. SAUVEGARDE : On stocke les données récupérées en mémoire locale
        platsActuels = plats;
        categorieActuelle = categorie;

        // 3. AFFICHAGE
        afficherPlats(platsActuels, categorieActuelle);

    } catch (erreur) {
        console.error("Problème lors de la récupération des plats :", erreur);
    }
}

// 4. NOUVELLE FONCTION DE TRI LOCAL
function trierPlats(ordre) {
    if (platsActuels.length === 0) return;

    // On fait une copie du tableau pour le trier proprement
    let platsTries = [...platsActuels];

    if (ordre === 'croissant') {
        platsTries.sort((a, b) => parseFloat(a.prix) - parseFloat(b.prix));
    } else if (ordre === 'decroissant') {
        platsTries.sort((a, b) => parseFloat(b.prix) - parseFloat(a.prix));
    }

    // On réaffiche les cartes avec le tableau fraîchement trié
    afficherPlats(platsTries, categorieActuelle);
}

function afficherPlats(plats, categorie) {
    const conteneur = document.getElementById('grille-dynamique');
    const titre = document.getElementById('titre-categorie');
    
    // Mise à jour du titre
    if (categorie === '') titre.innerText = 'Toute notre carte';
    else titre.innerText = 'Nos ' + categorie + 's';

    // Vidage de la grille
    conteneur.innerHTML = ''; 

    if (plats.length === 0) {
        conteneur.innerHTML = '<p>Aucun plat trouvé.</p>';
        return;
    }

    // Reconstruction HTML
    plats.forEach(plat => {
        let badgeHtml = '';
        if (plat.badge && plat.badge !== "") {
            badgeHtml = `<div class="badge">${plat.badge}</div>`;
        }

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

// Lancement au démarrage
document.addEventListener('DOMContentLoaded', () => {
    chargerPlats(''); 
});
