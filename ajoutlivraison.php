<?PHP
include "../entites/livraison.php";
include "../core/livraisonC.php";

if (isset($_POST['idclient']) and isset($_POST['nom']) and isset($_POST['adresse']) and isset($_POST['numtel']) and isset($_POST['numcommande'])){
$livraison1=new livraison($_POST['idclient'],$_POST['nom'],$_POST['adresse'],$_POST['numtel'] ,$_POST['numcommande']);
$livraison1C=new livraisonC();
$livraison1C->ajouterlivraison($livraison1);
header('Location: afficherlivraison.php');

}else{
	echo "verifier les champs";
}
//*/

?>
