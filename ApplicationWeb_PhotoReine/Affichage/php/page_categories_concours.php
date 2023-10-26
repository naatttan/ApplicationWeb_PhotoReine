<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!DOCTYPE html>

<head>
    <title>
        Photo Reine
    </title>
    <link rel="stylesheet" href="../css/stylee.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/poster_photo.css">


</head>

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
        <div id="titre-gauche">
        </div>
        <div id="bouton-droite">
            <button onclick="openPopupPoste()" class="bouton">Poster une photo</button>

            <div id="popup-mask"></div>
            <div id="myPopup" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopupPoste()">&times;</span>
                    <div id="posterphoto">
                        <br>
                        <h2>Poster une photo</h2>
                        <form action="../../services/addPhoto.php" method="POST" enctype="multipart/form-data">
                            <p id="texte">Télécharger une photo au format jpg</p>
                            <label class="custom-file-upload">
                                <input type="hidden" name="id_concours_photo" value="<?php echo $_GET['concours']; ?>">
                                <input type="file" name="photo" id="photo" required onchange="updateFileName()">
                                <img id="boutontelecharger" src="../image/bouton-telecharger.png" />
                            </label>
                            <p id="file-name"></p>
                            <br><br>
                            <input id="publier" class="mon-bouton" type="submit" name="submit" value="Publier la photo">
                        </form>
                        <script>
                        function updateFileName() {
                            var fileInput = document.getElementById("photo");
                            var fileName = document.getElementById("file-name");
                            fileName.textContent = fileInput.files[0].name;
                        }
                        </script>


                    </div>
                </div>
            </div>


            <script>
            function openPopupPoste() {
                $("#popup-mask").fadeIn();
                $("#reponse_serveur").html("")
                document.getElementById("myPopup").style.display = "flex";
            }

            function closePopupPoste() {
                document.getElementById("myPopup").style.display = "none";
                $("#popup-mask").fadeOut();
            }
            </script>

        </div>


        <script>
        $id_concours = <?php echo $_GET['concours']; ?>

        $.ajax({
            type: "POST",
            url: "../../services/page_concours.php",
            data: {
                id_concours: $id_concours,
            },
            success: function(resultat) {
                concours = JSON.parse(resultat);
                console.log(concours)
                $("#titre-gauche").append("<h1 id='pageconcours'>Page concours catégorie " + concours
                    .categorie + "</h1>")
                // $('#commentaires').empty()
                for (var i = 0; i < concours.photos.length; i++) {
                    $('#les-photos-des-categories').append('<div class="div-photos">' +
                        '<img class="photo-categorie-concours" onclick="openPopupPhoto(' + concours
                        .photos[i]['id_photo'] + ')" src="' + concours.photos[i][
                            'lien_photo'
                        ] + '">' +
                        '<p class="legende-photo-categorie">Photo de ' + concours.photos[i][
                            'pseudo_utilisateur'
                        ] + '</p>' +
                        '<p class="like" id="like-photo' + concours.photos[i]['id_photo'] + '">' +
                        concours.photos[i]['nombre_vote'] +
                        ' <img  onclick="voterPhoto('+ concours.photos[i]['id_photo'] +')" id="like'+ concours.photos[i]['id_photo'] +'" class="icon-like"  alt="icon like"></p>' +
                        '<p class="ajout-commentaire">Ajouter un commentaire...</p>' +
                        '</div>');
                        if(concours.photos[i]['is_liked'] == 'f'){
                            $('#like'+ concours.photos[i]['id_photo']).attr('src', '../image/like.png')
                        }else{
                            $('#like'+ concours.photos[i]['id_photo']).attr('src', '../image/like_rouge.png')
                        }
                        
                }
            }
        });

        // voterPhoto(4)
        function voterPhoto($idPhoto){
            $.ajax({
                type: "POST",
                url: "../../services/voterPhoto.php",
                data: {
                    id_photo: $idPhoto,
                },
                success: function(resultat) {
                    console.log(resultat)
                    updateNbVote($idPhoto, resultat);
                }
            });
        }

        function updateNbVote($idPhoto, $val) {
            $.ajax({
                type: "POST",
                url: "../../services/get_nb_like.php",
                data: {
                    id_photo: $idPhoto,
                },
                success: function(resultat) {
                    console.log(resultat)
                    if ($val == 'f') {
                        $('#like-photo' + $idPhoto).html(resultat +
                            ' <img onclick="voterPhoto('+ $idPhoto +')" class="icon-like" src="../image/like.png" alt="icon like">')
                    } else {
                        $('#like-photo' + $idPhoto).html(resultat +
                            ' <img onclick="voterPhoto('+ $idPhoto +')" class="icon-like" src="../image/like_rouge.png" alt="icon like">')
                    }
                }
            });
        }

        function openPopupPhoto($idPhoto) {
            $.ajax({
                type: "POST",
                url: "AfficherPhoto.php",
                data: {
                    idPhoto: $idPhoto,
                },
                success: function(resultat) {
                    console.log($idPhoto)
                    console.log(resultat)
                    $('#popupPhoto-content').append(resultat)
                }
            });

            openPopupP()
            // $('#popupPhoto-content script').each(function() {
            //     $.globalEval($(this).text());
            // });
            // fetch('AfficherPhoto.php?idPhoto=' + $idPhoto)
            // .then(response => response.text())
            // .then(data => {
            //     document.getElementById('popupPhoto-content').innerHTML = data;
            // });
            // openPopup()

        }

        function openPopupP() {
            $("#popupPhoto-mask").fadeIn();
            document.getElementById("myPopupPhoto").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("myPopupPhoto").style.display = "none";
            $("#popupPhoto-mask").fadeOut();
        }
        </script>


        <div id="popupPhoto-mask"></div>

        <div id="myPopupPhoto" class="popupPhoto">
            <div id="popupPhoto-content">
                <span class="close" onclick="closePopup()">&times;</span>
            </div>
        </div>


        <div id="les-photos-des-categories">
            <!--ici il'y aura les photos de la base de donnée-->
        </div>
    </main>
</body>


</html>