<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!DOCTYPE html>

<head>
    <title>
        Photo Reine
    </title>
    <link rel="stylesheet" href="../css/stylee.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
</head>
<script>
$id_concours = 4

$.ajax({
    type: "POST",
    url: "../../services/pageGagnante.php",
    data: {
        id_concours: $id_concours,
    },
    success: function(resultat) {
        photos = JSON.parse(resultat);
        console.log(photos)
        for (var i = 0; i < photos.length; i++) {
            $('#photos-page-gagnants').append('<div class="div-photos">' +
                '<img class="photo-categorie-concours" src="' + photos[i]['lien_photo'] + '">' +
                '<p class="legende-photo-categorie">Photo de ' + photos[i]['pseudo_user'] + '</p>' +
                '<p class="date">' + photos[i]['date_photo'] + '</p>' +
                '<p class="legende-photo-gagnant">' + photos[i]['categorie_photo'] + '</p>' +
                '</div>');
        }
    }
});
</script>


<body>


    <nav>
        <div class="container">
            <ul class="menu">
                <li><a class="bouton" href="espace_concours.php">CONCOURS</a></li>
                <li><a class="bouton" href="pages_gagnants.php">GAGNANTS</a></li>
                <li><a class="bouton" href="profil.php">PROFIL</a></li>
            </ul>
            <div class="logoicon">
                <a href="page_d'acceuil.php"><img id="logo" src="../image/photoreine.png"
                        alt="logo de la page web en couleur" /></a>
                <a href="connexion-inscription.php"><img id="icon-nav" src="../image/icon-utilisateur.jpg"
                        alt="icon utilisateur en couleur" href="#" /></a>
            </div>
        </div>
        <br>
        <hr>
    </nav>
    <main>
        <div>
            <h1>Page gagnants</h1>
        </div>
        <div id="photos-page-gagnants">

        </div>
    </main>
</body>

</html>