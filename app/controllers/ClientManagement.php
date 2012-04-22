<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class ClientManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("ClientManagement",$this);
		$core->secureController("ClientManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les clients");

		$finder=new Client();

		$list=$finder->getList($core);

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
