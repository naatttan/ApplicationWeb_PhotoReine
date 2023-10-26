<?php
require "../services_acces_bd/connexion_bd.php";
require "../services_acces_bd/getMondayDate.php";
require "../services_acces_bd/getPhoto.php";

$date = '2023-04-10'; //date('Y-m-d');
$weekDates = getWeekDates($date);
$query = "SELECT id_photo from photo P
          where P.date_publication_photo IN $weekDates ";

$idPs = pg_query($conn, $query);
if (!$idPs){
    echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";      
}
$photos = array();

while($row = pg_fetch_assoc($idPs)){
    $idphoto = $row['id_photo'];
    array_push($photos, $idphoto); 
}

$sid= 0;
$smax = 0;
foreach ($photos as $id){
    $nbVote = getNbVote($id);
    if ($nbVote > $smax){
        $sid = $id;
        $smax = $nbVote;
    }
}
// if ($sid != 0) {
//     echo json_encode(getInfosPhoto($sid));
// }
// else{
//     echo "Aucune photo n'est pas publié pour cette semaine";
// }

echo json_encode(getInfosPhoto($sid));

?>