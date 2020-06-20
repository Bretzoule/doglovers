<?php 

function startsWith($haystack, $needle)
    {
      $length = strlen($needle);
      return (substr($haystack, 0, $length) === $needle);
    }

function removeFromReportList($path, $msg)
{
    $donnees = file_get_contents("./reportList.txt");
    $dataSplit = explode("\n",$donnees);
    print_r($dataSplit);
    $i = 0;
    $lastvalue = false;
    while (($i < sizeof($dataSplit)) && (!$lastvalue)) {
        echo "yee";
        $subtmp = explode("§",$dataSplit[$i]);
        print_r($subtmp);
        if (($subtmp[1] == $msg) && ($subtmp[2] == $path)) {
            unset($dataSplit[$i]);
            $lastvalue = true;
        }
        $i++;
    }
    $donnees = implode("\n",$dataSplit);
    file_put_contents("./reportList.txt",$donnees);
}

session_start();
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["convID"]) && isset($_GET["msgID"]) && (startsWith($_GET["msgID"],$_SESSION["pseudo"]."_") || (intval($_SESSION["login_Type"]) == 3))) { // vérificaiton de requete
    if (file_exists($_GET["convID"])) { // si le fichier existe
        $fichiermsg = file_get_contents($_GET["convID"]); // récupération des données du fichier
        $lineFichierMsg = explode("\n", $fichiermsg); // séparation des données par ligne 
        $lastvalue = false;
        $i = 0;
        while(($i < sizeof($lineFichierMsg)-1) && !$lastvalue) { // pour chaque élement
            $tmpSubArray = explode("§", $lineFichierMsg[$i]); // séparation par §
            if ($tmpSubArray[1] == $_GET["msgID"]) {
                unset($lineFichierMsg[$i]);
                $lastvalue = true;
            }
            $i++;
        }
        $fichiermsg = implode("\n",$lineFichierMsg);
        file_put_contents($_GET["convID"],$fichiermsg);
        if (isset($_GET["adminMode"]) && $_GET["adminMode"] == "true" && (intval($_SESSION["login_Type"]) == 3)) {
         removeFromReportList($_GET["convID"],$_GET["msgID"]);
         header("Location: /admin/reports/listeReports.php");
        } else {
        echo "Message Supprimé avec succès";
        }
    } else {
    echo "Votre message n'existe pas....";
    }
} else {
    echo "Erreur";
}
?>