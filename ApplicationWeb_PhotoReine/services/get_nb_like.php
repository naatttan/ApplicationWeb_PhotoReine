<?php
    require "../services_acces_bd/getPhoto.php";
    $photo = $_POST["id_photo"];
    echo getNbVote($photo);
?>