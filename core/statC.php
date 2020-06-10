<?php 
include "../configg.php";
/**
 * 
 */
class statC
{

	function Abest_customer(){

		$sql="SELECT DISTINCT * FROM best_customer ORDER BY money_spent DESC";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}

	function Abest_categorie(){
		$sql="SELECT DISTINCT * FROM best_categorie ORDER BY total_sold DESC";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}

	function Abest_product(){
		$sql="SELECT DISTINCT * FROM best_product ORDER BY quantity_sold DESC";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}

	function total_gain(){
		$sql="SELECT SUM(price)  FROM sales";
		$db = config::getConnexion();
		try{
		$total_gain=$db->prepare($sql);
		$total_gain->execute();
		return $total_gain;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}

	function A(){

		$sql1="INSERT INTO best_product(
    id_product,
    NAME,
    quantity_sold,
    price_sold,
    sales
)
SELECT DISTINCT 
    produit.id,
    produit.nom,
    (
    SELECT
        SUM(panier.quantity)
    FROM
        panier
    WHERE
        produit.id = panier.pid
),
produit.prix,
(
    SELECT
        SUM(panier.totalAmount)
    FROM
        panier
    WHERE
        produit.id = panier.pid
) 
FROM
    produit
INNER JOIN panier WHERE produit.id = panier.pid";


$db = config::getConnexion();
	try {
		$A=$db->prepare($sql1);
		$A->execute();

	} catch (Exception $e) {
		die('Erreur: '.$e->getMessage());
	}
	
}

function B(){

		$sql2="INSERT INTO best_customer(
    id_customer,
    first_name,
    last_name,
    email,
    money_spent
)
SELECT DISTINCT 
    user.id,
    user.prenom,
    user.nom,
    user.email,
    (
        SELECT
            SUM(panier.totalAmount)
        FROM
            panier
        WHERE
            user.id = panier.cid
    )
FROM
    user
INNER JOIN panier WHERE user.id = panier.cid";


$db = config::getConnexion();
$customer=$db->query("SELECT id_customer FROM best_customer");
$sales=$db->query("SELECT cid FROM panier");
     
     foreach ($customer as $row1) {
	foreach ($sales as $row2) {
		if ($row1['id_customer'] == $row2['cid']) {
			$n=1;			
		}
		else
			$n=0;
	}}
	
 if ($n!=1) {
 	try {
		$B=$db->prepare($sql2);
		$B->execute();

	} catch (Exception $e) {
		die('Erreur: '.$e->getMessage());
	}
 }	
}


function C(){

		$sql2="INSERT INTO best_categorie(
    id_categorie,
    name,
    total_sold
)
SELECT DISTINCT 
    categorie.id,
    categorie.nom,
    (
        SELECT
            SUM(sales.quantity)
        FROM
            sales
        WHERE
            categorie.id_categorie = sales.id_categorie
    )
FROM
    categorie
INNER JOIN sales WHERE categorie.id_categorie = sales.id_categorie";


$db = config::getConnexion();
$categorie=$db->query("SELECT id_categorie FROM best_categorie");
$sales=$db->query("SELECT id_categorie FROM sales");
     
     foreach ($categorie as $row1) {
	foreach ($sales as $row2) {
		if ($row1['id_categorie'] == $row2['id_categorie']) {
			$n=1;			
		}
		else
			$n=0;
	}}
	
 if ($n!=1) {
 	try {
		$C=$db->prepare($sql2);
		$C->execute();

	} catch (Exception $e) {
		die('Erreur: '.$e->getMessage());
	}
 }	
}


}
 ?>