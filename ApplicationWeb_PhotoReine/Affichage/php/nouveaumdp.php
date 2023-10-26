<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8" />
    <title>Modifier votre mot de passe</title>
    <meta name="author" content=" " />
    <link rel=stylesheet href="profil.css">
</head>

<body>

    <div id="informationsperso">
        <h2>Modifier le mot de passe</h2>
        <div class="container">
            <label for="ancienpassword">Ancien mot de passe : </label> <!--Faire une vérification-->
            <input type="password" class="texte" name="ancienpassword" required>
            <br>
            <br>
            <label for="password">Nouveau mot de passe : </label>
            <input type="password" class="texte" name="password" required>
            <br>
            <br>
            <label for="password">Confirmer mot de passe : </label>
            <input type="password" class="texte" name="password" required>
            <!--Vérification que les nouveau mdp sont les memes-->
        </div>
        <br>
        <button onclick="fermerFenetre()" class="mon-bouton">Modifier mot de passe</button>
        <script>
            function fermerFenetre() {
                window.close();
            }
        </script>
        <!--modification de la base de données-->
    </div>
</body>