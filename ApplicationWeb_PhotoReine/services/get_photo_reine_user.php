<?php
    require "../services_acces_bd/getPhoto.php";
    $pseudoUser = $_POST["userpseudo"];
    echo json_encode(getPhotoReineUser($pseudoUser));

?>