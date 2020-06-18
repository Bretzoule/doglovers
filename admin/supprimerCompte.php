<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) == 3)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Supprimer un compte</title>
    <link rel="stylesheet" type="text/css" href="bannir/bannir.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Supprimer</h1>
    </div>
    
    <?php

    // Merci stack Overflow - https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
    function startsWith($haystack, $needle)
    {
      $length = strlen($needle);
      return (substr($haystack, 0, $length) === $needle);
    }

  function removePic(string $photo)
  {
    $photo = explode("|", $photo);
    for ($i=0; $i < 4; $i++) {
    if (!empty($photo[$i])) {
      $response = unlink("./.." . $photo[$i]);
    }
    }
  }

  function resetMatches(string $nomuser)
  {
    $path = "./../register/data/matchs.txt"; // chemin fichier utilisateur
    $contenu = file_get_contents($path);
    $contenuLigne = explode("\n", $contenu);
    for ($i=0; $i < (sizeOf($contenuLigne)-2); $i++) {
      if (startsWith($contenuLigne[$i], $nomuser)) {
        $contenuLigne[$i] = "";
      } else if (strrpos($contenuLigne[$i], $nomuser) !== false) {
        $part2 = explode("§", $contenuLigne[$i]);
        for ($j=1; $j < sizeOf($part2); $j++) {
          print_r($part2);
          if (strrpos($part2[$j], $nomuser) !== false) {
            $part2[$j] = "";
            $part2 = array_filter($part2);
          }
        }
        array_filter($part2);
        $contenuLigne[$i] = implode("§",$part2);
      }
    }
    $contenuLigne = array_filter($contenuLigne);
    $contents = implode("\n",$contenuLigne);
    file_put_contents($path,$contents);
  }
  
      $user = $_GET["user"];
      $lastvalue = true;
      $path = "./../register/data/userList.txt"; // chemin fichier utilisateur
      $file = fopen($path, 'r'); // ouverture du fichier
      if ($file) { // si le fichier est bien ouvert alors
        while ((($line = fgets($file)) !== false) && $lastvalue) { // on récupère chaque ligne tant que l'on trouve pas l'utilisateur
          $userData = explode("§", $line); // séparation des données de la ligne utilisateur
          if ($userData[0] == $user) {
            $contents = file_get_contents($path);
            removePic($userData[sizeof($userData) - 7]);
            resetMatches(trim($userData[0]));
            $userData = "";
            $contents = str_replace($line, $userData, $contents);
            file_put_contents($path, $contents);
            $lastvalue = false;
          }
        }
        fclose($file);
      }
    //Données modifiables :
    ?>
    <div class="menu">
      <ul>
        <li><a href="../home/accueil.php">Retour à l'accueil</a></li>
      </ul>
    </div>
    <?php
    if (!$lastvalue) { ?>
      <h1>Vous avez supprimé le compte de <?php echo $user; ?>!</h1>
    <?php } else { ?>
      <h1>Vous ne pouvez pas supprimer le compte de <?php echo $user; ?> ou cet utilisateur n'existe pas !</h1>
    <?php } ?>

  </html>
<?php
} else {
  header("Location: /home/accueil.php");
}
?>