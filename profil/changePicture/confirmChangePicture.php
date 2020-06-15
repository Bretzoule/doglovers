<?php
session_start();

function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
// permet de trier les photos si jamais la personne a voulu mettre qqch dans la photo 3 et rien en photo 1 et 2
function triPhoto() 
{
    $j = 0;
    while($j < 4) {
    for ($i=0; $i < 3; $i++) {
        $iplus1 = $i+1;
        if (empty($_SESSION["photo".$i])) {

            $_SESSION["photo".$i] = $_SESSION["photo" . $iplus1];
            $_SESSION["photo" . $iplus1] = "";
        }
    }
    $j++;
  }
}
// permet de changer les images
function changePic(string $photos): string
{
    echo $_SESSION["photo"."0"];
    triPhoto();
    $photos = explode("|", $photos);
    $i = 0;
    while (($i < 4) && !empty($_SESSION["photo" . $i])) {
        if (!isset($photos[$i])) {
            array_push($photos, $_SESSION["photo" . $i]);
        } else {
            if (!empty($photos[$i])) {
                $response = unlink("./../../".$photos[$i]);
            }
            $photos[$i] = $_SESSION["photo".$i];
        }
        $i++;
    }
   $photos = implode("|", $photos);
    return $photos;
}

if (isset($_SESSION["picChange"]) && ($_SESSION["picChange"] == "true")) { // vérification demande de changement d'images
    $path = "./../../register/data/userList.txt"; // chemin fichier utilisateur
    $file = fopen($path, 'r'); // ouverture du fichier
    if ($file) { // si le fichier est bien ouvert alors
        $lastvalue = true;
        while ((($line = fgets($file)) !== false) && $lastvalue) { // on récupère chaque ligne tant que l'on trouve pas l'utilisateur
            $userData = explode("§", $line); // séparation des données de la ligne utilisateur
            //echo "|" . trim($_SESSION["adresseM"]) . "| == |" . trim($userData[sizeof($userData)-2]) . "| <br>";
            if (trim($_SESSION["pseudo"]) == trim($userData[0])) { // si le pseudo ene entrée  correspond a un pseudo en bdd alors 
                $contents = file_get_contents($path);
                $userData[sizeof($userData) - 7] = changePic($userData[sizeof($userData) - 7]); // récupération des données à modifier
                $userData = implode("§", $userData);
                $contents = str_replace($line, $userData, $contents);
                file_put_contents($path, $contents);
                $lastvalue = false;
            }
        }
        fclose($file);
    } else {
        phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
    }
    for ($i=0; $i < 4; $i++) { 
        unset($_SESSION["photo".$i]);
    }
    unset($_SESSION["picChange"]);
    header("Location: ./changePicture.php");
} else {
    header("Location: /errors/erreur403.php");
}
?>