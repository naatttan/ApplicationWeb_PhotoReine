<?php
function getCommentaires($idPhoto)  //nbr c'est le nombre des commentaire qu'on veux afficher
{
    // connexion à la bd
    require 'connexion_bd.php';

    // récupération des infos du commentaire
    $query = "SELECT pseudo_utilisateur_commentaire, date_commentaire, texte_commentaire
              from commentaire C
              where C.id_photo_commentaire = $idPhoto";
    $result_comment = pg_query($conn, $query);

    if (!$result_comment) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $infosComment = array();

    while($row = pg_fetch_assoc($result_comment)){

        $Comment = array(
            "pseudo_user" => $row["pseudo_utilisateur_commentaire"],
            "date_commentaire" => $row["date_commentaire"],
            "texte_commentaire" => $row["texte_commentaire"],
        );
        array_push($infosComment, $Comment); 
    }

    pg_close($conn);
    return $infosComment;
}

//Test
/*
$test = getCommentaires(1764);
foreach ($test as $els){
    echo $els['texte_commentaire'];
    echo "\n";
}*/

?>