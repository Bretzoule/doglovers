<!-- Enregistrement des inscirts -->
<html>
<head>
<link rel="stylesheet" type="text/css" href="PoudlArel.css" />
</style>
</head>
<body>

<?php
//on démarre la session
session_start();
if ($_SESSION['enfants'] == "on"){
  $nbrEnfants = $_SESSION['nombreEnf'];
}else{
  $nbrEnfants = "0";
}
if($_SESSION['chiens'] == "on"){
   $nbrDoggos = $_SESSION['nbDoggos'];
   $infosChien = $_SESSION['infoschiens'];
}else{
  $nbrDoggos = "0";
  $infosChien = "";
}
//on récupère les données de l'inscrit dans une variable
$content = $_SESSION['nom']."|".$_SESSION['prenom'].
"§".$_SESSION['adresse']."|".$_SESSION['lieures']
."§".$_SESSION['sexe']."§".$_SESSION['dateNaissance']."§".$_SESSION['profession']
."§".$_SESSION['situation']."|".$nbrEnfants
."§".$_SESSION['poids']."|".$_SESSION['taille']."|".$_SESSION['couleurCheveux']."|".$_SESSION['couleurYeux']
."§".$_SESSION['msgAcc']."§".$_SESSION['citation']."§".$_SESSION['interets']."§".$_SESSION['fumeurs']
."§".$nbrDoggos."|".$infosChiens
."§".$_SESSION['photo']."§".$_SESSION['pseudo']."§".$_SESSION['password']." \r\n";
//on écrit ce que contient la variable dans le fichier nommé userList.txt
//FILE_APPEND permet d'écrire à la suite du fichier
file_put_contents('userList.txt', $content, FILE_APPEND);

header ('location: /login/login.php');
?>
|blocchien|§|bloc truc|§|
   </br>
   <!--Création d'un bouton inscrire un nouvel élève et d'un retour à l'accueil-->
   <!--
<a href="inscriptionEleves.php"><input type="button" value="Inscrire un nouvel élève" /></a>
<a href="tp_Poudlard.php"><input type="button" value="Retour à la page d'accueil" /></a>
-->
</br>
</body>
</html>
