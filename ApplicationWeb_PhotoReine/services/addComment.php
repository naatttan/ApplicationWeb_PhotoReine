<?php
    session_start(); 
    require "../services_acces_bd/connexion_bd.php";

    $id_photo_comment = $_POST["id_photo"]; //jsp si c bon la
    $text_comment = $_POST["texte_commentaire"];
    $date_comment = date( "Y-m-d");
    $pseudo_user_comment = $_SESSION["pseudo_user"];


    if (empty($text_comment)) {
    // Si le champ de commentaire est vide, on affiche un message d'erreur
    echo "il faut ajouter de texte !!";
    }
    else {
        $query = "INSERT INTO commentaire VALUES ('$pseudo_user_comment', $id_photo_comment, '$date_comment', '$text_comment')";
        if (pg_query($conn, $query)) {
            echo "Votre commentaire a été enregistré avec succès.";
        } else {
            echo "Error: " . $query . "<br>";
        }
    }

    pg_close($conn);
?>