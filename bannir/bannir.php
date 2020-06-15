<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
  <!--  <link rel="stylesheet" type="text/css" href="./monProfil/MonProfil.css">-->
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>

    <?php
    function remplacementData(array $userData):array
    {
      $userData[13] = "banned";
      return $userData;
    }
    $lastvalue = true;
    $path = "./../register/data/userList.txt"; // chemin fichier utilisateur
    $file = fopen($path, 'r'); // ouverture du fichier
    if ($file) { // si le fichier est bien ouvert alors
    while ((($line = fgets($file)) !== false) && $lastvalue) { // on récupère chaque ligne tant que l'on trouve pas l'utilisateur
        $userData = explode("§", $line); // séparation des données de la ligne utilisateur
        if($userData[0]==$_SESSION["user"]){
            $contents = file_get_contents($path);
            $userData = remplacementData($userData);
            $userData = implode("§",$userData);
            $contents = str_replace($line,$userData,$contents);
            file_put_contents($path, $contents);
            $lastvalue = false;
          }
    }
    fclose($file);
header("Location: /profil/MonProfil.php");
  }

  ?>
</body>

</html>
<?php
} else {
header("Location: /home/accueil.php");
}
?>
