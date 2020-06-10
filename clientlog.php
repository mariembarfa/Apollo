<?PHP
require_once 'C:/wamp64/www/crud_livraison/entites/client.php';

if ($_GET['action']=="out") {
	session_start();
//session_unset ();

session_destroy();
header("Location:index.php");

}
else{
$user=client::checklogin($_POST['username'],$_POST['password']);
if($user)
{
session_start();

$_SESSION['id']=$user['id'];
$_SESSION['nom']=$user['nom'];
$_SESSION['prenom']=$user['prenom'];
$_SESSION['email']=$user['email'];
$_SESSION['username']=$user['username'];
$_SESSION['adresse']=$user['adresse'];
$_SESSION['tel']=$user['tel'];
$_SESSION['password']=$user['password'];
$_SESSION['role']=$user['role'];
header("Location:afficherlivraison.php");
}
else
{
    header("Location:afficherlivraison.php");
}
}



?>
