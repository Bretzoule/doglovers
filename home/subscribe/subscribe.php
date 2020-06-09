<?php
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>
    <?php 
    function getDateFinAbonnement(string $username):string {
      $path = "./../../register/data/userList.txt";
      $file = fopen($path, 'r');
      if ($file) {
          $lastvalue = true;
          while ((($line = fgets($file)) !== false) && $lastvalue) {
              $userData = explode("§", $line);
              if ((trim($_SESSION["Pseudo"]) == trim($userData[0]))) {
                $tmpdate = explode(':',trim($userData[sizeof($userData)-6]));
                $date = $tmpdate[1];
                $lastvalue = false;
              }
          }
          fclose($file);
      } else {
          phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
      }
      return $date;
    }
    ?>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Accueil</title>
    <link rel="stylesheet" type="text/css" href="./subscribe.css">
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
        <li class="deconnexion"><a href="./../../login/logout.php">Deconnexion</a></li>
      </ul>
    </div>
    <div id="page">
      <h2 id='titreTab'> Formules d'abonnement</h2>
      <div id="BlocInfo">
        <span id="titreInfo"> Gratuit</span> <br>
        <span> <?php if ($_SESSION["login_Type"] == 1) { echo "votre type d'abonnement en cours."; }?> </span> <br>
        <span id="titreInfo"> Abonné </span> <br>
        <span> <?php if ($_SESSION["login_Type"] == 2) { echo "votre type d'abonnement en cours. <br>"; 
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
