<?php
require '../services_acces_bd/connexion_bd.php';
require '../services_acces_bd/inscrire.php';

if (isset($_POST['email'])) {

    $email_user = $_POST['email'];
    $password = $_POST['password'];
    $password_verif = $_POST['confpassword'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $pseudo = $_POST['nom-utilisateur'];
    $naissance = $_POST['date-naissance'];

    if($password != $password_verif){
        echo "La confirmation du mot de passe n'est pas bonne";
        return;
    }
    $reponse = inscrire($pseudo, $prenom, $nom, $email_user, $password, $naissance );

    // Vérifier si les identifiants sont corrects
    if ($reponse == 't') {
         session_start();
        // Identifiants corrects, connecter l'utilisateur
        $_SESSION['pseudo_user'] = $pseudo;
        $_SESSION['email_user'] = $email_user;
        $_SESSION['datenaissance_user'] = $naissance;
        $_SESSION['admin_user'] = 'f';
        $_SESSION['expert_user'] = 'f';

        // header('Location: ../Affichage/php/profil.php');
        echo 't';
        exit();
    } else {
        // Identifiants incorrects, afficher un message d'erreur
        echo "Erreur veuillez reesayer";
    }
}
?>