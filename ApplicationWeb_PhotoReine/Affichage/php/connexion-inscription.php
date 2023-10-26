<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

</script>
<!DOCTYPE html>
<head>
    <title>
        Connexion / Inscription
    </title>
    <link rel="stylesheet" href="../css/connexion-inscription.css">
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

    <main>
        <div id="cote-utilisateur">
            <script>
            function submitFormInsc(){
                // event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../../services/create_user.php",
                    data: {
                        email: document.getElementById("email").value,
                        password: document.getElementById("password").value,
                        confpassword: document.getElementById("confpassword").value,
                        prenom: document.getElementById("prenom").value,
                        nom: document.getElementById("nom").value,
                        'nom-utilisateur': document.getElementById("nom-utilisateur").value,
                        'date-naissance': document.getElementById("date-naissance").value
                    },
                    success: function(resultat) {
                        if(resultat == 't')
                        window.location.href = "profil.php";
                    }
                });
                }

            function afficherConnexion() {
                fetch('connexion.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('cote-utilisateur').innerHTML = data;
                    });
            }

            function afficherInscription() {
                fetch('inscription.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('cote-utilisateur').innerHTML = data;
                    });
            }
            </script>
            <div id="utilisateur-connecte">
                <img class="icon" src="../image/icon-utilisateur.jpg" alt="icon utilisateur en couleur" />
                <div class="droite">
                    <h1>
                        J'ai déjà un compte...
                    </h1>
                    <button id="connexion" onclick="afficherConnexion()">CONNEXION</button>
                </div>
            </div>
            <div id="utilisateur-noninscri">
                <img class="icon" src="../image/icon-utilisateur.jpg" alt="icon utilisateur en couleur" />
                <div class="droite">
                    <h1>
                        Je n'ai pas de compte!
                    </h1>
                    <button id="inscription" onclick="afficherInscription()">INSCRIPTION</button>
                </div>
            </div>
        </div>


        <div id="bar-concours">
            <h2>
                Les concours de la semaine
            </h2>
            <p>Pour cette semaine, les concours en jeu sont :</p>
            <ul>
                <li>nature</li>
                <li>portrait</li>
                <li>animal</li>
            </ul>
            <p>A vos appareils photos...</p><br>
            <button class="lien-concours">Lien vers les concours</button>
            <BR><br>
            <h2>
                Les concours de la semaine dernière
            </h2>
            <p>Les concours en jeu la semaine dernière étaient : </p>
            <ul>
                <li>autoportrait</li>
                <li>paysage</li>
                <li>insecte</li>
            </ul><br>
            <button class="lien-concours">Lien vers les photos reines</button>
            <br><br><br>
        </div>


    </main>

</body>

</html>