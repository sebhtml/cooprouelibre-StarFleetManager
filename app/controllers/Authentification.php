<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Authentification extends Controller{

	public function registerController($core){
		$core->registerControllerName("Authentification",$this);
		//$core->secureController("Authentification");
	}

	public function call_login($core){

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_logout($core){

		unset($_SESSION["username"]);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_loginCheck($core){

		$username=$core->getKey($core->getPostData(),"username");
		$password=$core->getKey($core->getPostData(),"password");

		$person=new User();
		$connectedPerson=$person->findPerson($core,$username,$password);

		$connected=false;

		if($connectedPerson!=NULL){
			$connected=true;

			//echo "Setting username<br />";
			$_SESSION["username"]=$username;

			//$core->callController("Dashboard","view");
		//}else{
		}
		
		include($this->getView(__CLASS__,__METHOD__));
	}
}

?>
