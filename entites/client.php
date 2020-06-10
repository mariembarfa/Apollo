<?PHP
require_once "C:/wamp64/www/crud_livraison/config.php";
class client{
	private $id;
	private $nom;
	private $prenom;
	private $email;
	private $username;
	private $adresse;
	private $tel;
	private $password;
	private $date_crea;
	private $role;
	function __construct($id,$nom,$prenom,$email,$username,$adresse,$tel,$password,$date_crea,$role){
		$this->id=$id;
		$this->nom=$nom;
		$this->prenom=$prenom;
		$this->email=$email;
		$this->username=$username;
		$this->adresse=$adresse;
		$this->tel=$tel;
		$this->password=$password;
		$this->date_crea=$date_crea;
		$this->role=$role;
	}

	function getid(){
		return $this->id;
	}
	function getnom(){
		return $this->nom;
	}
	function getprenom(){
		return $this->prenom;
	}
	function gettype(){
		return $this->email;
	}
	function getusername(){
		return $this->username;
	}
	function getadresse(){
		return $this->adresse;
	}
	function gettel(){
		return $this->tel;
	}
	function getpassword(){
		return $this->password;
	}
	function getdate_crea(){
		return $this->date_crea;
	}
	function getrole(){
		return $this->role;
	}
	function getemail(){
		return $this->email;
	}
	function setid($id){
		$this->id=$id;
	}
	function setnom($nom){
		$this->nom=$nom;
	}
	function setprenom($prenom){
		$this->prenom;
	}
	function setemail($email){
		$this->email=$email;
	}
	function setusername($username){
		$this->username=$username;
	}
	function setadresse($adresse){
		$this->adresse=$adresse;
	}
	function settel($tel){
		$this->tel=$tel;
	}
	function setpassword($password){
		$this->password=$password;
	}
	function setdate_crea($date_crea){
		$this->date_crea=$date_crea;
	}
	function setrole($role){
		$this->role=$role;
	}
	public static function checklogin($username,$password)
	{
		$db = config::getConnexion();
		$req = $db->prepare('SELECT * FROM user WHERE username=:username AND password=:password');
		$req->bindParam(':username',$username);
		$req->bindParam(':password',$password);
		$req->execute();
		$resultat=$req->fetch();
		return $resultat;
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

}


?>
