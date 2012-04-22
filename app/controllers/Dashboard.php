<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Dashboard extends Controller{

	public function call_view($core){

		$core->setPageTitle("Tableau de bord");

		$person=new Person();
	
		$session=$core->getSESSIONObject();
		$user=$person->findWithUsername($core,$session["username"]);

		$isAdministrator=$user->isAdministrator();

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
