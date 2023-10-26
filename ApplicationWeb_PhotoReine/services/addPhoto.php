<?php
    session_start(); 
    require "../services_acces_bd/connexion_bd.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifier s'il y a des erreurs lors du téléchargement
        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $tempFilePath = $_FILES['photo']['tmp_name'];
            $fileName = $_FILES['photo']['name'];
    
            // Spécifiez le dossier de destination sur votre ordinateur
            $destinationFolder = '../photos';
    
            // Déplacez le fichier temporaire vers le dossier de destination
            if (move_uploaded_file($tempFilePath, $destinationFolder . '/' . $fileName)) {
                echo "Le fichier a été téléchargé avec succès.";
            } else {
                echo "Une erreur s'est produite lors du déplacement du fichier.";
            }
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    }

    $query2 = "SELECT id_photo from photo;";
    $result_idP = pg_query($conn, $query2);
    if (!$result_idP) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }
    $idPhotos = array();
    while ($row = pg_fetch_assoc($result_idP)) {
        $idPhotos[] = $row['id_photo'];
    }
    function getRandomNumberNotInList($min, $max, array $excludeList) {
        $number = mt_rand($min, $max);
        
        while (in_array($number, $excludeList)) {
            $number = mt_rand($min, $max);
        }
        
        return $number;
    }

    $id_photo =  getRandomNumberNotInList(1, 999999999, $idPhotos);
    $lien_photo = '../../photos' . '/' . $_FILES['photo']['name'];
    $pseudo_user_photo = $_SESSION["pseudo_user"];
    $id_concours_photo = $_POST['id_concours_photo'];
    $date_photo = date('Y-m-d');
    $query = "INSERT INTO photo VALUES ($id_photo, '$lien_photo', '$pseudo_user_photo', $id_concours_photo, '$date_photo'); ";
    if (pg_query($conn, $query)) {
        echo "Votre photo a été enregistré avec succès.";
    } else {
        echo "Error: " . pg_last_error($conn) . "<br>";
    }

    pg_close($conn);
    header("Location: ../Affichage/php/page_categories_concours.php?concours=". $_POST['id_concours_photo']);
?>