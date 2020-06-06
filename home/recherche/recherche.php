<?php

$response = "";
echo $response;
$elementsRecherche = explode(' ', $_GET["recherche"]); // recupération des mots clés.
$file = fopen('./../../register/data/userList.txt', 'r'); // ouverture du fichier
$data = array();
if ($file) {
    while (($line = fgets($file)) !== false) {
        $userData = explode("§", $line);
        array_push($data,array_slice($userData,0,sizeof($userData)-7));
    }
    fclose($file);
} else {
    phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
}

foreach($data as $utilisateur) {
    foreach ($elementsRecherche as $keyword) {
        $found = false;
        $i = 0;
        while ($i < sizeof($utilisateur) && !$found) {
            if (stristr($utilisateur[$i],$keyword)) {
                 $response .= $utilisateur[0];
                $found = true;
            }
            $i++;
        }
    }
}

if ($response == "") {
    $response = "Aucun résultat.";
}

echo $response;