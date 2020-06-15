<?php 
session_start();

function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

function removePic(string $photo, int $indice):string
{
    $photo = explode("|",$photo);
    if (!empty($photo[$indice])) {
        $response = unlink("./../../".$photo[$indice]);
        $photo[$indice] = "";
        $photo = array_filter($photo);
        unset($photo[sizeof($photo)-1]);
    }
    
    $photo = implode("|",$photo);
    return $photo;
}

function getData($indice) {
    $path = "./../../register/data/userList.txt"; // chemin fichier utilisateur
    $file = fopen($path, 'r'); // ouverture du fichier
    if ($file) { // si le fichier est bien ouvert alors
        $lastvalue = true;
        while ((($line = fgets($file)) !== false) && $lastvalue) { // on récupère chaque ligne tant que l'on trouve pas l'utilisateur
            $userData = explode("§", $line); // séparation des données de la ligne utilisateur
            //echo "|" . trim($_SESSION["adresseM"]) . "| == |" . trim($userData[sizeof($userData)-2]) . "| <br>";
            if (trim($_SESSION["pseudo"]) == trim($userData[0])) { // si le pseudo ene entrée  correspond a un pseudo en bdd alors 
                $contents = file_get_contents($path);
                $userData[sizeof($userData) - 7] = removePic($userData[sizeof($userData) - 7],$indice); // récupération des données à modifier
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
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && (isset($_SESSION["login_Type"])) && ($_SESSION["login_Type"] > 0)) {
    $nbPic = intval($_GET["numero"]);
    switch ($nbPic) {
        case '0':
            getData(0);
            break;
        case '1':
            getData(1);
            break;
        case '2':
            getData(2);
            break;
        case '3':
            getData(3);
            break;
        default:
            $_SESSION["erreur"] = "Erreur, image inconnue.";
            break;
    }
    //header("Location: ./changePicture.php");
} else {
    //header("Location: /home/accueil.php");
}

?>