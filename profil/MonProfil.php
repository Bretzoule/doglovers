<?php
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
    <link rel="stylesheet" type="text/css" href="MonProfil.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Mon Profil</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="../home/accueil.php">Accueil</a></li>
        <li><a class="active" href="">Infos Publiques</a></li>
        <li><a href="./modification.php">Modifier mon profil</a></li>
        <li><a href="./modificationPw.php">Modifier mon Mot de Passe</a></li>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
      </ul>
    </div>
    <?php
    if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) >= 2)) {
      $contenu_du_fichierVisiteurs = file_get_contents('../register/data/matchs.txt');
      $utilisateurEnLigne = explode("\n", $contenu_du_fichierVisiteurs);
      $profilTrouve = false;
      $informationsVisiteurs = "";
      $a = 0;
      //on cherche dans le fichier si l'utilisateur en ligne y est
      while (($a < count($utilisateurEnLigne) - 1) && !$profilTrouve) {
        //on met les diférents noms de visiteurs ainsi que leur nombre de visites dans des cases
        $detailUtilisateur = explode("§", $utilisateurEnLigne[$a]);
        //trim permet de supprimer les espaces en début et en fin de chaîne -- Louve adooooooooore cette fonction <3
        if (trim($detailUtilisateur[0]) == trim($_SESSION['pseudo'])) {
          //on initialise les variables
          $profilTrouve = true;
          $i = 1;
          $visiteurTrouve = false;
          while (($i <= count($detailUtilisateur) - 1)) {
            $sousDetails = explode("|", $detailUtilisateur[$i]);
            $informationsVisiteurs .= "<span><a href='/profil/profil.php?user=" . $sousDetails[0] . "'>" . $sousDetails[0] . "</a> à visité votre profil " . $sousDetails[1] . " fois ! </span> <br>";
            $i++;
          }
        }
        $a++;
      }
      echo "<div>" . $informationsVisiteurs . "</div>";
    } else {
      echo "<div> Si vous étiez abonné(e), vous pourriez voir qui visite votre profil !</div>";
    }
    if (isset($_SESSION["modifie"])) {
      $_SESSION["dataPassed"] = "false";
      echo '<span>'. $_SESSION["modifie"] . '</span>';
      unset($_SESSION["modifie"]);
    }
    ?>
    <?php
    function afficher($donneeBis, $i, $j)
    {
      if (!isset($donneeBis[$i][$j]) || ($donneeBis[$i][$j]) == "") {
        $afficher = false;
      } else {
        $afficher = true;
      }
      return ($afficher);
    }
    //on récupère les contenus des fichiers prof et élèves
    $contenu_du_fichierUserList = file_get_contents('../register/data/userList.txt');


    //on met chaque ligne dans un tableau
    $nbrUser = explode("\n", $contenu_du_fichierUserList);
    $j = 0;
    $i = 0;
    $fin = false;
    //on démarre une session
    /*on lit le tableau (donc le fichier text ligne par ligne)
jusqu'à ce qu'on ait trouvé un identifiant correspondant
ou jusqu'à la fin du tableau*/
    while (($j < count($nbrUser) - 1) && (!$fin)) {
      /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
  récupérer les différentes données présentes dans chaque ligne*/
      $donnee = explode("§", $nbrUser[$j]);
      /*on regarde si l'identifiant dans la ligne en cour est le bon*/
      if ($donnee[0] == $_SESSION['pseudo']) {
        /*si c'est le cas on passe fin a true pour arréter la recherche*/
        $fin = true;

        while (($i < count($donnee) - 1)) {
          /*on fait un tableau de tableau : on reprend le tableau séparer selon
    les § et on le sépare à nouveaux selon les | on pourra donc
    récupérer les différentes données en faisant $donneeBis[$i][$j]*/
          $donneeBis[$i] = explode("|", $donnee[$i]);
          $i++;
        }
        //Données modifiables :
    ?>
        <div id="Infos">
          <div id="BlocInfo">
            <h2>Photos !</h2>
            <ul>
              <li><img src="<?php echo ($donneeBis[12][0]); ?>"></img></li>
                <?php if (afficher($donneeBis, 12, 1)) { ?>
              <li><img src="<?php echo ($donneeBis[12][1]); ?>"></img></li>
            <?php }if (afficher($donneeBis, 12, 2)) { ?>
              <li><img src="<?php echo ($donneeBis[12][2]); ?>"></img></li>
            <?php }if (afficher($donneeBis, 12, 3)) { ?>
              <li><img src="<?php echo ($donneeBis[12][3]); ?>"></img></li>
            <?php } ?>
            </ul>
            <span>Vous pouvez mettre en ligne jusqu'à 4 photos !</span>
            <a href="./changePictures.php"><input type="button" value="Changer les photos !"></a>
          </div>
          <div id="BlocInfo">
            <h2>Informations Générales :</h2>
            <ul>
              <!--On ecrit chaque donnée avec soit donnee[$i] si la donnée de
        contient pas de | soit avec donneeBis[$i][$j] si elle en contient.
      Puis on stock la donnée dans une variable de session pour pouvoir la réutiliser-->
              <li>Pseudo : <?php echo ($donnee[0]);?></li>
              <?php if (afficher($donneeBis, 1, 0)) { ?>
                <li>Lieu de résidence : <?php echo ($donnee[1]);
                                        $_SESSION["lieuRes"] = $donnee[1]; ?></li>
              <?php } ?>
              <li>Sexe : <?php echo ($donnee[2]);
                          $_SESSION["sexe"] = $donnee[2]; ?></li>
              <li>Date de naissance : <?php echo ($donnee[3]); ?></li>
              <?php if (afficher($donneeBis, 4, 0)) { ?>
                <li>Profession : <?php echo ($donnee[4]);
                                  $_SESSION["profession"] = $donnee[4]; ?></li>
              <?php } ?>
              <li>Situation amoureuse : <?php echo ($donneeBis[5][0]);
                                        $_SESSION["situation"] = $donneeBis[5][0]; ?></li>
              <?php if (($donneeBis[5][1] == "1") || ($donneeBis[5][1] == "2") || ($donneeBis[5][1] == "3-5") || ($donneeBis[5][1] == "5+")) { ?>
                <li>Nombre d'enfants : <?php echo ($donneeBis[5][1]);
                                        $_SESSION["enfants"] = "on";
                                        $_SESSION["nombreEnf"] = $donneeBis[5][1]; ?></li>
              <?php } ?>
            </ul>
          </div>
          <div id="BlocInfo">
            <h2>Informations physiques :</h2>
            <ul>
              <li>Poids : <?php echo ($donneeBis[6][0]);
                          $_SESSION["poids"] = $donneeBis[6][0]; ?> kg</li>
              <li>Taille : <?php echo ($donneeBis[6][1]);
                            $_SESSION["taille"] = $donneeBis[6][1]; ?> cm</li>
              <li>Couleur des cheveux : <?php echo ($donneeBis[6][2]);
                                        $_SESSION["couleurCheveux"] = $donneeBis[6][2]; ?></li>
              <li>Couleur des yeux : <?php echo ($donneeBis[6][3]);
                                      $_SESSION["couleurYeux"] = $donneeBis[6][3]; ?></li>
            </ul>
          </div>
          <div id="BlocInfo">
            <h2>Informations profil :</h2>
            <ul>
              <?php if (afficher($donneeBis, 7, 0)) { ?>
                <li>Message d'accueil : <?php echo ($donnee[7]);
                                        $_SESSION["msgAcc"] = $donnee[7]; ?></li>
                <?php } if (afficher($donneeBis,8,0)) { ?>
                <li>Citation : <?php echo ($donnee[8]);
                                $_SESSION["citation"] = $donnee[8]; ?></li>
                <?php } if (afficher($donneeBis,9,0)){ ?>
                <li>Interets : <?php echo ($donnee[9]);
                                $_SESSION["interets"] = $donnee[9]; ?></li>
              <?php }
              if ($donnee[10] == "on") { ?>
                <li>Fumeur ? : <?php echo ("oui");
                                $_SESSION["fumeur"] = $donnee[10]; ?></li>
              <?php }
              if (($donnee[11][0] == "1") || ($donnee[11][0] == "2") || ($donnee[11][0] == "3+")) { ?>
                <li>Nombre de chiens : <?php echo ($donneeBis[11][0]);
                                        $_SESSION["chiens"] = "on";
                                        $_SESSION["nombreChiens"] = $donneeBis[11][0]; ?></li>
                                        <?php } if (afficher($donneeBis,11,1)){ ?>
                <li>Infos chiens : <?php echo ($donneeBis[11][1]);
                                    $_SESSION["infosChiens"] = $donneeBis[11][1]; ?></li>
              <?php } ?>

            </ul>
          </div>
          </div>
              <br>
          <div id="Infos">
            <div id="BlocInfo">
              <h2>Informations privées</h2>
              <ul>
                <li>Nom : <?php echo ($donneeBis[16][0]);
                          $_SESSION["nom"] = $donneeBis[16][0]; ?></li>
                <li>Prénom : <?php echo ($donneeBis[16][1]);
                              $_SESSION["prenom"] = $donneeBis[16][1]; ?></li>
                <li>Adresse : <?php echo ($donnee[17]);
                              $_SESSION["adresse"] = $donnee[17]; ?></li>
              </ul>
            </div>
          </div>

    <?php
      }
      //on passe à la ligne suivante
      $j++;
    }
    ?>
  </body>

  </html>
<?php
} else {
  header("Location: /home/accueil.php");
} ?>
