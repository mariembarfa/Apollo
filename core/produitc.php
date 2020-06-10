<?PHP
include "configg.php";
class produitc {

	function ajouterproduit($produit){
		$sql="insert into produit (id,nom,prix,quantite,image,id_cat) values (:id,:nom, :prix,:quantite,:image,:id_cat)"; //AJOUT DANS BASE
		$db = config::getConnexion();
		try{

        $req=$db->prepare($sql);

		$id=$produit->getid();
        $nom=$produit->getnom();
        $prix=$produit->getprix();
        $quantite=$produit->getquantite();
        $image=$produit->getimage();
        $id_cat=$produit->getid_cat();
      
		$req->bindValue(':id',$id);
		$req->bindValue(':nom',$nom);
		$req->bindValue(':prix',$prix);
		$req->bindValue(':quantite',$quantite);
		$req->bindValue(':image',$image);
		$req->bindValue(':id_cat',$id_cat);
            $req->execute();
           
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }
		
	}



function afficherproduit(){
		//$sql="SElECT * From employe e inner join formationphp.employe a on e.cin= a.cin";
		$sql="SElECT * From produit";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}




function supprimerproduit($id){
		$sql="DELETE FROM produit where id= :id";
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
	function modifierproduit($produit,$id){
		$sql="UPDATE produit SET id=:idd, nom=:nom,prix=:prix,quantite=:quantite,image=:image WHERE id=:id";
		
		$db = config::getConnexion();
		//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
try{		
        $req=$db->prepare($sql);
		$idd=$produit->getid();
        $nom=$produit->getnom();
        $prix=$produit->getprix();
        $quantite=$produit->getquantite();
        $image=$produit->getimage();
		$datas = array(':idd'=>$idd, ':id'=>$id, ':nom'=>$nom,':prix'=>$prix,':quantite'=>$quantite,':image'=>$image);
		$req->bindValue(':idd',$idd);
		$req->bindValue(':id',$id);
		$req->bindValue(':nom',$nom);
		$req->bindValue(':prix',$prix);
		$req->bindValue(':quantite',$quantite);
		$req->bindValue(':image',$image);
		
		
            $s=$req->execute();
			
           // header('Location: index.php');
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
   echo " Les datas : " ;
  print_r($datas);
        }
		
	}
	function recupererproduit($id){
		$sql="SELECT * from produit where id=$id";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}



 public function rechercherProduits($search)
	{
		$db = config::getConnexion();
		$sql = "SELECT * From produit WHERE MATCH(nomproduit,description) AGAINST(:search IN NATURAL LANGUAGE MODE);";
		
		$req = $db->prepare($sql);
		$req->bindValue(':search',$search);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}


public function triPrix()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM produit ORDER BY prix ASC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
	public function triQuantiteDesc()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM produit ORDER BY quantite DESC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}

    	public function triQuantiteAs()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM produit ORDER BY  ASC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}

		public function triPrixDesc()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM produit ORDER BY prix DESC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}






	 public function triPrixA()
	{
		$db = config::getConnexion();
    	$sql = " SELECT * FROM produit ORDER BY nom ASC";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
 public function triPrixZ()
	{
		$db = config::getConnexion();
    	$sql = " SELECT * FROM produit ORDER BY nom DESC";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}

}






?>