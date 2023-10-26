<?php

function getPreviousMonday($date) {
  $timestamp = strtotime($date);
  $dayOfWeek = date('N', $timestamp);
  
  if ($dayOfWeek == 1) {
    return date('Y-m-d', $timestamp);
  } else {
    return date('Y-m-d', strtotime('last Monday', $timestamp));
  }
}


function getPreviousWeekMonday($date){

  $timestamp = strtotime($date); // conversion en timestamp Unix
  $dayOfWeek = date("N", $timestamp); // récupération du numéro du jour de la semaine (1 pour lundi, 7 pour dimanche)
  $daysToSubtract = $dayOfWeek - 1 + 7; // calcul du nombre de jours à soustraire pour atteindre le lundi de la semaine précédente
  $timestamp -= $daysToSubtract * 86400; // soustraction du nombre de jours en secondes
  $dateLundiSemainePrecedente = date("d-m-Y", $timestamp); // conversion du timestamp en date formatée

  return $dateLundiSemainePrecedente;
}



function getWeekDates($date) {

  $monday_date =getPreviousMonday($date);
  $monday_timestamp = strtotime($monday_date); // Convertit la date du lundi en un timestamp UNIX
  $week_dates = array(); // Initialise un tableau vide pour stocker les dates de la semaine
  
  // Ajoute la date du lundi au tableau
  $week_dates[] = date('Y-m-d', $monday_timestamp);
  
  // Ajoute les dates des jours suivants de la semaine
  for ($i = 1; $i <= 6; $i++) {
      $next_day_timestamp = strtotime("+{$i} day", $monday_timestamp);
      $week_dates[] = date('Y-m-d', $next_day_timestamp);
  }
  
  return "('" . implode("','", $week_dates) . "')";
}
?>