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

    $_SESSION["nom"] = $_SESSION["sexe"] = $_SESSION["poids"] = $_SESSION["pseudo"] = $_SESSION["fumeur"] = $_SESSION["prenom"] = $_SESSION["msgAcc"]
      = $_SESSION["photos"] = $_SESSION["adresse"] = $_SESSION["citation"] = $_SESSION["nbDoggos"] = $_SESSION["password"] = $_SESSION["interets"]
      = $_SESSION["nombreEnf"] = $_SESSION["situation"] = $_SESSION["infoschiens"] = $_SESSION["couleurYeux"] = $_SESSION["couleurCheveux"]
      = $_SESSION["dateNaissance"] = $_SESSION["taille"] = $_SESSION["lieures"] = $_SESSION["profession"] = $_SESSION["fumeur"] = $_SESSION["chiens"] = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nom"])) {
        $erreurNom = "Le champ nom est requis";
      } else {
        $_SESSION["nom"] = test_input($_POST["nom"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $_SESSION["nom"])) {
          $erreurNom = "Le nom est invalide.";
        }
      }
      if (empty($_POST["prenom"])) {
        $erreurPrenom = "Le champ prénom est requis";
      } else {
        $_SESSION["prenom"] = test_input($_POST["prenom"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $_SESSION["prenom"])) {
          $erreurPrenom = "Le prénom est invalide.";
        }
      }
      if (empty($_POST["adresse"])) {
        $erreurAdresse = "Le champ adresse est requis";
      } else {
        $_SESSION["adresse"] = test_input($_POST["adresse"]);
        if (preg_match("/^[§]*$/", $_SESSION["adresse"])) {
          $erreurPseudo = "Le pseudo est invalide.";
        }
      }
      if (empty($_POST["lieures"])) {
        $lieures = "";
      } else {
        $_SESSION["lieures"] = test_input($_POST["lieures"]);
        if (preg_match("/^[§]*$/", $_SESSION["lieures"])) {
          $erreurLieuRes = "Le lieu de résidence contient des caractères invalides.";
        }
      }

      if (empty($_POST["sexe"])) {
        $erreurSexe = "Le champ sexe est requis";
      } else {
        $_SESSION["sexe"] = test_input($_POST["sexe"]);
        if (($_SESSION["sexe"] != "Homme") && ($_SESSION["sexe"] != "Femme") && ($_SESSION["sexe"] != "Autre")) {
          $erreurSexe = "Le sexe est invalide.";
        }
      }

      if (empty($_POST["dateNaissance"])) {
        $erreurDateNaissance = "Le champ date de naissance est requis";
      } else {
        $_SESSION["dateNaissance"] = test_input($_POST["dateNaissance"]);
        if (!preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $_SESSION["dateNaissance"])) {
          $erreurDateNaissance = "La date de naissance est invalide.";
        }
      }

      if (empty($_POST["profession"])) {
        $_SESSION["profession"] = "";
      } else {
        $_SESSION["profession"] = test_input($_POST["profession"]);
        if (!preg_match("/^[a-zA-Z -]*$/", $_SESSION["profession"])) {
          $erreurProfession = "La profession est invalide.";
        }
      }

      if (empty($_POST["situation"])) {
        $erreurSituation = "Le champ situation amoureuse est requis";
      } else {
        $_SESSION["situation"] = test_input($_POST["situation"]);
        if (($_SESSION["situation"] != "Célibataire") && ($_SESSION["situation"] != "Compliqué")) {
          $erreurSituation = "La situation amoureuse est invalide.";
        }
      }

      if (!isset($_POST["enfants"])) {
        $_SESSION["enfants"] = "";
      } else {
        $_SESSION["enfants"] = test_input($_POST["enfants"]);
        if ($_SESSION["enfants"] != "on") {
          $erreurEnfants = "Une erreur s'est produite";
        }
        if (empty($_POST["nombreEnf"])) {
          $erreurNombreEnf = "Le champ nombre d'enfants est requis";
        } else {
          $_SESSION["nombreEnf"] = test_input($_POST["nombreEnf"]);
          if (($_SESSION["nombreEnf"] != "1") && ($_SESSION["nombreEnf"] != "2") && ($_SESSION["nombreEnf"] != "3-5") && ($_SESSION["nombreEnf"] != "5+") && ($_SESSION["nombreEnf"] != "-1")) {
            $erreurNombreEnf = "Le nombre d'enfants est invalide.";
          }
        }
      }

      if (empty($_POST["poids"])) {
        $erreurPoids = "Le champ poids est requis";
      } else {
        $_SESSION["poids"] = test_input($_POST["poids"]);
        if (($_SESSION["poids"] < 0) || ($_SESSION["poids"] > 600)) {
          $erreurPoids = "Le poids est invalide.";
        }
      }

      if (empty($_POST["taille"])) {
        $erreurTaille = "Le champ poids est requis";
      } else {
        $_SESSION["taille"] = test_input($_POST["taille"]);
        if (($_SESSION["taille"] < 0) || ($_SESSION["taille"] > 260)) {
          $erreurTaille = "La taille est invalide.";
        }
      }

      if (empty($_POST["couleurCheveux"])) {
        $erreurCouleurCheveux = "Le champ couleur de cheveux est requis";
      } else {
        $_SESSION["couleurCheveux"] = test_input($_POST["couleurCheveux"]);
        if (($_SESSION["couleurCheveux"] != "Noir") && ($_SESSION["couleurCheveux"] != "Brun") && ($_SESSION["couleurCheveux"] != "Auburn")
          && ($_SESSION["couleurCheveux"] != "Châtain") && ($_SESSION["couleurCheveux"] != "Roux") && ($_SESSION["couleurCheveux"] != "Blond Vénitien")
          && ($_SESSION["couleurCheveux"] != "Blond") && ($_SESSION["couleurCheveux"] != "Blanc") && ($_SESSION["couleurCheveux"] != "Autre")
        ) {
          $erreurCouleurCheveux = "La couleur de cheveux est invalide.";
        }
      }
      
      if (empty($_POST["couleurYeux"])) {
        $erreurCouleurYeux = "Le champ couleur de yeux est requis";
      } else {
        $_SESSION["couleurYeux"] = test_input($_POST["couleurYeux"]);
        if (($_SESSION["couleurYeux"] != "Bleu") && ($couleurYeux != "Vert") && ($_SESSION["couleurYeux"] != "Marron")
          && ($_SESSION["couleurYeux"] != "Noisette") && ($_SESSION["couleurYeux"] != "Noir") && ($_SESSION["couleurYeux"] != "Autre")
        ) {
          $erreurCouleurYeux = "La couleur des yeux est invalide.";
        }
      }

      if (empty($_POST["msgAcc"])) {
        $_SESSION["msgAcc"] = "";
      } else {
        $_SESSION["msgAcc"] = test_input($_POST["msgAcc"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $_SESSION["msgAcc"])) {
          $erreurMsgAcc = "Le message d'accueil est invalide.";
        }
      }

      if (empty($_POST["citation"])) {
        $_SESSION["citation"] = "";
      } else {
        $_SESSION["citation"] = test_input($_POST["citation"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $_SESSION["citation"])) {
          $erreurCitation = "La citation est invalide.";
        }
      }

      if (empty($_POST["interets"])) {
        $_SESSION["interets"] = "";
      } else {
        $_SESSION["interets"] = test_input($_POST["interets"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $_SESSION["interets"])) {
          $erreurInterets = "Les centres d'interets sont invalides.";
        }
      }

      if (!isset($_POST["fumeur"])) {
        $_SESSION["fumeur"] = "";
      } else {
        $_SESSION["fumeur"] = test_input($_POST["fumeur"]);
        if ($_SESSION["fumeur"] != "on") {
          $erreurFumeur = "Une erreur s'est produite.";
        }
      }

      if (!isset($_POST["chiens"])) {
        $_SESSION["chiens"] = "";
      } else {
        $_SESSION["chiens"] = test_input($_POST["chiens"]);
        if ($_SESSION["chiens"] != "on") {
          $erreurEnfants = "Une erreur s'est produite";
        }
        if (empty($_POST["nbDoggos"])) {
          $erreurNbDoggos = "Le champ nombre de chiens est requis";
        } else {
          $_SESSION["nbDoggos"] = test_input($_POST["nbDoggos"]);
          if (($_SESSION["nbDoggos"] != "1") && ($_SESSION["nbDoggos"]  != "2") && ($_SESSION["nbDoggos"]  != "3+")) {
            $erreurNbDoggos = "Le nombre de chiens est invalide.";
          }
        }
      }
      if (empty($_POST["infoschiens"])) {
        $_SESSION["infoschiens"]  = "";
      } else {
        $_SESSION["infoschiens"] = test_input($_POST["infoschiens"]);
        if (!preg_match("/^[a-zA-Z ,.-]*$/", $_SESSION["infoschiens"])) {
          $erreurInfoschiens = "Les informations à propos des chiens sont invalides ou contiennent des caractères interdits.";
        }
      }

      if (empty($_POST["pseudo"])) {
        $erreurPseudo = "Le champ pseudo est requis";
      } else {
        $_SESSION["pseudo"] = test_input($_POST["pseudo"]);
        if (!preg_match("/^[a-zA-Z,-.]*$/", $_SESSION["pseudo"])) {
          $erreurPseudo = "Le pseudo est invalide.";
        }
      }

      if (empty($_POST["password"])) {
        $erreurPassword = "Le champ mot de passe est requis";
      } else {
        $_SESSION["password"] = test_input($_POST["password"]);
        if (!preg_match("/[^§\s]+/", $_SESSION["password"])) {
          $erreurPassword = "Le mot de passe est invalide.";
        }
      }
    }

    ?>

    <div id="page">
      <div id="bloc_Register">
        <form accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <h3>Informations Générales :</h3>
          <label for="nom">Nom</label><br>
          <input name="nom" type="text" pattern="[^§]+" value="<?php echo $_SESSION['nom'] ?>" placeholder="Votre nom" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurNom; ?> </span><br>
          <label for="prenom">Prénom</label><br>
          <input name="prenom" pattern="[^§]+" type="text" value="<?php echo $_SESSION['prenom'] ?>" placeholder="Votre prénom" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurPrenom; ?> </span><br>
          <label for="adresse">Adresse, cette information sera privée.</label><br>
          <input name="adresse" pattern="[^§]+" type="text" value="<?php echo $_SESSION['adresse'] ?>" placeholder="Adresse complète" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurAdresse; ?> </span><br>
          <label for="lieures">Lieu de résidence, cette adresse sera publique.</label><br>
          <input name="lieures" pattern="[^§]+" type="text" value="<?php echo $_SESSION['lieures'] ?>" placeholder="(Pays, Ville, Département)" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="sexe">Sexe</label><br>
          <div class="blocSexe">
            <label><input checked="checked" name="sexe" type="radio" id="Homme" value="Homme" /> Homme </label>
            <label><input name="sexe" type="radio" value="Femme" id="Femme" /> Femme </label> <br>
            <label><input name="sexe" type="radio" value="Autre" id="Autre"/> Autre </label> <br>
          </div>
          <label for="birthday">Date de Naissance</label><br>
          <input type="date" name="dateNaissance" value="<?php echo $_SESSION['dateNaissance'] ?>" required> <span>* <?php echo $erreurDateNaissance; ?> </span><br>
          <label for="profession">Profession</label> <br>
          <input name="profession" pattern="[^§]+" type="text" value="<?php echo $_SESSION['profession'] ?>" placeholder="Votre profession ou activité." oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="situation">Situation amoureuse</label> <span>* <?php echo $erreurSituation ?> </span><br>
          <div class="blocSexe">
            <label><input checked="checked" name="situation" type="radio" value="Célibataire" id="Célibataire" required /> Célibataire</label> /
            <label><input name="situation" type="radio" id="Compliqué" value="Compliqué" /> Compliqué</label>
            <label><input id="enfants" name="enfants" type="checkbox" value="" onclick="changeVisibility('nbEnfants')" />avec enfants.</label><br>
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
          <label><input type="number" name="poids" id="poids" min="0" value="<?php echo $_SESSION["poids"] ?>" required>kg</label> <span>* <?php echo $erreurPoids; ?> </span><br>
          <label for="poids">Taille</label>
          <label><input type="number" name="taille" id="taille" min="0" value="<?php echo $_SESSION["taille"] ?>" required>cm</label> <span>* <?php echo $erreurTaille; ?> </span><br>

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
          <input name="msgAcc" pattern="[^§]+" type="text" value="<?php echo $_SESSION['msgAcc'] ?>" placeholder="Un petit message d'accueil" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="citation">Citation</label><br>
          <input name="citation" pattern="[^§]+" type="text" value="<?php echo $_SESSION['citation'] ?>" placeholder="Une citation ?" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label for="interets">Interets</label><br>
          <input name="interets" pattern="[^§]+" type="text" value="<?php echo $_SESSION['interets'] ?>" placeholder="Vos interets" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          <label><input type="checkbox" name="fumeur" id="fumeur">Fumeur ?</label><br>
          <label><input name="chiens" id="chiens" type="checkbox" value="" onclick="changeVisibility('nbChiens')" /> Je possède un ami à 4 pattes !</label><br>
          <div id="nbChiens"> <span>* <?php echo $erreurNbDoggos; ?> </span>
            <select name="nbDoggos" id="nbDoggos">
              <option value="1">1 Chien</option>
              <option value="2">2 Chiens</option>
              <option value="3+">3 Chiens ou plus</option>
            </select>
            <input name="infoschiens" pattern="[^§]+" type="text" value="<?php echo $_SESSION['infoschiens'] ?>" placeholder="Infos chiens" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /><br>
          </div>
          <h3>Photos !</h3>
          <span>Vous pouvez mettre en ligne jusqu'à 4 photos !</span> <br>
          <input type="file" id="photos" name="photos" accept="image/png, image/jpeg" multiple> <br>
          <label for="pseudo">Pseudo</label><br>
          <input name="pseudo" type="text" pattern="[^\s§]+" value="<?php echo $_SESSION['pseudo'] ?>" placeholder="Votre pseudo" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurPseudo; ?> </span><br>
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