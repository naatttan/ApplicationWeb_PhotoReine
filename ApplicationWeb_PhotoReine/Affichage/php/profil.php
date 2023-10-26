<?php require '../../services/session.php';?>

<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<html>

<head>
    <meta charset="utf8" />
    <title>Profil</title>
    <meta name="author" content=" " />
    <link rel=stylesheet href="../css/profil.css">
    <link rel="stylesheet" href="../css/menu.css">
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

    <h1 id="profil"><b>Profil</b></h1>
    <h1 id="vousetesconnecte"><b>Vous êtes connectés</b></h1>
    <a id="deconnexion" href="../../services/close_session.php" class="mon-bouton">Déconnexion</a>

    <div id="informationsperso">
        <h2>Informations personnelles</h2>
        <br>
        <div class="container">
            <p class="texte">Adresse email</p>
            <p class="encadré"><?php echo $_SESSION['email_user']; ?></p>
        </div>
        <br>
        <br>
        <div class="container">
            <p class="texte">Nom d'utilisateur </p>
            <p class="encadré"><?php echo $_SESSION['pseudo_user']; ?></p>
        </div>
        <br>
        <br>
        <div class="container">
            <p class="texte">Date de naissance </p>
            <p class="encadré"><?php echo $_SESSION['datenaissance_user']; ?></p>
        </div>
        <br>
        <br>

        <button onclick="openPopupMDP()" class="mon-bouton">Modifier mot de passe</button>


        <div id="popup-mask"></div>

        <div id="myPopup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <div id="informationsperso">
                    <h2>Modifier le mot de passe</h2>
                    <form>
                        <label for="ancienpassword">Ancien mot de passe : </label>
                        <!--Faire une vérification-->
                        <input type="password" class="texte" id="ancienpassword" name="ancienpassword"
                            autocomplete="off" required>
                        <br>
                        <br>
                        <label for="newpassword">Nouveau mot de passe : </label>
                        <input type="password" class="texte" id="newpassword" name="newpassword" autocomplete="off"
                            required>
                        <br>
                        <br>
                        <label for="password">Confirmer mot de passe : </label>
                        <input type="password" class="texte" id="password" name="password" autocomplete="off" required>
                        <br><br>
                        <p id="reponse_serveur">
                        <p>

                            <button onclick="submitForm()" class="mon-bouton">Modifier mot de passe</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>


        <div id="popupSuppr" class="popupSuppr">
            <div class="popupSuppr-content">
                <span class="close" onclick="closePopupSuppr()">&times;</span>
                <div>
                    <h2>Etes vous sur de vouloir supprimer la photo</h2>
                    <form>
                        <button class="mon-bouton">Oui</button>
                        <button class="mon-bouton">Non</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>




        <script>
        function openPopupMDP() {
            $("#popup-mask").fadeIn();
            $("#reponse_serveur").html("")
            document.getElementById("myPopup").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("myPopup").style.display = "none";
            $("#popup-mask").fadeOut();
        }

        function openPopupSuppr() {
            $("#popup-mask").fadeIn();
            $("#reponse_serveur").html("")
            document.getElementById("popupSuppr").style.display = "flex";
        }

        function closePopupSuppr() {
            document.getElementById("popupSuppr").style.display = "none";
            $("#popup-mask").fadeOut();
        }

        function submitForm() {

            if ($("#ancienpassword").val() === "" || $("#newpassword").val() === "" || $("#password").val() === "") {
                $("#reponse_serveur").html("Vous n'avez pas rempli tous les champs");
                return;
            }
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "../../services/modifier_password.php",
                data: {
                    ancienpassword: document.getElementById("ancienpassword").value,
                    newpassword: document.getElementById("newpassword").value,
                    verifpassword: document.getElementById("password").value
                },
                success: function(resultat) {
                    // traitement des résultats renvoyés par la page PHP
                    console.log(resultat);
                    $("#reponse_serveur").html(resultat)
                }
            });
            closePopup();
        }
        </script>


        <br>
        <br>
        <br>
    </div>

    <?php
            if($_SESSION['admin_user'] == 't'){
                echo '<div id="administrateur">
                <h2>Administrateur</h2>
                <br>
                <button onclick="openPopupSign()" class="mon-bouton">Voir les photos signalées</button>
                <br><br>
                <button onclick="openPopupStat()" class="mon-bouton">Voir les statistiques</button>
                </div>';
            }
        ?>
    <div id="popup-mask"></div>

    <div id="myPopupSign" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopupSign()">&times;</span>
            <div id="signaler">

                <h2>Signalements</h2>
                <br>
                <script>
                $.ajax({
                    url: "../../services/get_photo_signaler.php"
                })
                </script>


                <div class=content>
                    <div class="categraison">
                        <p class="cat"><b>Catégorie : </b></p>
                        <p class="rais">Raison : </p>
                    </div>

                    <div id="photo">
                        <img id="photosign" src="../image/nature.jpg" />
                    </div>

                    <div id=boutons>
                        <button onclick="supprimerPhoto()" class="mon-bouton" id="suppression">Supprimer</button>
                        <br><br>
                        <button onclick="ignorer()" class="mon-bouton" id="ignorer">Ignorer</button>
                    </div>
                </div>
                <div class=content>
                    <div class="categraison">
                        <p class="cat"><b>Catégorie : </b></p>
                        <p class="rais">Raison : </p>
                    </div>

                    <div id="photo">
                        <img id="photosign" src="../image/nature.jpg" />
                    </div>

                    <div id=boutons>
                        <button onclick="supprimerPhoto()" class="mon-bouton" id="suppression">Supprimer</button>
                        <br><br>
                        <button onclick="ignorer()" class="mon-bouton" id="ignorer">Ignorer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myPopupStat" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopupStat()">&times;</span>
            <div id="statistiques">

                <h2>Statistiques</h2>
                <p>Nous attendons de recueillir plus de données afin de fournir les statistiques</p>
            </div>
        </div>
    </div>





    <script>
    function openPopupSign() {
        $("#popup-mask").fadeIn();
        $("#reponse_serveur").html("")
        document.getElementById("myPopupSign").style.display = "flex";
    }

    function closePopupSign() {
        document.getElementById("myPopupSign").style.display = "none";
        $("#popup-mask").fadeOut();
    }

    function openPopupStat() {
        $("#popup-mask").fadeIn();
        $("#reponse_serveur").html("")
        document.getElementById("myPopupStat").style.display = "flex";
    }

    function closePopupStat() {
        document.getElementById("myPopupStat").style.display = "none";
        $("#popup-mask").fadeOut();
    }
    </script>








    <div id="mesphotospubliées">
        <h2 class="mesphotos">Mes Photos publiées</h2>
        <br>
        <div class="galerie-photos" id="galerie-photos-publiees">
            <script>
            $.ajax({
                url: "../../services/get_photo_user.php",
                type: "POST",
                data: {
                    userpseudo: '<?php echo $_SESSION["pseudo_user"]; ?>'
                },
                success: function(response) {
                    photos = JSON.parse(response);
                    // console.log(photos.photos)
                    for (var i = 0; i < photos.photos.length; i++) {
                        var $photoContainer = $("<div>").addClass("photo-container");

                        $photoContainer.append('<img class="photos-galerie" src="' + photos.photos[
                                i]
                            .lien_photo + '">');
                        $photoContainer.append(
                            '<img onclick="openPopupSuppr()" class="bouton-supprimer-galerie" src="../image/poubelle.png">'
                        );
                        $("#galerie-photos-publiees").append($photoContainer);
                        // $("#galerie-photos-publiees").append('<img class="photos-galerie" src="' + photos.photos[i].lien_photo + '">')
                        // $("#galerie-photos-publiees").append('<img class="bouton-supprimer-galerie" src="../image/poubelle.png">')
                        // console.log(photos.photos[i].lien_photo)
                    }
                }
            });
            </script>
        </div>
        <!--<p id="categ">Nature</p>
         <img id="photo" src="nature.jpg">-->



    </div>
    <div id="mesphotosreines">
        <h2 class="mesphotos">Mes Photos Reines</h2>
        <br>
        <div class="galerie-photos" id="galerie-photos-reines">
            <script>
            $.ajax({
                url: "../../services/get_photo_reine_user.php",
                type: "POST",
                data: {
                    userpseudo: '<?php echo $_SESSION["pseudo_user"]; ?>'
                },
                success: function(response) {
                    photos = JSON.parse(response);
                    console.log(photos)
                    for (var i = 0; i < photos.length; i++) {
                        var $photoContainer = $("<div>").addClass("photo-container");
                        var divTexte = $("<div class='texte-image'>" + photos[i].date_photo +
                            "</div>");
                        $photoContainer.append('<img class="photos-galerie" src="' + photos[i]
                            .lien_photo +
                            '">');
                        $photoContainer.append(
                            '<img onclick="openPopupSuppr()" class="bouton-supprimer-galerie" src="../image/poubelle.png">'
                        );
                        // $photoContainer.append(divtexte);
                        $("#galerie-photos-reines").append($photoContainer);
                    }
                }
            });
            </script>
        </div>
        <!--  <p id="categ">Nature</p>
        <img id="photo" src="nature.jpg">-->
    </div>


</body>

</html>
</doctype>