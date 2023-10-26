<?php
function getExperUser(){
    // connexion à la bd
    require "../services_acces_bd/connexion_bd.php";
    require "../services_acces_bd/getConcours.php";
    
    $date =  date('Y-m-d');

    $concours = getConcoursSemaineprec($date);

    $idConcoursSemaine = array();

    foreach ( $concours as $row) {
        $id_concours = $row["id_concours"];
        array_push($idConcoursSemaine, $id_concours);
    }
if (count($idConcoursSemaine) == 0) {
    exit();
    }

    $listeidConcoursSemaine = "(" . implode(",", $idConcoursSemaine) . ")";

    // récupération des photos gagnantes 
    $query = "SELECT pseudo_utilisateur_photo from photo P
    where P.id_photo IN (SELECT id_photo_gagnante_concours from concours C
                         where C.id_concours in $listeidConcoursSemaine);";
    $result_photoReineConcours = pg_query($conn, $query);
    
    if (!$result_photoReineConcours) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $user = array();

    while($row = pg_fetch_assoc($result_photoReineConcours)){
        $pseeudoUser = $row['pseudo_utilisateur_photo'];
        array_push($user, $pseeudoUser); 
    }
    pg_close();
    return "('" . implode("','", $user) . "')";

}

$expert_id = getExperUser();
require "../services_acces_bd/connexion_bd.php";
$query1 = "UPDATE utilisateur SET expert_user = true WHERE pseudo_user IN $expert_id;";
if (!pg_query($conn, $query1)){
    echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";      
}
$query2 = "UPDATE utilisateur SET expert_user = false WHERE pseudo_user NOT IN $expert_id;";
if (!pg_query($conn, $query2)){
    echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";      
}
pg_close($conn);

?>