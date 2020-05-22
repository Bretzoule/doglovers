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

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nom"])) { 
        $erreurNom = "Le champ nom est requis";
      } else {
        $nom = test_input($_POST["nom"]); 
        if (!preg_match("/^[a-zA-Z ]*$/", $nom)) {
          $erreurNom = "Le nom est invalide.";
        }
      }
    }

    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>

    <div id="page">
      <div id="bloc_Register">
        <form accept-charset="UTF-8" action="confirmRegistration.php" method="POST">
          <h3>Informations Générales :</h3>
          <label for="nom">Nom</label><br>
          <input name="nom" type="text" pattern="[^§]+" value="" placeholder="Votre nom" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span> <?php echo $erreurNom ?> </span><br>
          <label for="prenom">Prénom</label><br>
          <input name="prenom" pattern="[^§]+" type="text" value="" placeholder="Votre prénom" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /><br>
          <label for="adresse">Adresse, cette information sera privée.</label><br>
          <input name="adresse" pattern="[^§]+" type="text" value="" placeholder="Adresse complète" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /><br>
          <label for="lieures">Lieu de résidence, cette adresse sera publique.</label><br>
          <input name="lieures" pattern="[^§]+" type="text" value="" placeholder="(Pays, Ville, Département)" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="sexe">Sexe</label><br>
          <div class="blocSexe">
            <label><input checked="checked" name="sexe" type="radio" value="Homme" /> Homme </label>
            <label><input name="sexe" type="radio" value="Femme" /> Femme </label> <br>
          </div>
          <label for="birthday">Date de Naissance</label><br>
          <input type="date" name="dateNaissance" value="" required><br>
          <label for="profession">Profession</label> <br>
          <input name="lieures" pattern="[^§]+" type="text" value="" placeholder="Votre profession ou activité." oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="situation">Situation amoureuse</label><br>
          <div class="blocSexe">
            <label><input checked="checked" name="situation" type="radio" value="Célibataire" required /> Célibataire</label> /
            <label><input name="situation" type="radio" value="Compliqué" /> Compliqué</label>
            <label><input name="enfants" type="checkbox" value="" onclick="changeVisibility('nbEnfants')" />avec enfants.</label><br>
            <div id="nbEnfants">
              <select name="nombreEnf" id="nombreEnf">
                <option selected="true" value="-1" disabled>Ne pas mentionner</option>
                <option value="1">1 Enfant</option>
                <option value="2">2 Enfants</option>
                <option value="3-5">Entre 3 et 5 Enfants</option>
                <option value="5+">1 Plus de 5 Enfants</option>
              </select>
            </div>
          </div>
          <h3>Informations physique :</h3>
          <label for="poids">Poids</label>
          <label><input type="number" name="poids" id="poids" min="0" value="0">kg</label><br>
          <label for="poids">Taille</label>
          <label><input type="number" name="taille" id="taille" min="0" value="0">cm</label> <br>

          <label for="couleurCheveux">Couleur de vos cheveux</label> <br>
          <select name="couleurCheveux" id="couleurCheveux">
            <option value="Brun"></option>
            <option value="blonde"></option>
            <option value="chatain clair"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
          </select> <br>
          <label for="couleurYeux">Couleur de vos yeux</label> <br>
          <select name="couleurYeux" id="couleurYeux">
            <option value="Brun"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
            <option value="Brun"></option>
          </select>
          <h3>Informations profil :</h3>
          <label for="msgAcc">Message d'accueil</label><br>
          <input name="msgAcc" pattern="[^§]+" type="text" value="" placeholder="Un petit message d'accueil" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="citation">Citation</label><br>
          <input name="citation" pattern="[^§]+" type="text" value="" placeholder="Une citation ?" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="interets">Interets</label><br>
          <input name="interets" pattern="[^§]+" type="text" value="" placeholder="Vos interets" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label><input type="checkbox" name="fumeur" id="fumeur">Fumeur ?<label><br>
              <label><input name="chiens" type="checkbox" value="" onclick="changeVisibility('nbChiens')" /> Je possède un ami à 4 pattes !</label><br>
              <div id="nbChiens">
                <select name="nbDoggos" id="nbDoggos">
                  <option value="1">1 Chien</option>
                  <option value="2">2 Chiens</option>
                  <option value="3+">3 Chiens ou plus</option>
                </select>
                <input name="infoschiens" pattern="[^§]+" type="text" value="" placeholder="Infos chiens" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
              </div>
              <h3>Photos !</h3>
              <span>Vous pouvez mettre en ligne jusqu'à 4 photos !</span> <br>
              <input type="file" id="photos" name="photos" accept="image/png, image/jpeg" multiple> <br>
              <label for="pseudo">Pseudo</label><br>
              <input name="pseudo" type="text" pattern="[^\s§]+" value="" placeholder="Votre pseudo" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /><br>
              <label for="password">Mot de Passe</label><br>
              <input name="password" type="password" pattern="[^\s§]+" value="" placeholder="Mot de passe" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /><br>
              <input type="submit" value="Ajouter !"></input>
        </form>
      </div>
    </div>
  </body>

  </html>
<?php
} else {
  header('Location: ./../erreurs/alreadyIn.php');
} ?>