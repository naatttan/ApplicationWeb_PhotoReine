<?php
    require 'session.php';
    require "../services_acces_bd/connexion_bd.php";

    $ancienPassword = $_POST['ancienpassword'];
    $newPassword = $_POST['newpassword'];
    $verifPassword = $_POST['verifpassword'];
    $pseudo_user = $_SESSION["pseudo_user"];

    if($newPassword != $verifPassword){
        echo "Le nouveau mot de passe n'est pas le meme dans les 2 champs";
        return;
    }


    $query = "SELECT pseudo_user, mdp_user 
                FROM utilisateur U
                WHERE U.pseudo_user = '$pseudo_user'; ";
    $result_photoReineUser = pg_query($conn, $query);

    if (!$result_photoReineUser) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        return;
    }

    $row = pg_fetch_assoc($result_photoReineUser);
    $password_bd =  $row['mdp_user'];

    if($ancienPassword == $password_bd){
        echo "mdp bon";
        return;
    }
    echo "pas bon";

?>