<?php
    require "../services_acces_bd/getConcours.php";
    require "../services_acces_bd/getPhoto.php";
    $date = date('Y-m-d');
    $concours = getConcoursSemaineprec($date);
    $idCs = array_column($concours, 'id_concours');

    //Comme on est sur qu'on a que 3 concours par semaine
    $photos_cnc1= getPhotoConcours($idCs[0]);
    $photos_cnc2= getPhotoConcours($idCs[1]);
    $photos_cnc3= getPhotoConcours($idCs[2]);

    $id_photo_reines = array();
    $L_id1 = array();
    $L_nbv1 = array();
    foreach($photos_cnc1 as $id){
        $Lid1[]=$id;
        $L_nbv1[] = getNbVote($id);
    }
    $maxnbv1 = max($L_nbv1);
    $indexP1 =  array_search($maxnbv1, $L_nbv1);
    $id_photo_reines[0] = $Lid1[$indexP1];


    $L_id2 = array();
    $L_nbv2 = array();
    foreach($photos_cnc2 as $id){
        $Lid2[]=$id;
        $L_nbv2[] = getNbVote($id);
    }
    $maxnbv2 = max($L_nbv2);
    $indexP2 =  array_search($maxnbv2, $L_nbv2);
    $id_photo_reines[1] = $Lid2[$indexP2];

    $L_id3 = array();
    $L_nbv3 = array();
    foreach($photos_cnc3 as $id){
        $Lid3[]=$id;
        $L_nbv3[] = getNbVote($id);
    }
    $maxnbv3 = max($L_nbv3);
    $indexP3 =  array_search($maxnbv3, $L_nbv3);
    $id_photo_reines[2] = $Lid3[$indexP3];

    
    require "../services_acces_bd/connexion_bd.php";
    $query = "UPDATE Concours SET id_photo_gagnante_Concours = $id_photo_reines[0] WHERE id_concours = $idCs[0];
              UPDATE Concours SET id_photo_gagnante_Concours = $id_photo_reines[1] WHERE id_concours = $idCs[1];
              UPDATE Concours SET id_photo_gagnante_Concours = $id_photo_reines[2] WHERE id_concours = $idCs[2];";

    if(!pg_query($conn, $query2)) {
        echo "Error: " . $query . "<br>";
    }

    pg_close($conn);


?>