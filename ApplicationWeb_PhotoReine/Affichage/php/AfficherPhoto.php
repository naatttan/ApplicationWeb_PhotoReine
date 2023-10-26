<?php session_start(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8" />
    <title>Afficher la photo sélectionnée</title>
    <meta name="author" content=" " />
    <link rel="stylesheet" href="../css/afficherPhoto2.css">
</head>



<script>
$idPhoto = <?php echo $_POST['idPhoto']?>

$.ajax({
    type: "POST",
    url: "../../services/espace_photo.php",
    data: {
        id_photo: $idPhoto,
    },
    success: function(resultat) {
        photos = JSON.parse(resultat);
        console.log(photos)
        $('#imageaff').attr('src', photos.photo[0]['lien_photo'])
        $('#pseudo').append("<p>Photo de <i>" + photos.photo[0]['pseudo_user'] + "</i>")
        $("#nblike").html(photos.photo[0]['nombre_vote'])
        for (var i = 0; i < photos.commentaires.length; i++) {
            $('#commentaires').append('<div>' +
                "<h1>" + photos.commentaires[i]['pseudo_user'] + ": </h1>" +
                "<p>" + photos.commentaires[i]['texte_commentaire'] + "</p>" +
                "</div>");
        }
    }
});


function updateComs() {
    $.ajax({
        type: "POST",
        url: "../../services/espace_photo.php",
        data: {
            id_photo: $idPhoto,
        },
        success: function(resultat) {
            photos = JSON.parse(resultat);
            $('#commentaires').empty()
            for (var i = 0; i < photos.commentaires.length; i++) {
                $('#commentaires').append('<div>' +
                    "<h1>" + photos.commentaires[i]['pseudo_user'] + ": </h1>" +
                    "<p>" + photos.commentaires[i]['texte_commentaire'] + "</p>" +
                    "</div>");
            }
        }
    });

}

function addComment() {

    $.ajax({
        type: "POST",
        url: "../../services/addComment.php",
        data: {
            id_photo: $idPhoto,
            texte_commentaire: $('#comment-box').val(),
        },
        success: function(resultat) {
            updateComs()
        }
    });

}
</script>


<body>
    <div class="container">
        <div class="haut">
            <div id="photo">
                <img id="imageaff" />
                <div id="pseudo">
                </div>

                <div id="like">
                    <p id="nblike"></p>
                    <img src="../image/like.png" id="boutonlike" />
                </div>
            </div>

            <div id="espacecommentaire">
                <div id="commentaires">

                    <img src="../image/bulle.png" id="bulle" />
                    <br>
                </div>

                <div class="comment-box-container">
                    <textarea id="comment-box" rows="4" cols="50" placeholder="Entrez un commentaire"></textarea>
                    <button onclick='addComment()' id="btn-envoyer">></button>
                </div>

                <br>
            </div>
        </div>
    </div>
    <button onclick="openPopupSign()" class="mon-bouton">Signaler</button>

    <div id="popup-mask"></div>

    <div id="myPopupSign" class="popup">
        <div class="popupSign-content">
            <span class="close" onclick="closePopupSign()">&times;</span>
            <div id="signalement">
                <h2 id="signalement">Raison du signalement</h2>
                <select id="menu-deroulant">
                    <option value="" selected disabled>Sélectionner</option>
                    <option value="option1">Photo innapropriée</option>
                    <option value="option2">Mauvaise catégorie</option>
                </select>
                <br><br>
                <button onclick="submitForm()" class="mon-bouton">Valider</button>

                <script>
                var menuDeroulant = document.getElementById('menu-deroulant');
                var boutonValider = document.getElementById('valider');

                // Ajouter un écouteur d'événements pour détecter le changement de sélection
                menuDeroulant.addEventListener('change', function() {
                    var optionSelectionnee = menuDeroulant.value;

                    // Vérifier si l'option sélectionnée est l'option par défaut
                    if (optionSelectionnee === "") {
                        boutonValider.disabled = true; // Désactiver le bouton Valider
                    } else {
                        boutonValider.disabled = false; // Activer le bouton Valider
                    }
                });
                // Ajouter un écouteur d'événements pour le clic sur le bouton Valider
                boutonValider.addEventListener('click', function() {
                    var optionSelectionnee = menuDeroulant.value;

                    // Vérifier si l'option sélectionnée est l'option par défaut
                    if (optionSelectionnee === "") {
                        console.log('Aucune option sélectionnée');
                    } else {
                        console.log('Option sélectionnée : ' + optionSelectionnee);
                        // Ajoutez votre logique ici pour traiter l'option sélectionnée
                    }
                });
                </script>
                <br>
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



        function submitForm() {

            //      if ($("#ancienpassword").val() === "" || $("#newpassword").val() === "" || $("#password").val() === "") {
            //        $("#reponse_serveur").html("Vous n'avez pas rempli tous les champs");
            //      return;
            //         }
            //       event.preventDefault();

            //     $.ajax({
            //       type: "POST",
            //     url: "../../services/modifier_password.php",
            //          data: {
            //            ancienpassword: document.getElementById("ancienpassword").value,
            //          newpassword: document.getElementById("newpassword").value,
            //        verifpassword: document.getElementById("password").value
            //             },
            //           success: function(resultat) {
            // traitement des résultats renvoyés par la page PHP
            //             console.log(resultat);
            //           $("#reponse_serveur").html(resultat)
            //     }
            //       });
            //    closePopup();
        }
        </script>


        </script>

    </div>



</body>

</html>

</div>


</body>