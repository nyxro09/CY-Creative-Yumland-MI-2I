<?php
// On annonce au navigateur qu'on va lui parler en JSON pur
header('Content-Type: application/json; charset=utf-8');

// On recrache directement tout le fichier carte.json (plats ET menus)
echo file_get_contents('data/carte.json');
exit();
?>
