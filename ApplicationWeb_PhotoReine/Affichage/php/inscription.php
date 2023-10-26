
<!DOCTYPE html>

<head>
  <title>
    Inscription
  </title>
  <link rel="stylesheet" href="../css/inscription.css">
  <link rel="stylesheet" href="../css/menu.css">
</head>

<body>

  <main>
    <div id="cote-inscription">
      <form>
        <P><img id="icon" src="../image/icon-utilisateur.jpg" alt="icon utilisateur en couleur" /></P>
        <h1 id="H1">Inscription</h1>
        <p><label for="prenom">Prénom:</label>
          <input type="prenom" id="prenom" name="prenom" required>
        </p>
        <p>
          <label for="nom">Nom:</label>
          <input type="nom" id="nom" name="nom" required>
        </p>
        <p><label for="email">Adresse e-mail:</label>
          <input type="email" id="email" name="email" required>
        </p>
        <p>
          <label for="nom-utilisateur">Nom d'utilisateur:</label>
          <input type="nom-utilisateur" id="nom-utilisateur" name="nom-utilisateur" required>
        </p>
        <p><label for="date-naissance">Date de naissance:</label>
          <input type="date" id="date-naissance" name="date-naissance" required>
        </p>
        <p>
          <label for="password">Mot de passe:</label>
          <input type="password" id="password" name="password" required>
        </p>
        <p>
          <label for="confpassword">Confirmation mot de passe:</label>
          <input type="password" id="confpassword" name="confpassword" required>
        </p>
        <br>
        <p id="reponse_serveur">
        </br>
        </form>
        <button onclick="submitFormInsc()" id="inscription">INSCRIPTION</button>
    </div>

  </main>
</body>