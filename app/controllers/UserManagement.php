<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class UserManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("UserManagement",$this);
		$core->secureController("UserManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les comptes");

		$finder=new User();

		$list=$finder->getList($core);

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
