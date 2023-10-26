<?php
    require "../services_acces_bd/getConcours.php";
    $date = date( "Y-m-d");
    echo json_encode(getAffichageConcours($date));
?>