<?php

function getNbVote($id_photo){
    // connexion à la bd
    require 'connexion_bd.php';

    // récuperation nombre de votes
    $query = "SELECT COUNT(id_photo_vote) FROM vote WHERE vote.id_photo_vote = $id_photo;";
    $result_nbvote = pg_query($conn, $query);

    if (!$result_nbvote) {
        echo "Une erreur s'est produite lors de la connexion à la base de donnée.\n";
        exit;
    }

    return pg_fetch_assoc($result_nbvote)["count"];
}

function getCategorie($id_photo){
    // connexion à la bd
    require 'connexion_bd.php';

    // récuperation categorie photo
    $query = "SELECT categorie_concours 
                FROM concours 
                WHERE concours.id_concours = (
                    SELECT id_concours_photo 
                    FROM Photo 
                    WHERE id_photo = $id_photo
                );";
    $result_categoriePhoto = pg_query($conn, $query);

    if (!$result_categoriePhoto) {
        echo "Une erreur s'est produite lors de la connexion à la base de donnée. 2\n";
        exit;
    }
    return pg_fetch_assoc($result_categoriePhoto)["categorie_concours"];
}

function getPhotoUser($pseudoUser){
    // connexion à la bd
    require 'connexion_bd.php';

    // récupération des photos de l'utilisateur
    $query = "SELECT * FROM Photo WHERE Photo.pseudo_utilisateur_photo='$pseudoUser';";
    $result_photoUser = pg_query($conn, $query);

    if (!$result_photoUser) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $photoUser = array(
        'pseudo_user' => $pseudoUser,
        "photos" => array()
    );

    while($row = pg_fetch_assoc($result_photoUser)){
        $id_photo = $row["id_photo"];

        $photo = array(
            "id_photo" => $row["id_photo"],
            "lien_photo" => $row["lien_photo"],
            "date_photo" => $row["date_publication_photo"],
            "nombre_vote" => getNbVote($id_photo)
        );
        array_push($photoUser["photos"], $photo); 
    }

    pg_close($conn);

    return $photoUser;
}

function getInfosPhoto($id_photo){
    // connexion à la bd
    require 'connexion_bd.php';

    // récupération des photos de l'utilisateur
    $query = "SELECT * FROM Photo WHERE Photo.id_photo= $id_photo;";
    $result_infosPhoto = pg_query($conn, $query);

    if (!$result_infosPhoto) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $infosPhoto = array();

    while($row = pg_fetch_assoc($result_infosPhoto)){

        $photo = array(
            "id_photo" => $row["id_photo"],
            "lien_photo" => $row["lien_photo"],
            "date_photo" => $row["date_publication_photo"],
            "pseudo_user" => $row["pseudo_utilisateur_photo"],
            "nombre_vote" => getNbVote($id_photo),
            "categorie_photo" => getCategorie($id_photo)
        );
        array_push($infosPhoto, $photo); 
    }

    pg_close($conn);
    return $infosPhoto;
}

function getPhotoReineCategorie($categorie){
    // connexion à la bd
    require 'connexion_bd.php';
    // récupération des photos gagnantes dans la catégorie
    $query = "SELECT id_Photo, lien_Photo, pseudo_utilisateur_Photo, id_concours_Photo, date_publication_Photo 
    FROM photo
    Inner JOIN concours ON photo.id_photo = concours.id_photo_gagnante_concours
    and concours.categorie_concours = '$categorie'; ";
    $result_photoReine = pg_query($conn, $query);

    if (!$result_photoReine) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $infosPhoto = array();

    while($row = pg_fetch_assoc($result_photoReine)){

        $photo = array(
            "id_photo" => $row["id_photo"],
            "lien_photo" => $row["lien_photo"],
            "date_photo" => $row["date_publication_photo"],
            "pseudo_user" => $row["pseudo_utilisateur_photo"],
            "nombre_vote" => getNbVote($row["id_photo"]),
            "categorie_photo" => getCategorie($row["id_photo"])
        );
        array_push($infosPhoto, $photo); 
    }

    pg_close($conn);
    return $infosPhoto;


}


function getPhotoReineUser($pseudoUser){
    // connexion à la bd
    require 'connexion_bd.php';
    // récupération des photos gagnantes 
    $query = "SELECT id_Photo, lien_Photo, pseudo_utilisateur_Photo, id_concours_Photo, date_publication_Photo from photo P
    INNER JOIN concours on P.id_photo = concours.id_photo_gagnante_concours
    where P.pseudo_utilisateur_photo = '$pseudoUser'; ";
    $result_photoReineUser = pg_query($conn, $query);

    if (!$result_photoReineUser) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $infosPhoto = array();

    while($row = pg_fetch_assoc($result_photoReineUser)){

        $photo = array(
            "id_photo" => $row["id_photo"],
            "lien_photo" => $row["lien_photo"],
            "date_photo" => $row["date_publication_photo"],
            "pseudo_user" => $row["pseudo_utilisateur_photo"],
            "nombre_vote" => getNbVote($row["id_photo"]),
            "categorie_photo" => getCategorie($row["id_photo"])
        );
        array_push($infosPhoto, $photo); 
    }

    pg_close($conn);
    return $infosPhoto;


}



function getPhotoReines(){
    // connexion à la bd
    require 'connexion_bd.php';
    // récupération des photos gagnantes 
    $query = "SELECT id_Photo, lien_Photo, pseudo_utilisateur_Photo, id_concours_Photo, date_publication_Photo from photo P
    INNER JOIN concours on P.id_photo = concours.id_photo_gagnante_concours
    ORDER BY P.date_publication_Photo DESC;";
    $result_photoReine = pg_query($conn, $query);

    if (!$result_photoReine) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $infosPhoto = array();

    while($row = pg_fetch_assoc($result_photoReine)){

        $photo = array(
            "id_photo" => $row["id_photo"],
            "lien_photo" => $row["lien_photo"],
            "date_photo" => $row["date_publication_photo"],
            "pseudo_user" => $row["pseudo_utilisateur_photo"],
            "nombre_vote" => getNbVote($row["id_photo"]),
            "categorie_photo" => getCategorie($row["id_photo"])
        );
        array_push($infosPhoto, $photo); 
    }

    pg_close($conn);
    return $infosPhoto;


}

function getPhotoConcours($idc)
{
    require 'connexion_bd.php';

    $query = "SELECT id_photo  FROM photo P where P.id_concours_photo= $idc;";
    $result_idP = pg_query($conn, $query);

    if (!$result_photoReineUser) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }

    $listeIdPh = array();
    while($row = pg_fetch_assoc($result_idP)['id_photo']) {
        $listeIdPh[] = $row;

    }

    pg_close($conn);
    return $listeIdPh;
}








?>