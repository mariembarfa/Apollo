
 <?php
require_once "C:/wamp64/www/crud_livraison/core/config.php";
class clientC
 {
	function ajouterclient($client)
	{
		$sql="insert into user (
			nom,prenom,email,username,adresse,tel,password,date_crea,role) values (:nom,:prenom,:email,:username,:adresse,:tel,:password,:date_crea,:role)";
		$db = config::getConnexion();
		try
		{
        $req=$db->prepare($sql);

        //$id=$client->getid();
        $nom=$client->getnom();
        $prenom=$client->getprenom();
        $email=$client->getemail();
        $username=$client->getusername();
        $adresse=$client->getadresse();
        $tel=$client->gettel();
        $password=$client->getpassword();
        $date_crea=$client->getdate_crea();
        $role=$client->getrole();

		//$req->bindValue(':id',$id);
		$req->bindValue(':nom',$nom);
		$req->bindValue(':prenom',$prenom);
		$req->bindValue(':email',$email);
		$req->bindValue(':username',$username);
		$req->bindValue(':adresse',$adresse);
		$req->bindValue(':tel',$tel);
		$req->bindValue(':password',$password);
		$req->bindValue(':date_crea',$date_crea);
		$req->bindValue(':role',$role);




            $req->execute();

        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }

	}

		function afficherclient()
	{
		//$sql="SElECT * From client inner join formationphp.client a on e.id= a.id";
		$sql="SElECT * From user";
		$db = config::getConnexion();
		try
		{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }
	}
	function supprimerclient($id)
	{
		$sql="DELETE FROM user where id= :id";
		$db = config::getConnexion();
        $req=$db->prepare($sql);
		$req->bindValue(':id',$id);
		try{
            $req->execute();
           // header('Location: index.php');
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}

function modifierclient($id,$nom,$prenom,$username,$adresse,$tel,$email,$password)
	{
		$db = config::getConnexion();
		$sql="UPDATE user SET nom='".$nom."',email='".$email."',username='".$username."',adresse='".$adresse."',tel='".$tel."',password='".$password."',prenom='".$prenom."'  where id=".$id.";";
		// (,,'".$username."','".$adresse."','".$tel."','".$password."','".$nom."')where id=".$id.0;

		try
		{
        $req=$db->prepare($sql);

            $req->execute();

        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }

	}
  function trier(){
		$sql="SELECT * from user order by date_crea desc";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}
  function getAllclients($keywords){
		$sql="SELECT * FROM user WHERE CONCAT(`id`,`nom`,`prenom`,`email`,`username`,`adresse`,`tel`,`password`,`date_crea`,`role`) LIKE '%".$keywords."%'";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }


}
?>
