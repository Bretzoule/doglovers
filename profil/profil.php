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
    <?php
    function afficher($donneeBis, $i, $j)
    {
      if ($donneeBis[$i][$j] == "") {
        $afficher = false;
      } else {
        $afficher = true;
      }
      return ($afficher);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $user = $_GET["user"];
    ?>
      <div id="blocTitre"></div>
      <div id="Titre">
        <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
        <h1>Profil de <?php echo ($user); ?></h1>
      </div>
      <div class="menu">
        <ul>
          <li><a href="../home/accueil.php">Accueil</a></li>
          <li><a class="active" href="">Infos <?php echo ($user); ?></a></li>
          <?php
          if (intval($_SESSION["login_Type"]) >= 2) { ?>
            <li><a href="">Envoyer un message à <?php echo ($user); ?></a></li>
          <?php } ?>
          <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
        </ul>
      </div>
      <?php
      // Merci stack Overflow - https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
      function startsWith($haystack, $needle)
      {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
      }
      //
      //le profil c'est celui qui est visité  $user
      //l'utilisateur c'est celui qui visite : $_SESSION['pseudo]
      //$utilisateurEnLigne c'est la ligne du fichier de la forme $user§visiteur1|nbvisites§visteur2|nbvisites...
      $contentBis = file_get_contents("../register/data/matchs.txt");
      $utilisateurEnLigne = explode("\n", $contentBis);
      $profilTrouve = false;
      $visiteurTrouve = false;
      $a = 0;
      //on cherche dans le fichier si l'utilisateurenligne y est
      while (($a < count($utilisateurEnLigne) - 1) && !$profilTrouve) {
        //on met les diférents noms de visiteurs ainsi que leur nombre de visites dans des cases
        $detailUtilisateur = explode("§", $utilisateurEnLigne[$a]);
        //trim permet de supprimer les espaces en début et en fin de chaîne -- Louve adooooooooore cette fonction <3 
        if (trim($detailUtilisateur[0]) == trim($user)) {
          //on initialise les variables
          $profilTrouve = true;
          $i = 1;
          //on regarde si le profil sélectionné à déjà été vu par l'utilisateur
          while (($i <= count($detailUtilisateur) - 1) && !$visiteurTrouve) {
            //print_r($detailUtilisateur);
            //strpos retourne l'index de la valeur recherchée ou "false" si elle n'apparait pas dans la chaîne 
            //si c'est le cas alors on incrémente le nombre de visites
            if (strpos(trim($detailUtilisateur[$i]), trim($_SESSION["pseudo"])) !== false) {
              //on sépare les données de l'utilisateur 
              $sousDetails = explode("|", $detailUtilisateur[$i]);
              //intval permet de retourner la valeur en "int" d'une chaine de caractères
              $sousDetails[1] = intval($sousDetails[1]) + 1; //on incrémente
              //implode concatenne les cases d'un tableau avec comme séparateur ce qu'il y a entre les guillemets
              //on rassemble le tableau en chaine de caractere
              $detailUtilisateur[$i] = implode("|", $sousDetails);
              //on arrête la recherche
              $visiteurTrouve = true;
            }
            $i++;
          }
          //on rassemble ici aussi
          $tmpUtilisateurEnLigne = trim(implode("§", $detailUtilisateur));
          //si l'utilisateur n'as jamais visité le profil alors on l'ajoute
          if (!$visiteurTrouve) {
            $tmpUtilisateurEnLigne = trim($tmpUtilisateurEnLigne) . "§" . trim($_SESSION["pseudo"]) . "|1";
          }
          if ($profilTrouve) {
            $k = 0;
            $lineFound = false;
            while (($k < count($utilisateurEnLigne)) && (!$lineFound)) {
              if (startsWith($utilisateurEnLigne[$k], $user)) {
                $utilisateurEnLigne[$k] = $tmpUtilisateurEnLigne;
                $lineFound = true;
              }
              $k++;
            }
            $contentBis = implode("\n", $utilisateurEnLigne);
            echo $contentBis;
            // echo $a;
            // //str_replace cherche ca $utilisateurEnLigne[$a] dans $contentBis et le remplace pas $tmpUtilisateurEnLigne
            // echo "#" . $tmpUtilisateurEnLigne . "# == #" . $utilisateurEnLigne[$a] . "# <br>"; 
            // $pattern = "/\b" . $tmpUtilisateurEnLigne . "\b.*\n/ui";
            // $contentBis = preg_replace($pattern, $tmpUtilisateurEnLigne, $contentBis);
            // //on met le contenu dans le fichier
            file_put_contents("../register/data/matchs.txt", $contentBis);
          }
        }
        $a++; // on incrémente
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
        if ($donnee[0] == $user) {
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
                <li>Photos : <img src="<?php echo ($donnee[12]); ?>"></img></li>
              </ul>
            </div>
            <div id="BlocInfo">
              <h2>Informations Générales :</h2>
              <ul>
                <!--On ecrit chaque donnée avec soit donnee[$i] si la donnée de
        contient pas de | soit avec donneeBis[$i][$j] si elle en contient.
      Puis on stock la donnée dans une variable de session pour pouvoir la réutiliser-->
                <li>Pseudo : <?php echo ($donnee[0]);
                              $_SESSION["Pseudo"] = $donnee[0] ?></li>
                <?php if (afficher($donneeBis, 1, 0)) { ?>
                  <li>Lieu de résidence : <?php echo ($donnee[1]);
                                          $_SESSION["LieuRes"] = $donnee[1]; ?></li>
                <?php } ?>
                <li>Sexe : <?php echo ($donnee[2]);
                            $_SESSION["Sexe"] = $donnee[2]; ?></li>
                <li>Date de naissance : <?php echo ($donnee[3]);
                                        $_SESSION["DateNaissance"] = $donnee[3]; ?></li>
                <?php if (afficher($donneeBis, 4, 0)) { ?>
                  <li>Profession : <?php echo ($donnee[4]);
                                    $_SESSION["Profession"] = $donnee[4]; ?></li>
                <?php } ?>
                <li>Situation amoureuse : <?php echo ($donneeBis[5][0]);
                                          $_SESSION["Situation"] = $donneeBis[5][0]; ?></li>
                <?php if (($donneeBis[5][1] == "1") || ($donneeBis[5][1] == "2") || ($donneeBis[5][1] == "3-5") || ($donneeBis[5][1] == "5+")) { ?>
                  <li>Nombre d'enfants : <?php echo ($donneeBis[5][1]);
                                          $_SESSION["NbrEnfants"] = $donneeBis[5][1]; ?></li>
                <?php } ?>
              </ul>
            </div>
            <div id="BlocInfo">
              <h2>Informations physiques :</h2>
              <ul>
                <li>Poids : <?php echo ($donneeBis[6][0]);
                            $_SESSION["Poids"] = $donneeBis[6][0]; ?> kg</li>
                <li>Taille : <?php echo ($donneeBis[6][1]);
                              $_SESSION["Taille"] = $donneeBis[6][1]; ?> cm</li>
                <li>Couleur des cheveux : <?php echo ($donneeBis[6][2]);
                                          $_SESSION["CouleurCheveux"] = $donneeBis[6][2]; ?></li>
                <li>Couleur des yeux : <?php echo ($donneeBis[6][3]);
                                        $_SESSION["CouleurYeux"] = $donneeBis[6][3]; ?></li>
              </ul>
            </div>
            <div id="BlocInfo">
              <h2>Informations profil :</h2>
              <ul>
                <?php if (afficher($donneeBis, 7, 0)) { ?>
                  <li>Message d'accueil : <?php echo ($donnee[7]);
                                          $_SESSION["MsgAcc"] = $donnee[7]; ?></li>
                  <?php} if (afficher($donneeBis,8,0)){ ?>
                  <li>Citation : <?php echo ($donnee[8]);
                                  $_SESSION["Citation"] = $donnee[8]; ?></li>
                  <?php} if (afficher($donneeBis,9,0)){ ?>
                  <li>Interets : <?php echo ($donnee[9]);
                                  $_SESSION["Interets"] = $donnee[9]; ?></li>
                <?php }
                if ($donnee[10] == "on") { ?>
                  <li>Fumeur ? : <?php echo ("oui");
                                  $_SESSION["Fumeur"] = $donnee[10]; ?></li>
                <?php }
                if (($donnee[11][0] == "1") || ($donnee[11][0] == "2") || ($donnee[11][0] == "3+")) { ?>
                  <li>Nombre de chiens : <?php echo ($donneeBis[11][0]);
                                          $_SESSION["NombreChiens"] = $donneeBis[11][0]; ?></li>
                  <li>Infos chiens : <?php echo ($donneeBis[11][1]);
                                      $_SESSION["InfosChiens"] = $donneeBis[11][1]; ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>

    <?php
        }
        //on passe à la ligne suivante
        $j++;
      }
      if (!$fin) {
        echo ("<h1>Une erreur s'est produite, ce profil n'existe pas.</h1>");
      }
    } else {
      echo ("Une erreur s'est produite, ce profil n'existe pas.");
    }
    ?>
  </body>

  </html>
<?php
} else {
  header("Location: /home/accueil.php");
}
?>