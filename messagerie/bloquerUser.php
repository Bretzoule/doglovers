<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) >= 2)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
    <link rel="stylesheet" type="text/css" href="./messagerieGenerale.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
    <script type="text/javascript" src="messagerie.js"></script>
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["user"])) {
    $user = trim($_GET["user"]);
  $destinataire = file_get_contents('destinataires_'.$_SESSION['pseudo'].'.txt');
  $destinataireBis = explode('|',$destinataire);
  $i = 0;
  $destinataireTrouve = false;
  while(($i < sizeOf($destinataireBis)) && !$destinataireTrouve){
if($destinataireBis[$i]==$user){
  $destinataireTrouve = true;
  $destinataireBis[$i].="_bloqué";
}
$i++;
  }
  $donnee = implode("|",$destinataireBis);
file_put_contents('destinataires_'.$_SESSION['pseudo'].'.txt',$donnee);
 header("Location: /messagerie/messagerieGenerale.php");
}
 ?>

</body>
</html>
<?php
} else {
header("Location: /home/erreur403.php");
}
?>
