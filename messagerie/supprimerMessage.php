<?php 
session_start();
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["convID"]) && isset($_GET["msgID"])) { // vérificaiton de requete
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
        echo "Message Supprimé avec succès";
    } else {
    echo "Votre message n'existe pas....";
    }
} else {
    echo "Erreur";
}
?>