<?php
session_start();
if (!(isset($_SESSION["login_Type"]))) { ?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title>Dog Lovers - Inscription</title>
  <link rel="stylesheet" type="text/css" href="./student.css">
  <link rel="shortcut icon" href="./../ressources/favicon.ico"/>
</head>
<body>
    <form accept-charset="UTF-8" action="confirmRegistration.php" method="POST">
        <label for="nom">Nom</label><br>
        <input name="nom" type="text" pattern="[^\x3B]+" value="" placeholder="Nom de l'élève" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser ; ")' oninput="setCustomValidity('')" required/> <br>
        <label for="prenom">Prénom</label><br> 
        <input name="prenom" pattern="[^\x3B]+" type="text" value="" placeholder="Prénom de l'élève" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser ; ")' oninput="setCustomValidity('')" required/><br>
        <label for="birthday">Date de Naissance</label><br>
        <input type="date" name="dateNaissance" value ="" required><br>
        <label for="pseudo">Pseudo</label><br>
        <input name="pseudo" type="text" pattern="[^\s\x3B]+" value="" placeholder="Pseudo de l'élève" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required/><br>
        <label for="password">Mot de Passe</label><br>
        <input name="password" type="password" pattern="[^\s\x3B]+" value="" placeholder="Mot de passe" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required/><br>
    <input type="submit" value="Ajouter !"></input>
    </form>
  </div>
  </div>
</body>
</html>
<?php 
} else {
  header('Location: ./../erreurs/alreadyIn.php');
}
  ?>