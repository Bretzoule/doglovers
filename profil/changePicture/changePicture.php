<?php
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
    <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
    <html>

    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>Dog Lovers - Recherche</title>
        <link rel="stylesheet" type="text/css" href="./../changementPw/modificationPw.css">
        <link rel="shortcut icon" href="./../../ressources/favicon.ico" />
    </head>
    <body>
    <div id="bloc_Image_reset">
    <a href="./../monProfil/MonProfil.php"><img id="bloc_ImageTitre" src="/ressources/logoBis.png" alt="logo"></img></a>
            <div id="oubliage">
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
    $contenu_du_fichierUserList = file_get_contents('../../register/data/userList.txt');


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
        
    ?>
            <ul id="modeLIGNESAH">
              <li><img src="<?php if (afficher($donneeBis, 12, 0)) { echo ($donneeBis[12][0]); } else echo "/ressources/logo.png"?>"></img> <br>
              <input type="file" id="photo1" name="photos" accept="image/png, image/jpeg, image/jpg, image/gif"> <br>
              </li>  
              <li><img src="<?php if (afficher($donneeBis, 12, 1)) { echo ($donneeBis[12][1]); } else echo "/ressources/logo.png"?>"></img> <br>
              <input type="file" id="photo2" name="photos" accept="image/png, image/jpeg, image/jpg, image/gif"> <br>
            </li> 
              <li><img src="<?php if (afficher($donneeBis, 12, 2)) { echo ($donneeBis[12][2]); } else echo "/ressources/logo.png" ?>"></img> <br>
              <input type="file" id="photo3" name="photos" accept="image/png, image/jpeg, image/jpg, image/gif"> <br>
            </li> 
              <li><img src="<?php if (afficher($donneeBis, 12, 3)) { echo ($donneeBis[12][3]); } else echo "/ressources/logo.png" ?>"></img> <br>
              <input type="file" id="photo4" name="photos" accept="image/png, image/jpeg, image/jpg, image/gif"> <br>
            </li>
            </ul>
            <input type="submit" value="Modifier !"></input>
        </div> 
        </body>
    </html>
    <?php
      }
      //on passe à la ligne suivante
      $j++;
    }
    ?>
<?php
} else {
    header('Location: ./../errors/erreur403.php');
}
?>