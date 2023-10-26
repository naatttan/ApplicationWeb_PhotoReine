<?php
session_start();
require '../services_acces_bd/connexion_bd.php';

if (isset($_POST['submit'])) {

    $email_user = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT email_user, pseudo_user, mdp_user, datenaissance_user, admin_user, expert_user
                FROM Utilisateur U
                WHERE U.email_user = '$email_user';";
    $result_user = pg_query($conn, $query);

    if (!$result_user) {
    echo "Une erreur s'est produite lors de l'acces à la base de donnée.\n";
    exit;
    }

    $row = pg_fetch_assoc($result_user);

    if (!$row) {
        echo "Aucun utilisateur trouvé avec cet email.";
        exit;
    }

    $password_bd = $row["mdp_user"];
    $email_bd = $row["email_user"];


    // Vérifier si les identifiants sont corrects
    if ($email_user == $email_bd && $password == $password_bd) {
        // Identifiants corrects, connecter l'utilisateur
        $_SESSION['pseudo_user'] = $row["pseudo_user"];
        $_SESSION['email_user'] = $row["email_user"];
        $_SESSION['datenaissance_user'] = $row["datenaissance_user"];
        $_SESSION['admin_user'] = $row["admin_user"];
        $_SESSION['expert_user'] = $row["expert_user"];

        header('Location: ../Affichage/php/profil.php');
        exit();
    } else {
        // Identifiants incorrects, afficher un message d'erreur
        header('Location: ../Affichage/php/connexion.php');
    }
}
?>