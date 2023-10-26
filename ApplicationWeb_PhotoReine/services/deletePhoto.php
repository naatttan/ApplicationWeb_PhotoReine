<?php
    require "../services_acces_bd/connexion_bd.php";
    $id_photo = $_POST['id_photo'];
    
    $query = "DELETE FROM photo WHERE id_photo = $id_photo;";
    if (!pg_query($conn, $query)) {
        echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
        exit;
    }
    pg_close($conn);
?>