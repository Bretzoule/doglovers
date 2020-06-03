<!-- Enregistrement des inscirts -->
<?php
session_start();
function phpAlert($msg)
{
  echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

function checkAlreadyRegistered()
{
  $lastvalue = true;
  $file = fopen('./data/userList.txt', 'r');
  if ($file) {
    while ((($line = fgets($file)) !== false) && $lastvalue) {
      $userData = explode("§", $line);
      echo trim("|" . $_SESSION["pseudo"]) . "| == |" . trim($userData[sizeof($userData) - 2]) . "|";
      if ((trim($_SESSION["pseudo"]) == trim($userData[sizeof($userData) - 2])) || (trim($_SESSION["adresse"]) == trim($userData[1]))) {
        $_SESSION["erreur"] = "login_existant";
        $lastvalue = false;
      }
    }
    fclose($file);
    return($lastvalue);
  } else {
    phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
  }
}

//on démarre la session

if (isset($_SESSION["dataPassed"]) && ($_SESSION["dataPassed"] == "true")) {
  if (checkAlreadyRegistered()) {
    if ($_SESSION['enfants'] == "on") {
      $nbrEnfants = $_SESSION['nombreEnf'];
    } else {
      $nbrEnfants = "0";
    }
    if ($_SESSION['chiens'] == "on") {
      $nbrDoggos = $_SESSION['nbDoggos'];
      $infosChiens = $_SESSION['infoschiens'];
    } else {
      $nbrDoggos = "0";
      $infosChiens = "";
    }
    //on récupère les données de l'inscrit dans une variable
    $content = $_SESSION['nom'] . "|" . $_SESSION['prenom'] .
      "§" . $_SESSION['adresse'] . "|" . $_SESSION['lieures']
      . "§" . $_SESSION['sexe'] . "§" . $_SESSION['dateNaissance'] . "§" . $_SESSION['profession']
      . "§" . $_SESSION['situation'] . "|" . $nbrEnfants
      . "§" . $_SESSION['poids'] . "|" . $_SESSION['taille'] . "|" . $_SESSION['couleurCheveux'] . "|" . $_SESSION['couleurYeux']
      . "§" . $_SESSION['msgAcc'] . "§" . $_SESSION['citation'] . "§" . $_SESSION['interets'] . "§" . $_SESSION['fumeur']
      . "§" . $nbrDoggos . "|" . $infosChiens
      . "§" . $_SESSION['photos']
      . "§" . "free" . "§" . date("Y-m-d") . "§" . uniqid($prefix = "user_")
      . "§" . $_SESSION['pseudo'] . "§" . password_hash($_SESSION['password'], PASSWORD_DEFAULT) . "\r\n";
    //on écrit ce que contient la variable dans le fichier nommé userList.txt
    //FILE_APPEND permet d'écrire à la suite du fichier
    file_put_contents('./data/userList.txt', $content, FILE_APPEND);
    // remove all session variables
    session_unset();
    session_destroy();
    session_start();
    $_SESSION["inscrit"] = "success";
    header('location: /login/login.php');
  }
} else {
  header('Location: /erreurs/forbidden.php');
}
?>