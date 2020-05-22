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

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

    $erreurNom = $erreurSexe = $erreurPoids = $erreurPseudo = $erreurFumeur = $erreurPrenom = $erreurMsgAcc
      = $erreurPhotos = $erreurAdresse = $erreurCitation = $erreurNbDoggos = $erreurPassword = $erreurInterets
      = $erreurNombreEnf = $erreurSituation = $erreurInfoschiens = $erreurCouleurYeux = $erreurCouleurCheveux
      = $erreurDateNaissance = $erreurTaille = "";

      $nom = $sexe = $poids = $pseudo = $fumeur = $prenom = $msgAcc
      = $photos = $adresse = $citation = $nbDoggos = $password = $interets
      = $nombreEnf = $situation = $infoschiens = $couleurYeux = $couleurCheveux
      = $dateNaissance = $taille = $lieures = $profession ="";
      
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nom"])) {
        $erreurNom = "Le champ nom est requis";
      } else {
        $nom = test_input($_POST["nom"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $nom)) {
          $erreurNom = "Le nom est invalide.";
        }
      }
      if (empty($_POST["prenom"])) {
        $erreurPrenom = "Le champ prénom est requis";
      } else {
        $prenom = test_input($_POST["prenom"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $prenom)) {
          $erreurPrenom = "Le prénom est invalide.";
        }
      }
      if (empty($_POST["adresse"])) {
        $erreurAdresse = "Le champ adresse est requis";
      } else {
        $adresse = test_input($_POST["adresse"]);
      }
      if (empty($_POST["lieures"])) {
        $lieures = "";
      } else {
        $lieures = test_input($_POST["lieures"]);
      }

      if (empty($_POST["sexe"])) {
        $erreurSexe = "Le champ sexe est requis";
      } else {
        $sexe = test_input($_POST["sexe"]);
        if (($sexe != "Homme") && ($sexe != "Femme") && ($sexe != "Autre")) {
          $erreurSexe = "Le sexe est invalide.";
        }
      }

      if (empty($_POST["dateNaissance"])) {
        $erreurDateNaissance = "Le champ date de naissance est requis";
      } else {
        $dateNaissance = test_input($_POST["dateNaissance"]);
        if (!preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $dateNaissance)) {
          $erreurDateNaissance = "La date de naissance est invalide.";
        }
      }

      if (empty($_POST["profession"])) {
        $profession = "";
      } else {
        $profession = test_input($_POST["profession"]);
        if (!preg_match("/^[a-zA-Z -]*$/", $profession)) {
          $erreurProfession = "La profession est invalide.";
        }
      }

      if (empty($_POST["situation"])) {
        $erreurSituation = "Le champ situation amoureuse est requis";
      } else {
        $situation = test_input($_POST["situation"]);
        if (($situation != "Célibataire") && ($situation != "Compliqué")) {
          $erreurSituation = "La situation amoureuse est invalide.";
        }
      }
      if (empty($_POST["enfants"])) {
        $enfants = "";
      } else {
        $enfants = test_input($_POST["enfants"]);
      }

      if (empty($_POST["nombreEnf"])) {
        $erreurNombreEnf = "Le champ nombre d'enfants est requis";
      } else {
        $nombreEnf = test_input($_POST["nombreEnf"]);
        if (($nombreEnf != "1") && ($nombreEnf != "2") && ($nombreEnf != "3-5") && ($nombreEnf != "5+") && ($nombreEnf != "-1")) {
          $erreurNombreEnf = "Le nombre d'enfants est invalide.";
        }
      }

      if (empty($_POST["poids"])) {
        $erreurPoids = "Le champ poids est requis";
      } else {
        $poids = test_input($_POST["poids"]);
        if (($poids < 0) || ($poids > 600)) {
          $erreurPoids = "Le poids est invalide.";
        }
      }

      if (empty($_POST["taille"])) {
        $erreurTaille = "Le champ poids est requis";
      } else {
        $taille = test_input($_POST["taille"]);
        if (($taille < 0) || ($taille > 260)) {
          $erreurTaille = "La taille est invalide.";
        }
      }

      if (empty($_POST["couleurCheveux"])) {
        $erreurCouleurCheveux = "Le champ couleur de cheveux est requis";
      } else {
        $couleurCheveux = test_input($_POST["couleurCheveux"]);
        if (($couleurCheveux != "Noir") && ($couleurCheveux != "Brun") && ($couleurCheveux != "Auburn")
          && ($couleurCheveux != "Châtain") && ($couleurCheveux != "Roux") && ($couleurCheveux != "Blond Vénitien")
          && ($couleurCheveux != "Blond") && ($couleurCheveux != "Blanc") && ($couleurCheveux != "Autre")
        ) {
          $erreurCouleurCheveux = "La couleur de cheveux est invalide.";
        }
      }

      if (empty($_POST["couleurYeux"])) {
        $erreurCouleurYeux = "Le champ couleur de yeux est requis";
      } else {
        $couleurYeux = test_input($_POST["couleurYeux"]);
        if (($couleurYeux != "Bleu") && ($couleurYeux != "Vert") && ($couleurYeux != "Marron")
          && ($couleurYeux != "Noisette") && ($couleurYeux != "Noir") && ($couleurYeux != "Autre")
        ) {
          $erreurCouleurYeux = "La couleur des yeux est invalide.";
        }
      }

      if (empty($_POST["msgAcc"])) {
        $msgAcc = "";
      } else {
        $msgAcc = test_input($_POST["msgAcc"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $msgAcc)) {
          $erreurMsgAcc = "Le message d'accueil est invalide.";
        }
      }

      if (empty($_POST["citation"])) {
        $citation = "";
      } else {
        $citation = test_input($_POST["citation"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $citation)) {
          $erreurCitation = "La citation est invalide.";
        }
      }

      if (empty($_POST["interets"])) {
        $interets = "";
      } else {
        $interets = test_input($_POST["interets"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $interets)) {
          $erreurInterets = "Les centres d'interets sont invalides.";
        }
      }

      if (empty($_POST["fumeur"])) {
        $fumeur = "";
      } else {
        $fumeur = test_input($_POST["fumeur"]);
      }

      if (empty($_POST["chiens"])) {
        $chiens = "";
      } else {
        $chiens = test_input($_POST["chiens"]);
      }

      if (empty($_POST["nbDoggos"])) {
        $erreurNbDoggos = "Le champ nombre de chiens est requis";
      } else {
        $nbDoggos = test_input($_POST["nbDoggos"]);
        if (($nbDoggos != "1") && ($nbDoggos != "2") && ($nbDoggos != "3+")) {
          $erreurNbDoggos = "Le nombre de chiens est invalide.";
        }
      }

      if (empty($_POST["infoschiens"])) {
        $infoschiens = "";
      } else {
        $infoschiens = test_input($_POST["infoschiens"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $infoschiens)) {
          $erreurInfoschiens = "Les informations à propos des chiens sont invalides.";
        }
      }

      if (empty($_POST["pseudo"])) {
        $erreurPseudo = "Le champ pseudo est requis";
      } else {
        $pseudo = test_input($_POST["pseudo"]);
        if (!preg_match("/^[a-zA-Z,-.]*$/", $pseudo)) { 
          $erreurPseudo = "Le pseudo est invalide.";
        }
      }

      if (empty($_POST["password"])) {
        $erreurPassword = "Le champ mot de passe est requis";
      } else {
        $password = test_input($_POST["password"]);
        if (preg_match("/[^§\s]+/", $password)) {
          $erreurPassword = "Le mot de passe est invalide.";
        }
      }

    }
   
    ?>

    <div id="page">
      <div id="bloc_Register">
        <form accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
          <h3>Informations Générales :</h3>
          <label for="nom">Nom</label><br>
          <input name="nom" type="text" pattern="[^§]+" value="<?php echo $nom ?>" placeholder="Votre nom" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurNom; ?> </span><br>
          <label for="prenom">Prénom</label><br>
          <input name="prenom" pattern="[^§]+" type="text" value="<?php echo $prenom ?>" placeholder="Votre prénom" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurPrenom; ?> </span><br>
          <label for="adresse">Adresse, cette information sera privée.</label><br>
          <input name="adresse" pattern="[^§]+" type="text" value="<?php echo $adresse ?>" placeholder="Adresse complète" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurAdresse; ?> </span><br>
          <label for="lieures">Lieu de résidence, cette adresse sera publique.</label><br>
          <input name="lieures" pattern="[^§]+" type="text" value="<?php echo $lieures ?>" placeholder="(Pays, Ville, Département)" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="sexe">Sexe</label><br>
          <div class="blocSexe">
            <label><input checked="checked" name="sexe" type="radio" value="Homme" /> Homme </label>
            <label><input name="sexe" type="radio" value="Femme" /> Femme </label> <br>
            <label><input name="sexe" type="radio" value="Autre" /> Autre </label> <br>
          </div>
          <label for="birthday">Date de Naissance</label><br>
          <input type="date" name="dateNaissance" value="<?php echo $dateNaissance ?>" required> <span>* <?php echo $erreurDateNaissance; ?> </span><br>
          <label for="profession">Profession</label> <br>
          <input name="profession" pattern="[^§]+" type="text" value="<?php echo $profession ?>" placeholder="Votre profession ou activité." oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="situation">Situation amoureuse</label> <span>* <?php echo $erreurSituation; ?> </span><br>
          <div class="blocSexe">
            <label><input checked="checked" name="situation" type="radio" value="Célibataire" required /> Célibataire</label> /
            <label><input name="situation" type="radio" value="Compliqué" /> Compliqué</label>
            <label><input name="enfants" type="checkbox" value="" onclick="changeVisibility('nbEnfants')" />avec enfants.</label><br>
            <div id="nbEnfants"> <span>* <?php echo $erreurNombreEnf; ?> </span>
              <select name="nombreEnf" id="nombreEnf">
                <option selected="true" value="-1" disabled>Ne pas mentionner</option>
                <option value="1">1 Enfant</option>
                <option value="2">2 Enfants</option>
                <option value="3-5">Entre 3 et 5 Enfants</option>
                <option value="5+">Plus de 5 Enfants</option>
              </select>
            </div>
          </div>
          <h3>Informations physique :</h3>
          <label for="poids">Poids</label>
          <label><input type="number" name="poids" id="poids" min="0" value="" required>kg</label> <span>* <?php echo $erreurPoids; ?> </span><br>
          <label for="poids">Taille</label>
          <label><input type="number" name="taille" id="taille" min="0" value="" required>cm</label> <span>* <?php echo $erreurTaille; ?> </span><br>

          <label for="couleurCheveux">Couleur de vos cheveux</label> <span>* <?php echo $erreurCouleurCheveux; ?> </span> <br>
          <select name="couleurCheveux" id="couleurCheveux">
            <option value="Noir">Noir</option>
            <option value="Brun">Brun</option>
            <option value="Auburn">Auburn</option>
            <option value="Châtain">Châtain</option>
            <option value="Roux">Roux</option>
            <option value="Blond Vénitien">Blond Vénitien</option>
            <option value="Blond">Blond</option>
            <option value="Blanc">Blanc</option>
            <option value="Autre">Autre</option>
          </select> <br>
          <label for="couleurYeux">Couleur de vos yeux</label> <span>* <?php echo $erreurCouleurYeux; ?> </span><br>
          <select name="couleurYeux" id="couleurYeux">
            <option value="Bleu">Bleu</option>
            <option value="Vert">Vert</option>
            <option value="Marron">Marron</option>
            <option value="Noisette">Noisette</option>
            <option value="Noir">Noir</option>
            <option value="Autre">Autre</option>
          </select>
          <h3>Informations profil :</h3>
          <label for="msgAcc">Message d'accueil</label><br>
          <input name="msgAcc" pattern="[^§]+" type="text" value="<?php echo $msgAcc ?>" placeholder="Un petit message d'accueil" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="citation">Citation</label><br>
          <input name="citation" pattern="[^§]+" type="text" value="<?php echo $citation ?>" placeholder="Une citation ?" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="interets">Interets</label><br>
          <input name="interets" pattern="[^§]+" type="text" value="<?php echo $interets ?>" placeholder="Vos interets" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label><input type="checkbox" name="fumeur" id="fumeur">Fumeur ?</label><br>
              <label><input name="chiens" type="checkbox" value="" onclick="changeVisibility('nbChiens')" /> Je possède un ami à 4 pattes !</label><br>
              <div id="nbChiens"> <span>* <?php echo $erreurNbDoggos; ?> </span>
                <select name="nbDoggos" id="nbDoggos">
                  <option value="1">1 Chien</option>
                  <option value="2">2 Chiens</option>
                  <option value="3+">3 Chiens ou plus</option>
                </select>
                <input name="infoschiens" pattern="[^§]+" type="text" value="<?php echo $infoschiens ?>" placeholder="Infos chiens" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
              </div>
              <h3>Photos !</h3>
              <span>Vous pouvez mettre en ligne jusqu'à 4 photos !</span> <br>
              <input type="file" id="photos" name="photos" accept="image/png, image/jpeg" multiple> <br>
              <label for="pseudo">Pseudo</label><br>
              <input name="pseudo" type="text" pattern="[^\s§]+" value="<?php echo $pseudo ?>" placeholder="Votre pseudo" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurPseudo; ?> </span><br>
              <label for="password">Mot de Passe</label><br>
              <input name="password" type="password" pattern="[^\s]+" value="" placeholder="Mot de passe" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /> <span>* <?php echo '<span>' . $erreurPassword . '</span>'; ?><br>
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