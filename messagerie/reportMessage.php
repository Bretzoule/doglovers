<?php 
session_start();
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["convID"]) && isset($_GET["msgID"]) && isset($_GET["raison"])) { // vérificaiton de requete
    if (file_exists($_GET["convID"])) {  // si le fichier existe
        $fichiermsg = file_get_contents($_GET["convID"]); // récupération des données du fichier
        $lineFichierMsg = explode("\n", $fichiermsg); // séparation des données par ligne 
        $lastvalue = false;
        $i = 0;
        while(($i < sizeof($lineFichierMsg)-1) && !$lastvalue) { // pour chaque élement
            $tmpSubArray = explode("§", $lineFichierMsg[$i]); // séparation par §
            if ($tmpSubArray[1] == $_GET["msgID"]) {
                $msgToStore = $lineFichierMsg[$i];
                $lastvalue = true;
            }
            $i++;
        }
        $msgToStore .= "§" . $_GET["convID"] . "§" . $_GET["raison"] . "\n";
        file_put_contents("./reportList.txt",$msgToStore,FILE_APPEND);
        if (!$lastvalue) {
            echo "Votre message n'existe pas.";
        } else {
            echo "Message reporté aux administrateurs.";
        }
    } else {
    echo "Votre conversation n'existe pas...";
    }
} else {
    echo "Erreur.";
}
?>
