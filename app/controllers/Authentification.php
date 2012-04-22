<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Authentification extends Controller{

	public function call_login($core){

		$person=new Person();
		//$users=$person->getList($core);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_logout($core){

		unset($_SESSION["username"]);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_loginCheck($core){
		$getData=$core->getGETObject();
		$postData=$core->getPOSTObject();

		$username=$core->getKey($postData,"username");
		$password=$core->getKey($postData,"password");

		$person=new Person();
		$connectedPerson=$person->findPerson($core,$username,$password);

		$connected=false;

		if($connectedPerson!=NULL){
			$connected=true;

			//echo "Setting username<br />";
			$_SESSION["username"]=$username;

		}

	
		include($this->getView(__CLASS__,__METHOD__));
	}
}

?>
