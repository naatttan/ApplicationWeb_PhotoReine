<?php
    function inscrire($psuedoUser, $prenomUser, $nomUser, $emailUser, $mdpUser, $dateNaissance ){
        require 'connexion_bd.php';
        
        $query = "INSERT INTO utilisateur VALUES ('$psuedoUser','$prenomUser', '$nomUser', '$emailUser', '$mdpUser', '$dateNaissance', 'false', 'false' ); "; 

        // echo 'test';
        if (pg_query($conn, $query)) {
            pg_close($conn);
            return 't';
        }else{
            pg_close($conn);
            return 'f';
        }
        
    }
?>