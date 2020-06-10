<?PHP
include "../config.php";
class livraisonC {
function afficherlivraison ($livraison){
		echo "idclient: ".$livraison->getidclient()."<br>";
		echo "nom: ".$livraison->getNom()."<br>";
		echo "adresse: ".$livraison->getadresse()."<br>";
		echo "numtel: ".$livraison->getnumtel()."<br>";
		echo "numcommande: ".$livraison->getnumcommande()."<br>";
	}
	function ajouterlivraison($livraison){
		$sql="insert into livraison (idclient,nom,adresse,numtel,numcommande) values (:idclient, :nom,:adresse,:numtel,:numcommande)";
		$db = config::getConnexion();
		try{
        $req=$db->prepare($sql);

        $idclient=$livraison->getidclient();
        $nom=$livraison->getNom();
        $adresse=$livraison->getadresse();
        $numtel=$livraison->getnumtel();
		$numcommande=$livraison->getnumcommande();
		$req->bindValue(':idclient',$idclient);
		$req->bindValue(':nom',$nom);
		$req->bindValue(':adresse',$adresse);
		$req->bindValue(':numtel',$numtel);
        $req->bindValue(':numcommande',$numcommande);
            $req->execute();

        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }

	}
	function trilivraisons(){
		//$sql="SElECT * From livraison e inner join formationphp.livraison a on e.idclient= a.idclient";
		$sql="SElECT * From livraison order by idclient";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}
	function afficherlivraisons(){
		//$sql="SElECT * From livraison e inner join formationphp.livraison a on e.idclient= a.idclient";
		$sql="SElECT * From livraison";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}
	function supprimerlivraison($idclient){
		$sql="DELETE FROM livraison where idclient= :idclient";
		$db = config::getConnexion();
        $req=$db->prepare($sql);
		$req->bindValue(':idclient',$idclient);
		try{
            $req->execute();
           // header('Location: index.php');
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}
	function modifierlivraison($livraison,$idclient){
		$sql="UPDATE livraison SET idclient=:idclientn, nom=:nom,adresse=:adresse,numtel=:numtel,numcommande=:numcommande WHERE idclient=:idclient";

		$db = config::getConnexion();
		//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
try{
        $req=$db->prepare($sql);
		$idclientn=$livraison->getidclient();
        $nom=$livraison->getnom();
        $adresse=$livraison->getadresse();
        $numtel=$livraison->getnumtel();
		$numcommande=$livraison->getnumcommande();
		$datas = array(':idclientn'=>$idclientn, ':idclient'=>$idclient, ':nom'=>$nom,':adresse'=>$adresse,':numtel'=>$numtel,':numcommande'=>$numcommande);
		$req->bindValue(':idclientn',$idclientn);
		$req->bindValue(':idclient',$idclient);
		$req->bindValue(':nom',$nom);
		$req->bindValue(':adresse',$adresse);
		$req->bindValue(':numtel',$numtel);
        $req->bindValue(':numcommande',$numcommande);

            $s=$req->execute();

           // header('Location: index.php');
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
   echo " Les datas : " ;
  print_r($datas);
        }

	}
	function recupererlivraison($idclient){
		$sql="SELECT * from livraison where idclient=$idclient";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}

	function rechercherListelivraisons($numtel){
		$sql="SELECT * from livraison where numtel=$numtel";
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
