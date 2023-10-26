<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si le fichier a été correctement uploadé
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
        // Récupérer les informations sur le fichier
        $name = $_FILES["photo"]["name"];
        $tmp_name = $_FILES["photo"]["tmp_name"];
        
        // Déplacer le fichier vers son emplacement final sur le serveur
        $destination = "chemin/vers/dossier/destination/" . $name;
        move_uploaded_file($tmp_name, $destination);
        
        echo "Le fichier a été uploadé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'upload du fichier.";
    }
}
?>
