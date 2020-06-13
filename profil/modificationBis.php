<?php
/*
    $path = "./../../register/data/userList.txt"; // chemin fichier utilisateur
    $file = fopen($path, 'r'); // ouverture du fichier
    if ($file) { // si le fichier est bien ouvert alors
        $lastvalue = true;
        while ((($line = fgets($file)) !== false) && $lastvalue) { // on récupère chaque ligne tant que l'on trouve pas l'utilisateur
            $userData = explode("§", $line); // séparation des données de la ligne utilisateur
            //echo "|" . trim($_SESSION["adresseM"]) . "| == |" . trim($userData[sizeof($userData)-2]) . "| <br>";
          $contents = file_get_contents($path);
                $userData[sizeof($userData)-1] = password_hash($_SESSION['Newpassword'],PASSWORD_DEFAULT);
                $userData = implode("§",$userData);
                $contents = str_replace($line,$userData . "\r\n",$contents);
                file_put_contents($path, $contents);
                $lastvalue = false;
        }
        fclose($file);*/
        ?>
        <?php
        //on récupère les contenus des fichiers prof et élèves
        $contenu_du_fichierUserList = file_get_contents('../register/data/userList.txt');
        //on met chaque ligne dans un tableau
        $nbrUser = explode("\n", $contenu_du_fichierUserList);
        $j = 0;
        $i = 0;
        $fin = false;
        while (($j < count($nbrUser) - 1) && (!$fin)) {
          /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
      récupérer les différentes données présentes dans chaque ligne*/
          $donnee = explode("§", $nbrUser[$j]);
          /*on regarde si l'identifiant dans la ligne en cour est le bon ainsi que le mdp*/
          if ($donnee[0] == $_SESSION['pseudo']) {
            /*si c'est le cas on passe fin a true pour arréter la recherche*/
            $fin = true;
            //on cherche dans le fichier si l'utilisateur en ligne y est
            $content =  $_POST['pseudo']
          . "§" . $_SESSION['LieuRes']
          . "§" . $_SESSION['Sexe'] . "§" . $_SESSION['DateNaissance'] . "§" . $_SESSION['Profession']
          . "§" . $_SESSION['Situation'] . "|" . $nbrEnfants
          . "§" . $_SESSION['poids'] . "|" . $_SESSION['taille'] . "|" . $_SESSION['couleurCheveux'] . "|" . $_SESSION['couleurYeux']
          . "§" . $_SESSION['MsgAcc'] . "§" . $_SESSION['citation'] . "§" . $_SESSION['interets'] . "§" . $_SESSION['fumeur']
          . "§" . $nbrDoggos . "|" . $infosChiens
          . "§" . $_SESSION['photos']
          . "§" . "free" // [sizeof(userData)-6]
          . "§" . date("Y-m-d")
          . "§" . uniqid($prefix = "user_")
          . "§" . $_POST['nom'] . "|" . $_SESSION['prenom']
          . "§" . $_SESSION['adresse']
          . "§" . password_hash($_SESSION['password'], PASSWORD_DEFAULT) . "\r\n";
$contents = str_replace($donnee,$userData . "\r\n",$content);
              file_put_contents('./data/userList.txt', $contents);
          }
          $j++;
        }
        ?>
