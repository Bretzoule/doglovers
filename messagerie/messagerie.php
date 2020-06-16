<?php
//on démarre une session
session_start();
//if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
    <link rel="stylesheet" type="text/css" href="./../profil/monProfil/MonProfil.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <!--Début bloc de présentation-->
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Profil de <?php echo ($user); ?></h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="../home/accueil.php">Accueil</a></li>
        <li><a class="active" href="">Infos <?php echo ($user); ?></a></li>
        <?php
        if (intval($_SESSION["login_Type"]) >= 2) { ?>
          <li><a href="">Envoyer un message à <?php echo ($user); ?></a></li>
        <?php } ?>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
        <?php if(intval($_SESSION['login_Type']) === 3){ ?>
          <li><a href="../admin/bannir/bannir.php">Bannir <?php echo ($user); ?></a></li>
            <li><a href="../admin/supprimerCompte.php">Supprimer <?php echo ($user); ?></a></li>
          <?php } ?>
      </ul>
    </div>
<!--Fin bloc de présentation-->



  </body>

  </html>
<?php
/*} else {
  header("Location: /home/accueil.php");
}*/
?>
