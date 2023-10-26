<?php
    session_start(); 
    require "../services_acces_bd/connexion_bd.php";

    $id_photo_conseil = $_GET["id_photo"]; //jsp si c bon la
    $text_conseil = $_POST["texte_commentaire"];
    $date_conseil = date( "Y-m-d");
    $pseudo_expert_conseil = $_SESSION["pseudo_user"];
    
    // Vérifier que l'utilisateur est un expert
    $query = "select expert_user from utilisateur U
    where U.pseudo_user= '$pseudo_expert_conseil';";
    $result_expert = pg_query($conn, $query);
    if (!$result_expert) {
        echo "Une erreur s'est produite lors de la connexion à la base de donnée. 2\n";
        exit;
    }
    $expert = pg_fetch_assoc($result_categoriePhoto);

    if ($expert == false){
        echo "vous n'avez pas le droit de donner un conseil";
    }
    else{


        if (empty($text_comment)) {
            // Si le champ de conseil est vide, on affiche un message d'erreur
            echo "il faut ajouter de texte !!";
        } else {
            $query = "INSERT INTO commentaire VALUES ('$pseudo_expert_conseil', $id_photo_conseil,
            '$date_conseil', '$text_conseil')";
            if (pg_query($conn, $query)) {
                echo "Votre conseil a été enregistré avec succès.";
            } else {
                echo "Error: " . $query . "<br>";
            }
        }
    }

    pg_close($conn);

?>