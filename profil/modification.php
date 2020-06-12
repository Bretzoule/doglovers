<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>

<head>

  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
  <link rel="stylesheet" type="text/css" href="MonProfil.css">
  <link rel="shortcut icon" href="./../ressources/favicon.ico"/>
</head>
<body>
<div id="part_logo"> <!--Partie logo-->
  <a href="./../login/login.php"><img src="./../ressources/logoBis.png" alt="logoBis" class="rounded-corners"></img></a>
</div> <!--Fin partie logo-->

<form accept-charset="UTF-8" action="profil.php" method="POST">
  <div class="page"><!--page-->

    <div class="part_gauche"><!--float left-->
      <div class="info_générales"><!--bloc informations générales-->

        <h3>Informations générales :</h3>
<?php session_start(); ?>
        <label for="nom">Nom</label><br>
        <input name="nom" type="text" pattern="[^§]+" value="<?php echo $_SESSION['Nom'] ?>" placeholder="<?php echo $_SESSION['Nom'] ?>" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurNom; ?> </span><br>

        <label for="prenom">Prénom</label><br>
        <input name="prenom" pattern="[^§]+" type="text" value="<?php echo $_SESSION['Prénom'] ?>" placeholder="<?php echo $_SESSION['Prénom'] ?>" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurPrenom; ?> </span><br>

        <label for="adresse">Adresse Mail, cette information sera privée.</label><br>
        <input name="adresse" pattern="[^§]+" type="text" value="<?php echo $_SESSION['Adresse'] ?>" placeholder="<?php echo $_SESSION['Adresse'] ?>" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser §")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurAdresse; ?> </span><br>

        <label for="lieures">Lieu de résidence, cette adresse sera publique.</label><br>
        <input name="lieures" pattern="[^§]+" type="text" value="<?php echo $_SESSION['LieuRes'] ?>" placeholder="<?php echo $_SESSION['LieuRes'] ?>" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /> <?php echo $erreurLieuRes; ?> <br>

        <label for="sexe">Sexe</label><br>
        <label><input checked="checked" name="sexe" type="radio" id="Homme" value="Homme" /> Homme </label>
        <label><input name="sexe" type="radio" value="Femme" id="Femme" /> Femme </label> <br>
        <label><input name="sexe" type="radio" value="Autre" id="Autre" /> Autre </label>
        <?php echo $erreurSexe; ?> <br>

        <br><label for="birthday">Date de Naissance</label><br>
        <input type="date" name="dateNaissance" value="<?php echo $_SESSION['DateNaissance'] ?>" placeholder="<?php echo $_SESSION['DateNaissance'] ?>" required> <span>* <?php echo $erreurDateNaissance; ?> </span><br>

        <br><label for="profession">Profession</label> <br>
        <input name="profession" pattern="[^§]+" type="text" value="<?php echo $_SESSION['Profession'] ?>" placeholder="<?php echo $_SESSION['Profession'] ?>" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /> <?php echo $erreurProfession; ?> <br>

        <label for="situation">Situation amoureuse</label> <span>* <?php echo $erreurSituation ?> </span><br>
        <label><input checked="checked" name="situation" type="radio" value="Célibataire" id="Célibataire" required /> Célibataire</label> /
        <label><input name="situation" type="radio" id="Compliqué" value="Compliqué" /> Compliqué</label>
        <label><input id="enfants" name="enfants" type="checkbox" onclick="changeVisibility('nbEnfants')" <?php if (isset($_POST['enfants'])) echo "checked='checked'"; ?> />avec enfants.</label><br>
        <div id="nbEnfants"> <span>* <?php echo $erreurNombreEnf; ?> </span>
          <select name="nombreEnf" id="nombreEnf">
            <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '-1')) { ?>selected="true" <?php }; ?> value="-1">Ne pas mentionner</option>
            <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '1')) { ?>selected="true" <?php }; ?> value="1">1 Enfant</option>
            <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '2')) { ?>selected="true" <?php }; ?> value="2">2 Enfants</option>
            <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '3-5')) { ?>selected="true" <?php }; ?> value="3-5">Entre 3 et 5 Enfants</option>
            <option <?php if (isset($_SESSION['nombreEnf']) && ($_SESSION['nombreEnf'] == '5+')) { ?>selected="true" <?php }; ?> value="5+">Plus de 5 Enfants</option>
          </select>
        </div>

      </div><!--fin bloc informations générales-->

      <br>

      <div class="info_physiques"><!--bloc informations physiques-->
        <h3>Informations physique :</h3>

        <label for="poids">Poids</label><br>
        <label><input type="number" name="poids" id="poids" min="0" value="<?php echo $_SESSION["Poids"] ?>" placeholder="<?php echo $_SESSION["Poids"] ?>" required>kg</label> <span>* <?php echo $erreurPoids; ?> </span><br>

        <label for="poids">Taille</label><br>
        <label><input type="number" name="taille" id="taille" min="0" value="<?php echo $_SESSION["Taille"] ?>" placeholder="<?php echo $_SESSION["Taille"] ?>" required>cm</label> <span>* <?php echo $erreurTaille; ?> </span><br>

        <label for="couleurCheveux">Couleur de vos cheveux</label> <span>* <?php echo $erreurCouleurCheveux; ?> </span> <br>
        <select name="couleurCheveux" id="couleurCheveux">
          <option <?php if (isset($_SESSION['couleurCheveux']) && ($_SESSION['couleurCheveux'] == 'Noir')) { ?>selected="true" <?php }; ?> value="Noir">Noir</option>
          <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Brun')) { ?>selected="true" <?php }; ?> value="Brun">Brun</option>
          <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Auburn')) { ?> selected="true" <?php }; ?> value="Auburn">Auburn</option>
          <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Châtain')) { ?>selected="true" <?php }; ?> value="Châtain">Châtain</option>
          <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Roux')) { ?>selected="true" <?php }; ?> value="Roux">Roux</option>
          <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Blond Vénitien')) { ?>selected="true" <?php }; ?> value="Blond Vénitien">Blond Vénitien</option>
          <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Blond')) { ?>selected="true" <?php }; ?> value="Blond">Blond</option>
          <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Blanc')) { ?>selected="true" <?php }; ?> value="Blanc">Blanc</option>
          <option <?php if (isset($_SESSION['couleurCheveux']) &&  ($_SESSION['couleurCheveux'] == 'Autre')) { ?>selected="true" <?php }; ?> value="Autre">Autre</option>
        </select> <br>

        <label for="couleurYeux">Couleur de vos yeux</label> <span>* <?php echo $erreurCouleurYeux; ?> </span><br>
        <select name="couleurYeux" id="couleurYeux">
          <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Bleu')) { ?>selected="true" <?php }; ?> value="Bleu">Bleu</option>
          <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Vert')) { ?>selected="true" <?php }; ?> value="Vert">Vert</option>
          <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Marron')) { ?>selected="true" <?php }; ?> value="Marron">Marron</option>
          <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Noisette')) { ?>selected="true" <?php }; ?> value="Noisette">Noisette</option>
          <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Noir')) { ?>selected="true" <?php }; ?> value="Noir">Noir</option>
          <option <?php if (isset($_SESSION['couleurYeux']) && ($_SESSION['couleurYeux'] == 'Autre')) { ?>selected="true" <?php }; ?> value="Autre">Autre</option>
        </select>
      </div><!--fin bloc informations physiques-->

    </div><!--fin float left-->




    <div class="part_droite"><!--float right-->

      <div class="info_profil"><!--bloc informations profil-->
        <h3>Informations profil :</h3>

        <label for="msgAcc">Message d'accueil</label><br>
        <input name="msgAcc" pattern="[^§]+" type="text" value="<?php echo $_SESSION['MsgAcc'] ?>" placeholder="<?php echo $_SESSION['MsgAcc'] ?>" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /> <?php echo $erreurMsgAcc; ?> <br>

        <label for="citation">Citation</label><br>
        <input name="citation" pattern="[^§]+" type="text" value="<?php echo $_SESSION['Citation'] ?>" placeholder="<?php echo $_SESSION['Citation'] ?>" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /> <?php echo $erreurCitation; ?> <br>

        <label for="interets">Interets</label><br>
        <input name="interets" pattern="[^§]+" type="text" value="<?php echo $_SESSION['Interets'] ?>" placeholder="<?php echo $_SESSION['Interets'] ?>" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /> <?php echo $erreurInterets; ?> <br>
        <label><input type="checkbox" name="fumeur" id="fumeur" <?php if (isset($_POST['fumeur'])) echo "checked='checked'"; ?>>Fumeur ?</label><br>
        <label><input name="chiens" id="chiens" type="checkbox" onclick="changeVisibility('nbChiens')" <?php if (isset($_POST['chiens'])) echo "checked='checked'"; ?> /> Je possède un ami à 4 pattes !</label><br>
        <div id="nbChiens"> <span>* <?php echo $erreurNbDoggos; ?> </span>
          <select name="nbDoggos" id="nbDoggos">
            <option <?php if (isset($_SESSION['nbDoggos']) && ($_SESSION['nbDoggos'] == '1')) { ?>selected="true" <?php }; ?> value="1">1 Chien</option>
            <option <?php if (isset($_SESSION['nbDoggos']) && ($_SESSION['nbDoggos'] == '2')) { ?>selected="true" <?php }; ?> value="2">2 Chiens</option>
            <option <?php if (isset($_SESSION['nbDoggos']) && ($_SESSION['nbDoggos'] == '3+')) { ?>selected="true" <?php }; ?> value="3+">3 Chiens ou plus</option>
          </select>
          <input name="infoschiens" pattern="[^§]+" type="text" value="<?php echo $_SESSION['InfosChiens'] ?>" placeholder="<?php echo $_SESSION['InfosChiens'] ?>" oninvalid='setCustomValidity("Merci de ne pas utiliser §")' oninput="setCustomValidity('')" /> <br> <?php echo $erreurInfoschiens; ?> <br>
        </div>
      </div><!--fin bloc informations profil-->

      <br><br>

      <div class="photo"><!--bloc photo-->
        <h3>Photos !</h3>

        <span>Vous pouvez mettre en ligne jusqu'à 4 photos !</span> <br>
        <input type="file" id="photos" name="photos" accept="image/png, image/jpeg" multiple> <br>
      </div><!--fin bloc photo-->

      <br><br>

      <div class="Identifiants"><!--bloc identifiants-->
        <h3>Identifiants :</h3>

        <label for="pseudo">Pseudo</label><br>
        <input disabled name="pseudo" type="text" pattern="[^\s§]+" value="<?php echo $_SESSION['pseudo'] ?>" placeholder="<?php echo $_SESSION['pseudo'] ?>" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /> <span>* <?php echo $erreurPseudo; ?> </span><br>

        <label for="password">Mot de Passe</label><br>
        <input disabled name="password" type="password" pattern="[^\s]+" value="" placeholder="******" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /> <span>* <?php echo '<span>' . $erreurPassword . '</span>'; ?><br>
      </div><!--fin bloc identifiants-->

      <br><br>

      <div class="part_boutons"><!--partie boutons-->
        <input type="submit" value="Ajouter !"></input>
      </div><!--fin partie boutons-->
      <?php
    if (isset($_SESSION["erreur"]) && ($_SESSION["erreur"] == "login_existant")) {
      $_SESSION["dataPassed"] = "false";
      echo '<span id="loginError"> Utilisateur déjà enregistré ( Mail ou Pseudo déjà utilisé...)</span>';
      unset($_SESSION["erreur"]);
    }
    ?>
    </div><!--fin float right-->

  </div><!--fin page-->

