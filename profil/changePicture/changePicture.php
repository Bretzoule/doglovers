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

        function phpAlert($msg)
        {
          echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        }

        $photosFilled = true;
        $_SESSION["photo1"] = $_SESSION["photo2"] = $_SESSION["photo3"] = $_SESSION["photo4"] = "";

        function testImages($photosFilled, &$erreurPhotos, $numPhoto)
        {
          if (empty($_FILES["photos" . $numPhoto]["name"]) && $_FILES["photos" . $numPhoto]["error"] == 0) {
            $_SESSION["photo" . $numPhoto] = "";
          } else {
            $target_dir = "./../../register/data/uploads/";
            $target_toWrite = "/register/data/uploads/";
            if ($_FILES["photos" . $numPhoto]["error"] == 0) {
              $target_file = $target_dir . basename($_FILES["photos" . $numPhoto]["tmp_name"]);
              $imageFileType = strtolower(pathinfo(basename($_FILES["photos" . $numPhoto]["name"]), PATHINFO_EXTENSION));
              $check = getimagesize($_FILES["photos" . $numPhoto]["tmp_name"]);
              if ($check === false) {
                $photosFilled = false;
                $erreurPhotos = "Le fichier ne semble pas être une image";
              } else
                if (file_exists($target_file)) {
                $photosFilled = false;
                $erreurPhotos = "Un fichier portant le même nom existe déjà...";
              } else
                if ($_FILES["photos" . $numPhoto]["size"] > 10000000) {
                $photosFilled = false;
                $erreurPhotos = "Le fichier est trop volumineux !";
              } else
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $photosFilled = false;
                $erreurPhotos = "Format non pris en charge, les formats d'images acceptés sont .png, .jpg, .jpeg et .gif !";
              }
              if ($photosFilled) {
                $file_name = uniqid($prefix = "photo_") . "." . $imageFileType;
                if (move_uploaded_file($_FILES["photos" . $numPhoto]["tmp_name"], $target_dir . $file_name)) {
                  $_SESSION["photo" . $numPhoto] = $target_toWrite . $file_name;
                } else {
                  phpAlert("Une erreur s'est produite lors de l'envoi du fichier.");
                  $erreurPhotos = "Une erreur s'est produite.";
                  $photosFilled = false;
                }
              } else {
                phpAlert("Image trop grande, merci d'uploader des images dont la taille de dépasse pas" . ini_get("upload_max_filesize") . "o chacune.");
                $photosFilled = false;
              }
            }
          }
          return ($photosFilled);
        }



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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

              if (testImages($photosFilled, $erreurPhotos, 0) && testImages($photosFilled, $erreurPhotos, 1) && testImages($photosFilled, $erreurPhotos, 2) && testImages($photosFilled, $erreurPhotos, 3)) {
                $_SESSION["picChange"] = "true";
                header('Location: ./confirmChangePicture.php');
              }
            }

        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <ul id="modeligneSAH">
                <li>
                  <a href="./removePicture.php?numero=0"><input type="button" value="Supprimer la photo !"></a>
                  <img src="<?php if (afficher($donneeBis, 12, 0)) {
                              echo ($donneeBis[12][0]);
                            } else echo "/ressources/logo.png" ?>"></img> <br>
                  <input type="file" id="photo0" name="photos0" accept="image/png, image/jpeg, image/jpg, image/gif"> <br>
                </li>
                <li>
                  <a href="./removePicture.php?numero=1"><input type="button" value="Supprimer la photo !"></a>
                  <img src="<?php if (afficher($donneeBis, 12, 1)) {
                              echo ($donneeBis[12][1]);
                            } else echo "/ressources/logo.png" ?>"></img> <br>
                  <input type="file" id="photo1" name="photos1" accept="image/png, image/jpeg, image/jpg, image/gif">
                </li>
                <li>
                  <a href="./removePicture.php?numero=2"><input type="button" value="Supprimer la photo !"></a>
                  <img src="<?php if (afficher($donneeBis, 12, 2)) {
                              echo ($donneeBis[12][2]);
                            } else echo "/ressources/logo.png" ?>"></img> <br>
                  <input type="file" id="photo2" name="photos2" accept="image/png, image/jpeg, image/jpg, image/gif">
                </li>
                <li>
                  <a href="./removePicture.php?numero=3"><input type="button" value="Supprimer la photo !"></a>
                  <img src="<?php if (afficher($donneeBis, 12, 3)) {
                              echo ($donneeBis[12][3]);
                            } else echo "/ressources/logo.png" ?>"></img> <br>
                  <input type="file" id="photo3" name="photos3" accept="image/png, image/jpeg, image/jpg, image/gif">
                </li>
              </ul>
              <input type="submit" value="Modifier !"></input>
            </form>
            <?php
            if (isset($_SESSION["erreur"])) {
              echo "<span>" . $_SESSION["erreur"] . "</span>";
              unset($_SESSION["erreur"]);
            }
            ?>
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