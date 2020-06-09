<?php
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>
    <?php 
    function getDateFinAbonnement(string $username):string {
      return "hello world";
    }
    ?>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Accueil</title>
    <link rel="stylesheet" type="text/css" href="./subscribe.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Accueil</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a class="active" href="./accueil.php">Accueil</a></li>
        <li><a class="active" href="../profil/MonProfil.php">Mon profil</a></li>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
      </ul>
    </div>
    <div id="page">
      <h2 id='titreTab'> Formules d'abonnement</h2>
      <div id="BlocInfo">
        <span id="titreInfo"> Gratuit</span> <br>
        <span> <?php if ($_SESSION["login_type"] == 1) { echo "votre type d'abonnement en cours."; }?> </span> <br>
        <span id="titreInfo"> Abonné </span> <br>
        <span> <?php if ($_SESSION["login_type"] == 2) { echo "votre type d'abonnement en cours. <br>"; 
          echo "jusqu\'au" . getDateFinAbonnement($_SESSION["pseudo"]);
        }?> </span> <br>
      </div>
    </div>
  </body>

  </html>
<?php
} else {
  header('Location: ./../errors/erreur403.php');
}
?>
