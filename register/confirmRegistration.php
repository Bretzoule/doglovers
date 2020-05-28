<!-- Enregistrement des inscirts -->
<?php

//on démarre la session
if ($_SESSION["dataPassed"] = "true") {
  session_start();
  if ($_SESSION['enfants'] == "on") {
    $nbrEnfants = $_SESSION['nombreEnf'];
  } else {
    $nbrEnfants = "0";
  }
  if ($_SESSION['chiens'] == "on") {
    $nbrDoggos = $_SESSION['nbDoggos'];
    $infosChien = $_SESSION['infoschiens'];
  } else {
    $nbrDoggos = "0";
    $infosChien = "";
  }
  //on récupère les données de l'inscrit dans une variable
  $content = $_SESSION['nom'] . "|" . $_SESSION['prenom'] .
    "§" . $_SESSION['adresse'] . "|" . $_SESSION['lieures']
    . "§" . $_SESSION['sexe'] . "§" . $_SESSION['dateNaissance'] . "§" . $_SESSION['profession']
    . "§" . $_SESSION['situation'] . "|" . $nbrEnfants
    . "§" . $_SESSION['poids'] . "|" . $_SESSION['taille'] . "|" . $_SESSION['couleurCheveux'] . "|" . $_SESSION['couleurYeux']
    . "§" . $_SESSION['msgAcc'] . "§" . $_SESSION['citation'] . "§" . $_SESSION['interets'] . "§" . $_SESSION['fumeurs']
    . "§" . $nbrDoggos . "|" . $infosChiens
    . "§" . $_SESSION['photo'] 
    . "§" . "free" . "§" . date("Y-m-d") . "§" . uniqid ($prefix = "user_")
    . $_SESSION['pseudo'] . "§" . password_hash($_SESSION['password'],PASSWORD_DEFAULT) . " \r\n";
  //on écrit ce que contient la variable dans le fichier nommé userList.txt
  //FILE_APPEND permet d'écrire à la suite du fichier
  file_put_contents('userList.txt', $content, FILE_APPEND);
  // remove all session variables
  session_unset();
  session_destroy();
  header('location: /login/login.php');
} else {
  header('Location: /erreurs/forbidden.php');
}
?>