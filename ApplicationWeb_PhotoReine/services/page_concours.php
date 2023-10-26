<?php
    session_start();
    require "../services_acces_bd/getConcours.php";
    $idConcours = $_POST["id_concours"];
    $user_co = $_SESSION['pseudo_user'];
    echo json_encode(getConcours($idConcours, $user_co));
?>