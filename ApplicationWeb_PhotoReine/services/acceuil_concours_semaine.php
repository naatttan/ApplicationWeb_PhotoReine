<?php
    require "../services_acces_bd/getConcours.php";
    $date = '2023-05-15'; //date( "Y-m-d");
    echo json_encode(getConcoursSemaine($date));
?>