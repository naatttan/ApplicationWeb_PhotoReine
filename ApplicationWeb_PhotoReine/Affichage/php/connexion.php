<!DOCTYPE html>

<head>
  <title>
    Connexion
  </title>
  <link rel="stylesheet" href="../css/connexion.css">
  <link rel="stylesheet" href="../css/menu.css">
</head>

<body>

  <main>
    <div id="cote-connexion">
      <img id="icon" src="../image/icon-utilisateur.jpg" alt=" icon utilisateur en couleur" />
      <form class="form-connexion" action="../../services/login.php" method="POST">
          <h1 id="H1">Connexion</h1>
          <label for="email">Adresse e-mail:</label>
          
          <input type="email" id="email" name="email" required>
          <br><br>
          <label for="password">Mot de passe:</label>
          <input type="password" id="password" name="password" required>
          <br><br>
          <a href="./resetMDP.html" id="resetMDP">Mot de passe oublié</a>
          <br><br>

          <button id="connexion" type="submit" name="submit">CONNEXION</button>
      </form>
    </div>

</body> 