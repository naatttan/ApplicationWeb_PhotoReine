<?php
    require "../services_acces_bd/getPhoto.php";
    require "../services_acces_bd/getCommentaire.php";
    require "../services_acces_bd/getConseil.php";
    $idP = $_POST["id_photo"];
    $combined_list = array(
        'photo' => getInfosPhoto($idP),
        'commentaires' => getCommentaires($idP) ,
        'conseils' => getConseils($idP)
    );
    echo json_encode($combined_list);


    /*

    Le fichier json va étre sous cette forme.
        {"photo":["
            "id_photo" => "id_photo",
            "lien_photo" => "lien_photo",
            "date_photo" => "date_publication_photo",
            "pseudo_user" => "pseudo_utilisateur_photo",
            "nombre_vote" => nbvotes),
            "categorie_photo" => Categorie "],
         "commentaires":[""
            pseudo_user" => "pseudo_utilisateur_commentaire",
            "date_commentaire" => "date_commentaire",
            "texte_commentaire" => "texte_commentaire"],
         "conseils":[
            "pseudo_user" => "pseudo_utilisateur_conseil",
            "date_commentaire" => "date_conseail",
            "texte_commentaire" => "texte_conseil"]
        }
*/
?>


