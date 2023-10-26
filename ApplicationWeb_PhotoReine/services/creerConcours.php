<?php
require "../services_acces_bd/connexion_bd.php";
$date = date('Y-m-d');

$query = "SELECT nom_categorie from categorie;";
$result_categories = pg_query($conn, $query);
if (!$result_categories) {
    echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
    exit;
}

$categories = array();
while ($row = pg_fetch_assoc($result_categories)) {
    $categories[] = $row['nom_categorie'];
}


$query2 = "SELECT id_concours  from concours;";
$result_idC = pg_query($conn, $query2);
if (!$result_idC) {
    echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
    exit;
}
$idConcours = array();
while ($row = pg_fetch_assoc($result_idC)) {
    $idConcours[] = $row['id_concours'];
}
$max = max($idConcours);
$max+= 1;

$randomCategories = array_rand($categories, 3);
foreach ($randomCategories as $index) {
    $query1 = "INSERT INTO Concours (Id_concours, date_concours, categorie_concours) VALUES ($max , '$date', '$categories[$index]');";
    $insertcnc = pg_query($conn, $query1);
    if (!$insertcnc) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
        }
    $max+=1;
}


?>