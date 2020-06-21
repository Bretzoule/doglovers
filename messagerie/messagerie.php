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

  <?php

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  function phpAlert($msg)
  {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  }

  $erreur = false;
  if (($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET["user"]))) {
    $_SESSION["user"] = $_GET["user"];
    $user = $_SESSION["user"];
  } else if (!isset($_SESSION["user"])) {
    phpAlert("Aucun utilisateur en base.");
  } else {
    $user = $_SESSION["user"];
  }

   // Merci stack Overflow - https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
   function startsWith($haystack, $needle)
   {
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
   }

  ?>
  <body>
    <!--Début bloc de présentation-->
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Profil de <?php echo ($_SESSION["user"]); ?></h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="../home/accueil.php">Accueil</a></li>
        <li><a href="./../profil/profil.php?user=<?php echo $_SESSION["user"]; ?>">Infos <?php echo ($_SESSION["user"]); ?></a></li>
        <?php if (intval($_SESSION['login_Type']) >= 2) { ?>
        <li><a class="active" href="">Conversation avec <?php echo $_SESSION["user"]; ?></a></li>
        <?php } ?>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
        <?php if (intval($_SESSION['login_Type']) === 3) { ?>
          <li><a <?php echo "href='../admin/bannir/bannir.php?user=". $user ."'"?>>Bannir <?php echo ($user); ?></a></li>
          <li><a <?php echo "href='../admin/bannir/debannir.php?user=". $user ."'"?>>Debannir <?php echo ($user); ?></a></li>
          <li><a <?php echo "href='../admin/bannir/supprimerCompte.php?user=". $user ."'"?>>Supprimer <?php echo ($user); ?></a></li>
        <?php } ?>
      </ul>
    </div>
    <!--Fin bloc de présentation-->
    <?php
    $banned = false;
    $canSend = true;
    $lastvalue = true;
    $path = "./../register/data/userList.txt"; // chemin fichier utilisateur
    $file = fopen($path, 'r'); // ouverture du fichier
    if ($file) { // si le fichier est bien ouvert alors
      $lastvalue = true;
      while ((($line = fgets($file)) !== false) && $lastvalue) { // on récupère chaque ligne tant que l'on trouve pas l'utilisateur
        $userData = explode("§", $line); // séparation des données de la ligne utilisateur
        //echo "|" . trim($_SESSION["adresseM"]) . "| == |" . trim($userData[sizeof($userData)-2]) . "| <br>";
        if ($userData[0] == $user) { // si le pseudo match avec une entrée en BDD
          if ($userData[sizeOf($userData) - 6] == "banned") {
            $banned = true;
          }
          // if($userData[sizeOf($userData) - 6] == "free") {
          //   $canSend = false;
          // }
          $lastvalue = false;
        }
      }
      fclose($file);
    } else {
      phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
    }
    $messageValide = true;
    if (isset($_SESSION["user"])) { //&& $canSend) {
      //on recupère les deux pseudos
      $nomFichier = array($_SESSION['pseudo'], $_SESSION['user']);
      //on les tri par ordre alphabétique
      usort($nomFichier, "strnatcmp");
      //on écrit le tableau pour vérifier

      if (empty($_POST["message"]) || $_POST["message"] == "0") {
        $messageValide = false;
      } else {
        $message = test_input($_POST["message"]);
        if (!preg_match("/[^§]+/", $message)) {
          $erreurMessage = "Le Message contient des caractères interdits.";
          $messageValide = false;
        }
      }
      //print_r($nomFichier);
      //on met dans content ce qu'on veut écrire dans le fichier
      $heure = date("H:i");
      ////////////////////////////////////
      $contenu = file_get_contents('destinataires_' . $user . '.txt');
      $nomDestinataireBloque = explode('|', $contenu);
$b = 0;
$destinataireBloque = false;
while(($b < sizeof($nomDestinataireBloque) - 1) && !$destinataireBloque){
  $destinataireBis = explode("_",$nomDestinataireBloque[$b]);
      if(isset($destinataireBis[1]) && $destinataireBis[1]=="bloqué"){
        echo("Cet utilisateur vous a bloqué, vous ne pouvez pas lui envoyer de message.");
$destinataireBloque = true;
      }
      $b++;
    }
      ////////////////////////////////
      if ($messageValide) {
        $content = $heure . " " . $_SESSION['pseudo'] . " : " . $message . "§" . uniqid($_SESSION['pseudo'] . "_") . "\n";
        //on met le contenu dans le fichier nommé pseudo1_pseudo2.txt avec pseudo1 et 2 triés par ordre alphabétique
        //le fichier est créé s'il n'éxiste pas
        file_put_contents($nomFichier[0] . '_' . $nomFichier[1] . '.txt', $content, FILE_APPEND);
      if (file_exists('destinataires_' . $_SESSION['pseudo'] . '.txt') && $messageValide) {

        //on gere le fichier destinataires
        $contenu = file_get_contents('destinataires_' . $_SESSION['pseudo'] . '.txt');
        $nomDestinataire = explode('|', $contenu);
        $i = 0;
        $destinataireTrouve = false;
        $destinataire = $_SESSION['user'];
        while (($i < sizeof($nomDestinataire) - 1) && !$destinataireTrouve) {
          /////////////////////////
          $destinataireBis = explode("_",$nomDestinataire[$i]);
          if ($destinataireBis[0] == $destinataire) {
            $destinataireTrouve = true;
          }
          //////////////////////
          $i++;
        }
        if (!$destinataireTrouve) {
          $destinataire = $_SESSION['user'] . '|';
          file_put_contents('destinataires_' . $_SESSION['pseudo'] . '.txt', $destinataire, FILE_APPEND);
        }
      } else {
        $destinataire = $_SESSION['user'] . '|';
        file_put_contents('destinataires_' . $_SESSION['pseudo'] . '.txt', $destinataire, FILE_APPEND);
      }
    if (file_exists('destinataires_' . $_SESSION['user'] . '.txt') && $messageValide) {

      //on gere le fichier destinataires
      $contenu = file_get_contents('destinataires_' . $_SESSION['user'] . '.txt');
      $nomDestinataire = explode('|', $contenu);
      $i = 0;
      $destinataireTrouve = false;
      $destinataire = $_SESSION['pseudo'];
      while (($i < sizeof($nomDestinataire) - 1) && !$destinataireTrouve) {
        if ($nomDestinataire[$i] == $destinataire) {
          $destinataireTrouve = true;
        }
        $i++;
      }
      if (!$destinataireTrouve) {
        $destinataire = $_SESSION['pseudo'] . '|';
        file_put_contents('destinataires_' . $_SESSION['user'] . '.txt', $destinataire, FILE_APPEND);
      }
    } else {
      $destinataire = $_SESSION['pseudo'] . '|';
      file_put_contents('destinataires_' . $_SESSION['user'] . '.txt', $destinataire, FILE_APPEND);
    }
  }
    ?>
      <form accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

        <div id="textConv">Conversation :</div>

        <div id="blocConv">
          <?php
          $leChemin = $nomFichier[0] . '_' . $nomFichier[1] . '.txt';
          if (file_exists($leChemin)) {
            //on récupère le contenu du fichier à savoir la conversation
            $conversation = file_get_contents($leChemin);
            $nbrMsg = explode("\n", $conversation);
            $j = 0;
            while (($j < count($nbrMsg) - 1)) {
              /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
        récupérer les différentes données présentes dans chaque ligne*/
              $message = explode('§', $nbrMsg[$j]);
              if (startsWith($message[1],$_SESSION["pseudo"] . "_")) {
                echo "<div class ='user1' onclick='deleteMsg(" . '"' . $message[1] . '"' .",". '"' . $leChemin . '"' . ")'>" . $message[0] . "</div> <br> ";
              } else {
                echo "<div class ='user2' onclick='reportMsg(" . '"' . $message[1] . '"' .",". '"' . $leChemin . '"' . ")'>" . $message[0] . "</div> <br> ";
              }
              $j++;
            }
          } else {
            echo ("<span> Pour démarrer la conversation, envoyez un message ! ☺ </span> <br>");
          }
          ?>
          <?php if (!$lastvalue) {
            if ($banned) { ?>
              <span> Cet utilisateur est banni, il ne recevra vos message qu'à son débanissement.</span> <br>
            <?php } ?>
            <div id="inputEnvoie">
              <input name="message" type="text" pattern="[^§]+" value="" placeholder="Ecrire un message" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /><br>
              <div class="part_boutons">
                <!--partie boutons-->
                <input type="submit" value="Envoyer "></input>
              </div>
              <!--fin partie boutons-->
            </div>

          <?php } else { ?>
            <span>Cet utilisateur n'existe plus.... il a supprimé son profil</span> <br>
            <span>Vous pouvez choisir de supprimer la conversation via ce boutton : <a href='./supprimerConversation.php?user=<?php echo $user; ?>'><input type='button' id='bouton2' value='Supprimer'> </span>
          <?php } ?>
        </div>

      </form>
  </body>

  </html>
<?php
    } else{
  echo "<span>Vous ne pouvez pas communiquer avec cet utilisateur, il n'est pas abonné ou alors ce compte n'exite pas.</span>";
}
    unset($_POST['message']);
    //unset($_SESSION['user']);
  } else {
    header("Location: /home/accueil.php");
  }
?>
