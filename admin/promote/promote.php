<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) == 3)) { ?>
  <!DOCTYPE html>
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Ajouter un admin</title>
    <link rel="stylesheet" type="text/css" href="../bannir/bannir.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Promouvoir</h1>
    </div>

    <?php

    $user = $_GET["user"];
    function remplacementData(array $userData): array // remplace le statut de l'utilisateur par "admin" - promouvoit l'utilisateur au rang d'admin
    {
      $userData[13] = "admin";
      return $userData;
    }
    $lastvalue = true;
    if (trim($user) != trim($_SESSION["pseudo"])) {
      $path = "./../../register/data/userList.txt"; // chemin fichier utilisateur
      $file = fopen($path, 'r'); // ouverture du fichier
      if ($file) { // si le fichier est bien ouvert alors
        while ((($line = fgets($file)) !== false) && $lastvalue) { // on récupère chaque ligne tant que l'on trouve pas l'utilisateur
          $userData = explode("§", $line); // séparation des données de la ligne utilisateur
          if ($userData[0] == $user) { // si l'utilisateur correspond
            $contents = file_get_contents($path);
            $userData = remplacementData($userData); // promote admin
            $userData = implode("§", $userData);  
            $contents = str_replace($line, $userData, $contents);
            file_put_contents($path, $contents);
            $lastvalue = false;
          }
        }
        fclose($file);
      }
    }
    ?>
    <div class="menu">
      <ul>
        <li><a href="/home/accueil.php">Retour à l'accueil</a></li>
      </ul>
      </ul>
    </div>

    <div class="messBannir">
      <?php
      if (!$lastvalue) { ?>
        <h1>Vous avez elevé <?php echo $user; ?> au rang d'administrateur!</h1>
      <?php } else { ?>
        <h1>Vous ne pouvez pas promouvoir <?php echo $user; ?> ou cet utilisateur n'existe pas !</h1>
      <?php } ?>
    </div>

  </body>

  </html>
<?php
} else {
  header("Location: /home/accueil.php");
}
?>
