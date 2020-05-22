<?php
session_start();
if (!(isset($_SESSION["login_Type"]))) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Inscription</title>
    <link rel="stylesheet" type="text/css" href="./register.css">
    <script type="text/javascript" src="register.js"></script>
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="page">
  <div id="bloc_Register">
    <form accept-charset="UTF-8" action="confirmRegistration.php" method="POST">
      <label for="nom">Nom</label><br>
      <input name="nom" type="text" pattern="[^\x3B]+" value="" placeholder="Nom de l'élève" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser ; ")' oninput="setCustomValidity('')" required /> <br>
      <label for="prenom">Prénom</label><br>
      <input name="prenom" pattern="[^\x3B]+" type="text" value="" placeholder="Prénom de l'élève" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser ; ")' oninput="setCustomValidity('')" required /><br>
      <label for="adresse">Adresse, cette information sera privée.</label><br>
      <input name="adresse" pattern="[^\x3B]+" type="text" value="" placeholder="Adresse complète" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser ; ")' oninput="setCustomValidity('')" required /><br>
      <label for="lieures">Lieu de résidence, cette adresse sera publique.</label><br>
      <input name="lieures" pattern="[^\x3B]+" type="text" value="" placeholder="(Pays, Ville, Département)" oninvalid='setCustomValidity("Merci de ne pas utiliser ;")' oninput="setCustomValidity('')"/><br>
      <label for="sexe">Sexe</label><br>
      <div id="blocSexe">
      <label><input checked="checked" name="sexe" type="radio" value="Homme" /> Homme </label>
      <label><input name="sexe" type="radio" value="Femme" /> Femme </label> <br>
      </div>
      <label for="birthday">Date de Naissance</label><br>
      <input type="date" name="dateNaissance" value="" required><br>
      <label for="profession">Profession</label> <br>
      <input name="lieures" pattern="[^\x3B]+" type="text" value="" placeholder="Votre profession ou activité." oninvalid='setCustomValidity("Merci de ne pas utiliser ;")' oninput="setCustomValidity('')"/><br>
      <label for="birthday">Situation amoureuse</label><br>
      <div id="blocSexe">
      <label><input checked="checked" name="sexe" type="radio" value="Célibataire" /> Célibataire</label>
      <label><input checked="checked" name="sexe" type="radio" value="Compliqué" /> Compliqué</label>
      <label><input name="sexe" type="checkbox" value="" onchange="changeVisibility('nbEnfants')"/>avec enfants.</label><br>
      <div id="nbEnfants">
      <select name="cars" id="cars">
      <option selected="true" value="-1" disabled>Ne pas mentionner</option>
      <option value="1">1 Enfant</option>
      <option value="2">2 Enfants</option>
      <option value="3-5">Entre 3 et 5 Enfants</option>
      <option value="5+">1 Plus de 5 Enfants</option>
      </select>
      </div>
      </div>
      <label for="pseudo">Pseudo</label><br>
      <input name="pseudo" type="text" pattern="[^\s\x3B]+" value="" placeholder="Pseudo de l'élève" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required /><br>
      <label for="password">Mot de Passe</label><br>
      <input name="password" type="password" pattern="[^\s\x3B]+" value="" placeholder="Mot de passe" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required /><br>
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