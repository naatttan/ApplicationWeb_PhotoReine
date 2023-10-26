<?php
require 'vendor/autoload.php';

use Cron\CronExpression;

// Création d'une instance de CronExpression avec l'expression cron pour chaque lundi à 00:00
$cronExpression = new CronExpression('0 0 * * 1');

// Vérification si la date actuelle correspond à l'expression cron
if ($cronExpression->isDue()) {
    exec('updateExpert.php');
    exec('stocker_photo_reine.php');
} else {
    echo "Pas encore l'heure...";
}

?>