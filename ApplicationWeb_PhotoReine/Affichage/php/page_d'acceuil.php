
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
        url: "../../services/photoReine.php",
        success: function(resultat) {
            // traitement des résultats renvoyés par la page PHP
            concours = JSON.parse(resultat)
            console.log(concours);
            $('#categorie-photo-reine').html("Pour la catégorie " + concours[0].categorie_photo + " est")
            $('#photo-gagnante').attr('src', concours[0].lien_photo)
            $('#legende-photo-gagnant').html("Photo de " + concours[0].pseudo_user)
            updateComs(concours[0].id_photo)
        }
    });


    $.ajax({
        type: "POST",
        url: "../../services/acceuil_concours_semaine.php",
        success: function(resultat) {
            // traitement des résultats renvoyés par la page PHP
            concours = JSON.parse(resultat)
            // console.log(concours);
            photosDiv = $('#photos-concours');
            annonceDiv = $('#annonce-concours'); 
            concours.forEach(function(category) {
                photoDiv = $('<div>').addClass('div-photos');
                img = $('<img>').addClass('photo-partie-concours').attr('src', category.image_categorie);
                legende = $('<p>').addClass('legende-photo-concours').text(category.categorie);
                
                photoDiv.append(img).append(legende);
                photosDiv.append(photoDiv);
            });
            annonceDiv.find('ul').empty(); // On vide les éléments existants
            concours.forEach(function(category) {
                annonceDiv.find('ul').append($('<li>').text(category.categorie.toLowerCase()));
            });

        }
    });

    function updateComs($idPhoto) {
        $.ajax({
            type: "POST",
            url: "../../services/espace_photo.php",
            data: {
                id_photo: $idPhoto,
            },
            success: function(resultat) {
                photos = JSON.parse(resultat);
                console.log(photos)
                // $('#commentaires').empty()
                for (var i = 0; i < photos.commentaires.length; i++) {
                    $('#commentaires').append("<p>" + photos.commentaires[i]['pseudo_user'] + ": " + photos.commentaires[i]['texte_commentaire']) + "</p></br>";
                }
            }
        });
    }

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
        <div id="partie-gagnants">
            <div id="annonce-gagnant">
                <!-- ici il faut mettre le code php pour avoir la photo reine de la base de donnee -->
                <h1>
                    La Photo Reine
                </h1>
                <h2 id="categorie-photo-reine"></h2>
                <img id="bulle-commentaire" src="../image/bulle.png" alt="icon de bulle de commentaire">
                <div id='commentaires'>
                    <!--code php manquant-->
                </div>
                <a class="ajout-commentaire" href=""> Ajouter un commentaire...</a>
                <br><br><br>
                <a class="bouton" href="pages_gagnants.php">Liste des gagnants</a>
                <br><br><br>
            </div>
            <div id="partie-photo-gagnante">
                <img id="photo-gagnante">
                <p id="legende-photo-gagnant"></p>
            </div>
        </div>
        <!-- ici il faudra mettre le code php qui recupere les cotegerie de la semaine qui sont misent en jeux -->
        <div class="partie-concours-de-la-semaine">
            <div id="photos-concours">
            </div>

            <div id="annonce-concours">
                <h2>Les concours de la semaine</h2>
                Pour cette semaine les concours en jeu sont:
                <ul>
                </ul>
                A vos appareils photo !
                <br><br>
                <a class="bouton" href="espace_concours.php">Lien vers les concours</a>
            </div>
        </div>
    </main>
</body>

</html>