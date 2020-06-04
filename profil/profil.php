<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>

<head>

  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
  <link rel="stylesheet" type="text/css" href="profil.css">
  <link rel="shortcut icon" href="./../ressources/favicon.ico"/>
</head>

<body>
  <input type="button" class="boutonSpoiler" value="Infos Publiques" onclick=""></input>
<input type="button" class="boutonSpoiler" value="Infos Privées" onclick=""></input>
<input type="button" class="boutonSpoiler" value="Modifier mon profil" onclick=""></input>
<h2>Mon Profil</h2>
<?php
//on récupère les contenus des fichiers prof et élèves
$contenu_du_fichierUserList = file_get_contents('../register/data/userList.txt');
//on met chaque ligne dans un tableau
$nbrUser = explode("\n",$contenu_du_fichierUserList);
$j = 0;
$i = 0;
$fin = false;
//on démarre une session
session_start();
$_SESSION['pseudo'] = "lebroneclo";
$_SESSION['password'] = "gigi";
/*on lit le tableau (donc le fichier text ligne par ligne)
jusqu'à ce qu'on ait trouvé un identifiant et un mdp correspondant
ou jusqu'à la fin du tableau*/
while (($j<count($nbrUser)-1)&&(!$fin)){
  /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
  récupérer les différentes données présentes dans chaque ligne*/
  $donnee = explode("§",$nbrUser[$j]);
  /*on regarde si l'identifiant dans la ligne en cour est le bon ainsi que le mdp*/
  if($donnee[16] == $_SESSION['pseudo']){
    /*si c'est le cas on passe fin a true pour arréter la recherche*/
    $fin = true;

  while (($i<count($donnee)-1)){
    $donneeBis[$i] = explode("|",$donnee[$i]);
    echo("donneBis[i] = ".$donneeBis[$i][$i]."</br>");
    $i++;
    }
    //Données modifiables :
    ?>
    <div id="Bloc_Infos">
      <div id="Photos">
        <h3>Photos !</h3>
        <ul>
          <li>Photos : <?php echo("Ici une photo");?></li>
        </ul>
        <input type="button" class="boutonSpoiler" value="Ajouter une photo" onclick=""></input>
      </div>
      <div id="InfosGenerales">
        <h3>Informations Générales :</h3>
        <ul>
          <li>Nom : <?php echo($donneeBis[0][0]); $_SESSION["Nom"]=$donneeBis[0][0];?></li>
          <li>Prénom : <?php echo($donneeBis[0][1]); $_SESSION["Prénom"]=$donneeBis[0][1];?></li>
          <li>Adresse : <?php echo($donneeBis[1][0]); $_SESSION["Adresse"]=$donneeBis[1][0];?></li>
          <li>Lieu de résidence : <?php echo($donneeBis[1][1]); $_SESSION["LieuRes"]=$donneeBis[1][1];?></li>
          <li>Sexe : <?php echo($donnee[2]); $_SESSION["Sexe"]=$donnee[2];?></li>
          <li>Date de naissance : <?php echo($donnee[3]); $_SESSION["DateNaissance"]=$donnee[3];?></li>
          <li>Profession : <?php echo($donnee[4]); $_SESSION["Profession"]=$donnee[4];?></li>
          <li>Situation amoureuse : <?php echo($donneeBis[5][0]); $_SESSION["Situation"]=$donneeBis[5][0];?></li>
          <?php if(($donneeBis[5][1]=="1")||($donneeBis[5][1]=="2")||($donneeBis[5][1]=="3-5")||($donneeBis[5][1]=="5+")){ ?>
          <li>Nombre d'enfants : <?php echo($donneeBis[5][1]); $_SESSION["NbrEnfants"]=$donneeBis[5][1];?></li>
        <?php } ?>
        </ul>
      </div>
      <div id="InfosPhysiques">
        <h3>Informations physiques :</h3>
        <ul>
          <li>Poids : <?php echo($donneeBis[6][0]); $_SESSION["Poids"]=$donneeBis[6][0];?></li>
          <li>Taille : <?php echo($donneeBis[6][1]); $_SESSION["Taille"]=$donneeBis[6][1];?></li>
          <li>Couleur des cheveux : <?php echo($donneeBis[6][2]); $_SESSION["CouleurCheveux"]=$donneeBis[6][2];?></li>
          <li>Couleur des yeux : <?php echo($donneeBis[6][3]); $_SESSION["CouleurYeux"]=$donneeBis[6][3];?></li>
        </ul>
      </div>
      <div id="InfosProfil">
        <h3>Informations profil :</h3>
        <ul>
          <li>Message d'accueil : <?php echo($donnee[7]); $_SESSION["MsgAcc"]=$donnee[7];?></li>
          <li>Citation : <?php echo($donnee[8]); $_SESSION["Citation"]=$donnee[8];?></li>
          <li>Interets : <?php echo($donnee[9]); $_SESSION["Interets"]=$donnee[9];?></li>
<?php if($donnee[10]=="on"){ ?>
          <li>Fumeur ? : <?php echo("oui"); $_SESSION["Fumeur"]=$donnee[10];?></li>
        <?php } if(($donnee[11][0]=="1")||($donnee[11][0]=="2")||($donnee[11][0]=="3+")){ ?>
          <li>Nombre de chiens : <?php echo($donneeBis[11][0]); $_SESSION["NombreChiens"]=$donneeBis[11][0];?></li>
          <li>Infos chiens : <?php echo($donneeBis[11][1]); $_SESSION["InfosChiens"]=$donneeBis[11][1];?></li>
<?php } ?>
        </ul>
      </div>
    </div>

    <h3>Infos à ne pas écrire</h3>
    <ul>
      <li>Pseudo : <?php echo($donnee[16]);?></li>
      <li>Mot de passe : <?php echo($donnee[17]);?></li>
    </ul>
    <?php
  }
  //on passe à la ligne suivante
  $j++;
}
?>
</body>
