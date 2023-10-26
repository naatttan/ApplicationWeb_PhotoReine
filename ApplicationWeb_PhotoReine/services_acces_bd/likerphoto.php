<?php
function likerPhoto($idPhoto, $userVote)
{

    // connexion à la bd
    require 'connexion_bd.php';

    //vérifier si la photo a un like
    $query =    "SELECT * from vote V
                where V.id_photo_vote = $idPhoto
                and V.pseudo_utilisateur_vote = '$userVote';";
    $like = pg_query($conn, $query);
    // echo 'test';
    if (pg_num_rows($like) > 0) {
        $query1 = "DELETE FROM vote V WHERE V.pseudo_utilisateur_vote = '$userVote'	and V.id_photo_vote = $idPhoto;";
        if(!pg_query($conn, $query1)) {
            echo "Error: " . $query . "<br>";
        };
        // pg_close($conn);
        echo "f";
    } else {
        $query2 = "INSERT INTO vote VALUES ('$userVote', $idPhoto);";
        // pg_close($conn);
        if(!pg_query($conn, $query2)) {
            echo "Error: " . $query . "<br>";
        };
        echo "t";
    }
    pg_close($conn);
}

function verifierLike($idPhoto , $userVote){
    // connexion à la bd
    require 'connexion_bd.php';
    //vérifier si la photo a un like
    $query =    "SELECT * from vote V
                where V.id_photo_vote = $idPhoto
                and V.pseudo_utilisateur_vote = '$userVote';";
    $like = pg_query($conn, $query);
    // echo 'test';
    if (pg_num_rows($like) > 0) {
        return 't';
    }else{
        return 'f';
    }
}
?>