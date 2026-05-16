let platsActuels = [];
let categorieActuelle = ''; 

async function chargerPlats(categorie = '') {
    try {
        let url = 'api_get_plats.php';
        if (categorie !== '') {
            url += '?categorie=' + encodeURIComponent(categorie);
        }

        const reponse = await fetch(url);
        if (!reponse.ok) throw new Error(`Erreur HTTP: ${reponse.status}`);

        const plats = await reponse.json();
        platsActuels = plats;
        categorieActuelle = categorie;

        afficherPlats(platsActuels, categorieActuelle);

    } catch (erreur) {
        console.error("Problème lors de la récupération des plats :", erreur);
    }
}

function trierPlats(ordre) {
    if (platsActuels.length === 0) return;

    let platsTries = [...platsActuels];

    if (ordre === 'croissant') {
        platsTries.sort((a, b) => parseFloat(a.prix) - parseFloat(b.prix));
    } else if (ordre === 'decroissant') {
        platsTries.sort((a, b) => parseFloat(b.prix) - parseFloat(a.prix));
    }

    afficherPlats(platsTries, categorieActuelle);
}

function afficherPlats(plats, categorie) {
    const conteneur = document.getElementById('grille-dynamique');
    const titre = document.getElementById('titre-categorie');
    
    if (categorie === '') titre.innerText = 'Toute notre carte';
    else titre.innerText = 'Nos ' + categorie + 's';

    conteneur.innerHTML = ''; 

    if (plats.length === 0) {
        conteneur.innerHTML = '<p>Aucun plat trouvé.</p>';
        return;
    }

    plats.forEach(plat => {
        let badgeHtml = '';
        if (plat.badge && plat.badge !== "") {
            badgeHtml = `<div class="badge">${plat.badge}</div>`;
        }

        let prixFormate = parseFloat(plat.prix).toFixed(2).replace('.', ',');

        // Échappement des apostrophes pour éviter de casser la chaîne de caractères JS du onclick
        const nomSecurise = plat.nom.replace(/'/g, "\\'");

        const carteHtml = `
            <article class="card">
                ${badgeHtml}
                <img src="${plat.image}" alt="${plat.nom}">

                <div class="card-content">
                    <h3>${plat.nom}</h3>
                    <p>${plat.description}</p>
                    <div class="card-footer">
                        <span class="price">${prixFormate} €</span>
                        
                        <button class="btn-order" onclick="ajouterAuPanier('${plat.id}', '${nomSecurise}', ${plat.prix}, this)">
                            AJOUTER
                        </button>
                    </div>
                </div>
            </article>
        `;
        
        conteneur.innerHTML += carteHtml;
    });
}

// NOUVELLE FONCTION ASYNCHRONE D'AJOUT ET D'ANIMATION
async function ajouterAuPanier(idPlat, nomPlat, prixPlat, bouton) {
    bouton.disabled = true;

    try {
        const reponse = await fetch('api_add_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: idPlat, nom: nomPlat, prix: prixPlat })
        });

        const data = await reponse.json();

        if (data.success) {
            // 1. Déclenchement de l'animation de succès sur le bouton cliqué
            bouton.classList.add('btn-added');
            bouton.innerText = '✓ AJOUTÉ';

            // 2. Création et injection dynamique du "Toast" d'animation
            creerToastNotification(`🛒 ${nomPlat} a été ajouté au panier !`);

            // 3. Remise à l'état initial du bouton après la fin de la micro-interaction
            setTimeout(() => {
                bouton.classList.remove('btn-added');
                bouton.innerText = 'AJOUTER';
                bouton.disabled = false;
            }, 1200);

        } else {
            alert("Erreur lors de l'ajout : " + data.message);
            bouton.disabled = false;
        }

    } catch (erreur) {
        console.error("Erreur réseau panier :", erreur);
        alert("Impossible de communiquer avec le panier.");
        bouton.disabled = false;
    }
}

// Fonction utilitaire pour générer le composant de notification volant
function creerToastNotification(message) {
    const toast = document.createElement('div');
    toast.className = 'cart-toast';
    toast.innerHTML = `<span>${message}</span>`;
    
    document.body.appendChild(toast);

    // Suppression automatique du DOM une fois que l'animation de sortie en CSS est terminée
    setTimeout(() => {
        toast.remove();
    }, 2700); // 400ms apparition + 1900ms attente + 400ms disparition
}

document.addEventListener('DOMContentLoaded', () => {
    chargerPlats(''); 
});
