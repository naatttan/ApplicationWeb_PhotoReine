<?php session_start(); ?>
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
    $.ajax({
        type: "POST",
        url: "../../services/espace_concours.php",
        success: function(resultat) {
            concours = JSON.parse(resultat);
            console.log(concours)
            $.each(concours, function(index, conc) {
                var concoursDiv = $('<div>').addClass('concours');
                var p1 = $('<p>').text('Concours ' + conc.categorie + ':');
                var p2 = $('<p>').addClass('aflexer');
                $.each(conc.photos, function(index, photo) {
                var img = $('<img>').addClass('photo-bande-concours').attr('src', photo.lien_photo);
                p2.append(img);
                });
                var button = $('<button>').addClass('bouton').text('Suite >>>>>>').attr('onclick', "location.href='page_categories_concours.php?concours=" + conc.id_concours +"'");
                p2.append(button);
                concoursDiv.append(p1, p2);
                $('main').append(concoursDiv);
            });
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
        
    </main>
</body>

</html>