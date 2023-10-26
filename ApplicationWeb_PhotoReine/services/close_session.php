<?php
session_start();    
session_unset(); 
session_destroy();


header("Location: ../Affichage/php/connexion-inscription.php");
exit();

?>