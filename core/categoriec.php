<?PHP
include "configg.php";
class categoriec {

	function ajoutercat($categorie){
		$sql="insert into categorie (id,nom) values (:id,:nom)"; //AJOUT DANS BASE
		$db = config::getConnexion();
		try{

        $req=$db->prepare($sql);

		$id=$categorie->getid();
        $nom=$categorie->getnom();
        
      
		$req->bindValue(':id',$id);
		$req->bindValue(':nom',$nom);

		
            $req->execute();
           
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }
		
	}



function affichercategorie(){
		//$sql="SElECT * From employe e inner join formationphp.employe a on e.cin= a.cin";
		$sql="SElECT * From categorie";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}




function supprimercategorie($id){
		$sql="DELETE FROM categorie where id= :id";
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
	function modifiercategorie($categorie,$id){
		$sql="UPDATE produit SET id=:idd, nom=:nom WHERE id=:id";
		
		$db = config::getConnexion();
		//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
try{		
        $req=$db->prepare($sql);
		$idd=$categorie->getid();
        $nom=$categorie->getnom();
        
		$datas = array(':idd'=>$idd, ':id'=>$id, ':nom'=>$nom);
		$req->bindValue(':idd',$idd);
		$req->bindValue(':id',$id);
	
		
		
            $s=$req->execute();
			
           // header('Location: index.php');
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
   echo " Les datas : " ;
  print_r($datas);
        }
		
	}
	function recuperercategorie($id){
		$sql="SELECT * from categorie where id=$id";
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