<?php
    session_start();
    require "../services_acces_bd/connexion_bd.php";
    require "../services_acces_bd/likerphoto.php";
    $id_photo_V = $_POST["id_photo"];
    $pseudo_user_V = $_SESSION['pseudo_user'];    
    likerPhoto($id_photo_V, $pseudo_user_V)
?>