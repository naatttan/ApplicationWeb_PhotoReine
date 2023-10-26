<?php
session_start();
if(!isset($_SESSION['pseudo_user'])){
    header("Location: connexion-inscription.php"); // Rediriger vers la page de connexion
    exit();
}
?>
