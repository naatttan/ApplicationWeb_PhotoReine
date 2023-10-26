<?php
function getConcours($idConcours, $pseudo_user_V){
    // connexion à la bd bd
    require 'connexion_bd.php';
    require 'likerphoto.php';
    

    // récupération des infos du concours
    $query = "SELECT * FROM Concours WHERE Concours.id_concours = $idConcours;";
    $result_concours = pg_fetch_assoc(pg_query($conn, $query));

    if (!$result_concours) {
        echo "Une erreur s'est produite lors de la connexion à la base de donnée.\n";
        exit;
    }

    $concours = array(
        "id_concours" => $idConcours,
        "date" => $result_concours[strtolower("date_concours")],
        "categorie" => $result_concours[strtolower("categorie_concours")],
        "photo_gagnate" => $result_concours[strtolower("id_photo_gagnante_concours")],
        "photos" => array()
    );

    // récupérations photos du concours
    $query = "SELECT * FROM Photo WHERE Photo.id_concours_photo = $idConcours;";
    $result_photos_concours = pg_query($conn, $query);

    if (!$result_concours) {
        echo "Une erreur s'est produite lors de la connexion à la base de donnée.\n";
        exit;
    }

    while ($row = pg_fetch_assoc($result_photos_concours)) {
        $id_photo = $row["id_photo"];

        // récuperation nombre de votes
        $query = "SELECT COUNT(id_photo_vote) FROM vote WHERE vote.id_photo_vote = $id_photo;";
        $result_nbvote = pg_query($conn, $query);

        if (!$result_nbvote) {
            echo "Une erreur s'est produite lors de la connexion à la base de donnée.\n";
            exit;
        }

        //enregistrement de chaque lignes dans un dictionnaire de données
        $photo = array(
            "id_photo" => $row["id_photo"],
            "lien_photo" => $row["lien_photo"],
            "pseudo_utilisateur" => $row["pseudo_utilisateur_photo"],
            "date_photo" => $row["date_publication_photo"],
            "nombre_vote" => pg_fetch_assoc($result_nbvote)["count"],
            "is_liked" => verifierLike($row["id_photo"], $pseudo_user_V)
        );
        array_push($concours["photos"], $photo); 
    }

    pg_close($conn);

    return $concours;
}

function getConcoursSemaine($date){
    // connexion à la bd
    require 'connexion_bd.php';
    require 'getMondayDate.php';
    $dateSemaine = getPreviousMonday($date);
    // récupération des informations du concours
    $query = "SELECT * FROM Concours WHERE Concours.date_concours='$dateSemaine';";
    $result_concoursSemaine = pg_query($conn, $query);
    if (!$result_concoursSemaine) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $concoursSemaine = array();

    while($row = pg_fetch_assoc($result_concoursSemaine)){
        $categorie_concours = $row["categorie_concours"];
        
        // récuperation de l'image de la catégorie
        $query = "SELECT image_categorie FROM categorie WHERE categorie.nom_categorie ='$categorie_concours';";
        $result_categorie = pg_query($conn, $query);

        if (!$result_categorie) {
            echo "Une erreur s'est produite lors de la connexion à la base de donnée.\n";
            exit;
        }

        $concours = array(
            "id_concours" => $row["id_concours"],
            "categorie" => $row["categorie_concours"],
            "image_categorie" => pg_fetch_assoc($result_categorie)["image_categorie"]
        );
        array_push($concoursSemaine, $concours); 
    }

    pg_close($conn);
    return $concoursSemaine;
}


function getAffichageConcours($date){
    // connexion à la bd
    require 'connexion_bd.php';
    require 'getMondayDate.php';
    $dateSemaine = getPreviousMonday($date);
    
    // récupération des informations du concours
    $query = "SELECT id_concours, categorie_concours FROM Concours WHERE Concours.date_concours='$dateSemaine';";
    $result_concoursSemaine = pg_query($conn, $query);
    if (!$result_concoursSemaine) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $concoursSemaine = array();

    while($row = pg_fetch_assoc($result_concoursSemaine)){
        $id_concours = $row["id_concours"];
        
        // récuperation des images du concours
        $query = "SELECT id_photo, lien_photo FROM photo WHERE photo.id_concours_photo =$id_concours
                  LIMIT 3;";
        $result_photo = pg_query($conn, $query);

        if (!$result_photo) {
            echo "Une erreur s'est produite lors de la connexion à la base de donnée.\n";
            exit;
        }

        $concours = array(
            "id_concours" => $row["id_concours"],
            "categorie" => $row["categorie_concours"],
            "photos" => array()
        );

        while($rw = pg_fetch_assoc($result_photo)){
            $photo = array(
                "id_photo" => $rw["id_photo"],
                "lien_photo" => $rw["lien_photo"]
            );    
            array_push($concours['photos'], $photo);         
        }

        
        array_push($concoursSemaine, $concours);
        
    }

    pg_close($conn);
    return $concoursSemaine;
}





function getConcoursSemaineprec($date){
    // connexion à la bd
    require 'connexion_bd.php';
    require 'getMondayDate.php';
    
    
    $dateSemaine = getPreviousWeekMonday($date);
    
    
    
    // récupération des informations du concours
    $query = "SELECT * FROM Concours WHERE Concours.date_concours='$dateSemaine';";
    $result_concoursSemaine = pg_query($conn, $query);
    if (!$result_concoursSemaine) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $concoursSemaine = array();

    while($row = pg_fetch_assoc($result_concoursSemaine)){
        $categorie_concours = $row["categorie_concours"];
        
        // récuperation de l'image de la catégorie
        $query = "SELECT image_categorie FROM categorie WHERE categorie.nom_categorie ='$categorie_concours';";
        $result_categorie = pg_query($conn, $query);

        if (!$result_categorie) {
            echo "Une erreur s'est produite lors de la connexion à la base de donnée.\n";
            exit;
        }

        $concours = array(
            "id_concours" => $row["id_concours"],
            "categorie" => $row["categorie_concours"],
            "image_categorie" => pg_fetch_assoc($result_categorie)["image_categorie"]
        );
        array_push($concoursSemaine, $concours); 
    }

    
    return $concoursSemaine;
}

?> 