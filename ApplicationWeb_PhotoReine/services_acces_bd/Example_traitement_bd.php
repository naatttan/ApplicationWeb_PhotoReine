
<?php

// inclure le script 'connexion_bd.php'
require 'connexion_bd.php';

// Exécution d'une requête SQL
$query = "SELECT * FROM Categorie;";
$result = pg_query($conn, $query);

// Traitement du résultat de la requête
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}

$categories = array();
// Récupération de chaque ligne de résultat
while ($row = pg_fetch_assoc($result)) {
    //enregistrement de chaque lignes dans un dictionnaire de données
    $categories[$row[strtolower("nom_Categorie")]] = array(
        "nom" => $row[strtolower("nom_Categorie")],
        "description" => $row[strtolower("description_Categorie")],
        "image" => $row[strtolower("image_Categorie")],
    );
}

// Pour chaque élément du dictionnaire catégorie 
foreach ($categories as $cat){
    // afficher son nom
    echo $cat["nom"] . "</br>";
}
// Fermeture de la connexion
pg_close($conn);

?>
