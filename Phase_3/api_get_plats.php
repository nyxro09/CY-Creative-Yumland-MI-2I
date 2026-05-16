<?php
// On annonce au navigateur qu'on va lui parler en JSON pur
header('Content-Type: application/json; charset=utf-8');

// On charge tes fonctions
require_once('fonctions.php');


$tousLesPlats = getPlats(); 
$platsFiltres = [];

// 4. On intercepte le filtre de catégorie dans l'URL
$filtreCategorie = isset($_GET['categorie']) ? strtolower(trim($_GET['categorie'])) : '';

// Le filtrage
foreach ($tousLesPlats as $plat) {
    $conserver = true; 

    // Si on a cliqué sur un filtre et que la catégorie du plat ne correspond pas, on le rejette
    if ($filtreCategorie !== '' && strtolower($plat['categorie']) !== $filtreCategorie) {
        $conserver = false;
    }

    // Si le plat correspond, on le garde
    if ($conserver) {
        $platsFiltres[] = $plat;
    }
}

//  On recrache le tableau filtré en format JSON
echo json_encode($platsFiltres, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
exit();