
<html>
 <form method="POST" action="">
 Rechercher un mot : <input type="text" name="recherche">
 <input type="SUBMIT" value="Search!">
 </form>
 </html>

 <?php

$db_server = 'localhost'; // Adresse du serveur MySQL
$db_name = 'marketing';            // Nom de la base de données
$db_user_login = 'root';  // Nom de l'utilisateur
$db_user_pass = '';       // Mot de passe de l'utilisateur

// Ouvre une connexion au serveur MySQL
$conn = mysqli_connect($db_server,$db_user_login, $db_user_pass, $db_name);


 // Récupère la recherche
 $recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

 // la requete mysql
 $q = $conn->query(
 "SELECT idclient,nom,adresse,numtel,numcommande FROM livraison
  WHERE idclient LIKE '%$recherche%'
  OR nom LIKE '%$recherche%'
    OR adresse LIKE '%$recherche%'
      OR numtel LIKE '%$recherche%'
        OR numcommande LIKE '%$recherche%'
  LIMIT 10");
  echo "<tr><td><br>";
       echo 'idclient , Nom , adresse , numtel,numcommande  <br/>';
  echo "</div></td></tr>";
 // affichage du résultat
  while( $r = mysqli_fetch_array($q)){
    echo 'Résultat de la recherche: '.$r['idclient'].', '.$r['nom'].' , '.$r['adresse'].'<br />'
   ;
 }
?>
