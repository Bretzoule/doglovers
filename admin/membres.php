<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) == 3)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Liste des Utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="./../../profil/monProfil/MonProfil.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Liste des Membres</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="../home/accueil.php">Accueil</a></li>
        <li><a class="active" href="">Liste des Utilisateurs</a></li>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
      </ul>
    </div>
    <div id="Infos">
      <div id="autoResize">
          <?php 
          echo "<table>
          <tr>
              <th class='tg-ycr8'>Bannir</th>
              <th class='tg-ycr8'>Supprimer Profil</th>
              <th class='tg-ycr8'>Modifier le Profil</th>
              <th class='tg-ycr8'>Pseudo</th>
              <th class='tg-ycr8'>Lieu de résidence</th>
              <th class='tg-ycr8'>Sexe</th>
              <th class='tg-ycr8'>Date de Naissance</th>
              <th class='tg-ycr8'>Profession</th>
              <th class='tg-ycr8'>Sitatuation</th>
              <th class='tg-ycr8'>Nombre d'enfants</th> 
              <th class='tg-ycr8'>Taille</th>
              <th class='tg-ycr8'>Poids</th>
              <th class='tg-ycr8'>Couleur Cheveux</th>
              <th class='tg-ycr8'>Couleur Yeux</th>
              <th class='tg-ycr8'>Message Accueil</th>
              <th class='tg-ycr8'>Citation</th>
              <th class='tg-ycr8'>Interets</th>
              <th class='tg-ycr8'>Fumeur</th>
              <th class='tg-ycr8'>Nombre de Chiens</th>
              <th class='tg-ycr8'>Informations Chiens</th>
              <th class='tg-ycr8'>Statut</th>
              <th class='tg-ycr8'>Date Inscription</th>
              <th class='tg-ycr8'>UID</th>
              <th class='tg-ycr8'>Nom</th>
              <th class='tg-ycr8'>Prénom</th>
              <th class='tg-ycr8'>Adresse Mail</th>
              </tr>\n";
              ?>
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
    $contenu_du_fichierUserList = file_get_contents('./../register/data/userList.txt');
    
    //on met chaque ligne dans un tableau
    $nbrUser = explode("\n", $contenu_du_fichierUserList);
    $j = 0;
    $i = 0;
    //on démarre une session
    /*on lit le tableau (donc le fichier text ligne par ligne)
jusqu'à ce qu'on ait trouvé un identifiant correspondant
ou jusqu'à la fin du tableau*/
    while ($j < count($nbrUser) - 1) {
      /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
  récupérer les différentes données présentes dans chaque ligne*/
      $donnee = explode("§", $nbrUser[$j]);

        while (($i < count($donnee) - 1)) {
          /*on fait un tableau de tableau : on reprend le tableau séparer selon
    les § et on le sépare à nouveaux selon les | on pourra donc
    récupérer les différentes données en faisant $donneeBis[$i][$j]*/
          $donneeBis[$i] = explode("|", $donnee[$i]);
          $i++;
        } 
        ?>
              <?php
                  echo "<tr>
                    <td class='tg-wa5c'><a href='./bannir/bannir.php?user=". $donnee[0] ."'><input type='button' id='bouton2' value='Bannir'></a></td>
                    <td class='tg-wa5c'><a href='./bannir/supprimerCompte.php?user=". $donnee[0] ."'><input type='button' id='bouton2' value='Supprimer'></a></td>
                    <td class='tg-wa5c'><a href='./bannir/editUser.php?user=". $donnee[0] ."'><input type='button' id='bouton2' value='Modifier'></a></td>
                    <td class='tg-wa5c'>" . $donnee[0] ."</td>
                    <td class='tg-wa5c'>" . $donnee[1] . "</td>
                    <td class='tg-wa5c'>" . $donnee[2] . "</td>
                    <td class='tg-wa5c'>" . $donnee[3] . "</td>
                    <td class='tg-wa5c'>" . $donnee[4] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[5][0] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[5][1] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[6][0] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[6][1] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[6][2] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[6][3] . "</td>
                    <td class='tg-wa5c'>" . $donnee[7] . "</td>
                    <td class='tg-wa5c'>" . $donnee[8] . "</td>
                    <td class='tg-wa5c'>" . $donnee[9] . "</td>
                    <td class='tg-wa5c'>" . $donnee[10] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[11][0] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[11][1] . "</td>
                    <td class='tg-wa5c'>" . $donnee[13] . "</td>
                    <td class='tg-wa5c'>" . $donnee[14] . "</td>
                    <td class='tg-wa5c'>" . $donnee[15] . "</td>
                    <td class='tg-wa5c'>" . $donneeBis[16][0] . "</td>  
                    <td class='tg-wa5c'>" . $donneeBis[16][1] . "</td>
                    <td class='tg-wa5c'>" . $donnee[17] . "</td>
                    </tr> \n\r";
      //on passe à la ligne suivante
      $j++;
      $i = 0;
    }
    echo "</table>"
?>
        </div>
        </div>
  </body>

  </html>
  <?php
} else {
header("Location: /home/accueil.php");
}
?>