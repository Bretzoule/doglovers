<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) == 3)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Outils d'administration</title>
    <link rel="stylesheet" type="text/css" href="/messagerie/messagerieGenerale.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
    <script type="text/javascript" src="./messagerieAdmin.js"></script>
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
      <h1>Outils d'administration</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="../home/accueil.php">Accueil</a></li>
        <?php if (intval($_SESSION['login_Type']) >= 2) { ?>
        <li><a class="active" href="">Aperçu conversation</a></li>
        <li><a href="/admin/membres.php">Liste des Utilisateurs</a></li>
        <li><a href="/admin/reports/listeReports.php">Liste des Signalements</a></li>
        <?php } ?>
      </ul>
    </div>
    <!--Fin bloc de présentation-->
        <div id="textConv">Conversation :</div>

        <div id="blocConv">
          <?php
           if (($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET["convID"]))) {
            $leChemin = "./../../messagerie/" . $_GET["convID"];
            $tmpFileName = explode("_",$_GET["convID"]);
          if (file_exists($leChemin)) {
            //on récupère le contenu du fichier à savoir la conversation
            $conversation = file_get_contents($leChemin);
            $nbrMsg = explode("\n", $conversation);
            $j = 0;
            while (($j < count($nbrMsg) - 1)) {
              /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
        récupérer les différentes données présentes dans chaque ligne*/
              $message = explode('§', $nbrMsg[$j]);
              if (startsWith($message[1],$tmpFileName[0] . "_")) {
                echo "<div class ='user1' onclick='deleteMsg(" . '"' . $message[1] . '"' .",". '"' . $_GET["convID"] . '"' . ")'>" . $message[0] . "</div> <br> ";
              } else {
                echo "<div class ='user2' onclick='deleteMsg(" . '"' . $message[1] . '"' .",". '"' . $_GET["convID"] . '"' . ")'>" . $message[0] . "</div> <br> ";
              }
              $j++;
            }
          } else {
            echo ("Le fichier n'existe pas.");
          }
          ?>
              </div>
              <!--fin partie boutons-->
            </div>

          <?php } else { ?>
            <span> Vous n'avez pas renseigné de fichier.</span>
          <?php } ?>
        </div>
  </body>

  </html>
<?php
    //unset($_SESSION['user']);
  } else {
    header("Location: /home/accueil.php");
  }
?>
