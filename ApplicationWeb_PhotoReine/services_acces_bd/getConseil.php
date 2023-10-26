<?php

function getConseils($idPhoto)  //nbr c'est le nombre des conseils qu'on veux afficher
{
    // connexion à la bd
    require 'connexion_bd.php';

    // récupération des infos du conseil
    $query = "SELECT pseudo_expert_conseiller, date_conseil, texte_conseil from conseiller C
              where C.id_photo_conseil = $idPhoto
              LIMIT 3;";
    $result_conseil = pg_query($conn, $query);

    if (!$result_conseil) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $infosConseil = array();

    while($row = pg_fetch_assoc($result_conseil)){

        $Conseil = array(
            "pseudo_user" => $row["pseudo_expert_conseiller"],
            "date_conseil" => $row["date_conseil"],
            "texte_conseil" => $row["texte_conseil"],
        );
        array_push($infosConseil, $Conseil); 
    }

    pg_close($conn);
    return $infosConseil;
}



//Test
/*
$test = getConseils(2346833);
foreach ($test as $els){
    echo $els['pseudo_user']." ";
    echo "(".$els['date_conseil']."): ";
    echo $els['texte_conseil'];
    echo "\n";
}*/
?>