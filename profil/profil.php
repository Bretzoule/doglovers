<h2>Mon Profil</h2>
<?php
//on récupère les contenus des fichiers prof et élèves
$contenu_du_fichierUserList = file_get_contents('../register/data/userList.txt');
//on met chaque ligne dans un tableau
$nbrUser = explode("\n",$contenu_du_fichierUserList);
$j = 0;
//on démarre une session
session_start();
/*on lit le tableau (donc le fichier text ligne par ligne)
jusqu'à ce qu'on ait trouvé un identifiant et un mdp correspondant
ou jusqu'à la fin du tableau*/
while (($j<count($nbrUser)-1)){
  /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
  récupérer les différentes données présentes dans chaque ligne*/
  $donnee = explode("§",$nbrUser[$j]);
  /*on regarde si l'identifiant dans la ligne en cour est le bon ainsi que le mdp*/
  //  if(($donnee[21] == $_SESSION['pseudo'])&&($donnee[22] == $_SESSION['password'])){
      /*si c'est le cas on passe fin a true pour arréter la recherche*/
  //    $fin = true;
//Données modifiables :
?>
<h3>Informations Générales :</h3>
<ul>
<li>Nom : <?php echo($donnee[0]); $_SESSION["Nom"]=$donnee[0];?></li>
<li>Prénom : <?php echo($donnee[1]); $_SESSION["Nom"]=$donnee[0];?></li>
<li>Adresse : <?php echo($donnee[2]);?></li>
<li>Lieu de résidence : <?php echo($donnee[3]);?></li>
<li>Sex : <?php echo($donnee[4]);?></li>
<li>Date de naissance : <?php echo($donnee[5]);?></li>
<li>Profession : <?php echo($donnee[6]);?></li>
<li>Situation amoureuse : <?php echo($donnee[7]);?></li>
</ul>
<h3>Informations physiques :</h3>
<ul>
  <li>Poids : <?php echo($donnee[10]);?></li>
  <li>Taille : <?php echo($donnee[11]);?></li>
  <li>Couleur des cheveux : <?php echo($donnee[12]);?></li>
  <li>Couleur des yeux : <?php echo($donnee[13]);?></li>
</ul>
<h3>Informations profil :</h3>
<ul>
<li>Message d'accueil : <?php echo($donnee[14]);?></li>
<li>Citation : <?php echo($donnee[15]);?></li>
<li>Interets : <?php echo($donnee[16]);?></li>
<li>Fumeur ? : <?php echo($donnee[17]);?></li>
<li>Chien ? : <?php echo($donnee[18]);?></li>
<li>Nombre de chiens : <?php echo($donnee[19]);?></li>
</ul>
<h3>Photos !</h3>
<ul>
  <li>Photos : <?php echo($donnee[20]);?></li>
</ul>
<h3>Infos à ne pas écrire</h3>
<ul>
<li>Pseudo : <?php echo($donnee[21]);?></li>
<li>Mot de passe : <?php echo($donnee[22]);?></li>
</ul>
<?php
//}
    //on passe à la ligne suivante
    $j++;
}
 ?>
