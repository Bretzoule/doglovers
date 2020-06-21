<?php
//on démarre une session
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) == 3)) { ?>
  <!DOCTYPE html>
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Liste des Signalements</title>
    <link rel="stylesheet" type="text/css" href="./../../profil/monProfil/MonProfil.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Liste des Signalements</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="/home/accueil.php">Accueil</a></li>
        <li><a href="/admin/membres.php">Liste des Utilisateurs</a></li>
        <li><a href="/admin/reports/listeReports.php">Liste des Signalements</a></li>
        <li><a class="active" href="">Liste des Conversations</a></li>
        <li class="deconnexion"><a href="/login/logout.php">Deconnexion</a></li>
      </ul>
    </div>
    <div id="Infos">
      <div id="autoResize">
          <?php 
          echo "<table>
          <tr>
          <th class='tg-ycr8'>Voir Conversation</th>
          <th class='tg-ycr8'>Utilisateur 1</th>
          <th class='tg-ycr8'>Utilisateur 2</th>
          <th class='tg-ycr8'>ID Conversation</th>
              </tr>\n";
              ?>

              <?php


                // Merci stack Overflow - https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
                  function startsWith($haystack, $needle)
                {
                        $length = strlen($needle);
                        return (substr($haystack, 0, $length) === $needle);
                }

              $files = glob("./../messagerie/*.txt");
              for ($i=0; $i < sizeOf($files); $i++) {
                  $files[$i] = substr($files[$i],16);
                  if (startsWith($files[$i],"destinataires_") || ($files[$i] == "reportList.txt")) {
                      $files[$i] = "";
                  }
              }
              $files = array_filter($files);
              $files = array_values($files);
              $i = 0;
              while ($i < sizeof($files)) {
                  $tmpname = explode("_",$files[$i]);
                  echo "<tr>
                    ";
                    echo "<td class='tg-wa5c'><a href='./reports/afficheConversationAdmin.php?convID=". $files[$i] ."'><input type='button' id='bouton2' value='Afficher conversation'></a></td>
                    <td class='tg-wa5c'>" . $tmpname[0] ."</td>
                    <td class='tg-wa5c'>" . $tmpname[1] . "</td>
                    <td class='tg-wa5c'>" . $files[$i] . "</td>
                    </tr> \n\r";
                    $i++;
              }
      //on passe à la ligne suivante
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