</form>
<?php
//on récupère les contenus des fichiers prof et élèves
$contenu_du_fichierUserList = file_get_contents('../register/data/userList.txt');
//on met chaque ligne dans un tableau
$nbrUser = explode("\n",$contenu_du_fichierUserList);
$j = 0;
$i = 0;
$fin = false;
while (($j<count($nbrUser)-1)&&(!$fin)){
  /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
  récupérer les différentes données présentes dans chaque ligne*/
  $donnee = explode("§",$nbrUser[$j]);
  /*on regarde si l'identifiant dans la ligne en cour est le bon ainsi que le mdp*/
  if($donnee[0] == $_SESSION['pseudo']){
    /*si c'est le cas on passe fin a true pour arréter la recherche*/
    $fin = true;

  while (($i<count($donnee)-1)){
    $donneeBis[$i] = explode("|",$donnee[$i]);
    $i++;
    }
}
$j++;
}
/*$content =  $_SESSION['pseudo']
  . "§" . $_SESSION['LieuRes']
  . "§" . $_SESSION['Sexe'] . "§" . $_SESSION['DateNaissance'] . "§" . $_SESSION['Profession']
  . "§" . $_SESSION['Situation'] . "|" . $nbrEnfants
  . "§" . $_SESSION['poids'] . "|" . $_SESSION['taille'] . "|" . $_SESSION['couleurCheveux'] . "|" . $_SESSION['couleurYeux']
  . "§" . $_SESSION['MsgAcc'] . "§" . $_SESSION['citation'] . "§" . $_SESSION['interets'] . "§" . $_SESSION['fumeur']
  . "§" . $nbrDoggos . "|" . $infosChiens
  . "§" . $_SESSION['photos']
  . "§" . "free" // [sizeof(userData)-6]
  . "§" . date("Y-m-d")
  . "§" . uniqid($prefix = "user_")
  . "§" . $_SESSION['nom'] . "|" . $_SESSION['prenom']
  . "§" . $_SESSION['adresse']
  . "§" . password_hash($_SESSION['password'], PASSWORD_DEFAULT) . "\r\n";*/

//  file_put_contents('./data/userList.txt', $content, FILE_APPEND);
?>
<script>//en rapport avec les box à cocher
/*  updateCheckBoxOnload('enfants', 'nbEnfants');
  updateCheckBoxOnload('chiens', 'nbChiens');*/
</script>

</body>

</html>
