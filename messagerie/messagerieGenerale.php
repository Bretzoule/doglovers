<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
    <link rel="stylesheet" type="text/css" href="./messagerieGenerale.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <!--Début bloc de présentation-->
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Messagerie de <?php echo ($_SESSION["pseudo"]); ?></h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="../home/accueil.php">Accueil</a></li>
        <!--<li><a href="./../profil/profil.php?user=<?php /*echo ($_SESSION["user"]);?>">Infos <?php echo ($_SESSION["user"]); */ ?></a></li>-->
        <li><a class="active" href="">Conversations</a></li>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
      </ul>
    </div>
    <!--Fin bloc de présentation-->

    <form accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

      <div id="textConv">Conversations</div>
      <div id="listeConv">
        <div class="titreConv">
          Retrouvez ici les derniers messages de chaque conversation.
        </div>
        <?php
        if ($_SESSION["login_Type"] >= 2) {
          if (file_exists('destinataires_' . $_SESSION['pseudo'] . '.txt')) {
            $conversation = file_get_contents('destinataires_' . $_SESSION['pseudo'] . '.txt');
            $destinataire = explode("|", $conversation);
            $i = 0;
            while ($i < sizeof($destinataire) - 1) {
              $nomFichier = array($_SESSION['pseudo'], $destinataire[$i]);
              //on les tri par ordre alphabétique
              usort($nomFichier, "strnatcmp");
              $messages = file_get_contents($nomFichier[0] . '_' . $nomFichier[1] . '.txt');
              $dernierMessage = explode("\n", $messages);
        ?>
              <a <?php echo "href='../messagerie/messagerie.php?user=" . $destinataire[$i] . "'" ?>><?php echo ($destinataire[$i]) ?></a>
        <?php
              //echo sizeof($dernierMessage);
              //$dernierMessage = array_filter($dernierMessage);
              $dernierMessageFlat = explode("§", $dernierMessage[sizeof($dernierMessage) - 2]);
              echo ($dernierMessageFlat[0] . "<br>");
              $i++;
            }
          } else {
            echo ("<span> Pour démarrer une conversation avec quelqu'un, rendez-vous sur son profil !</span>");
          }
        } else {
          echo "<span>Vous n'êtes pas abonnés... Pour voir vos messages, veuillez-vous abonner !</span>";
        }
        ?>
      </div>
    </form>
  </body>

  </html>
<?php
  unset($_POST['message']);
} else {
  header("Location: /home/erreur403.php");
}
?>