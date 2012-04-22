<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class RepairManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("RepairManagement",$this);
		$core->secureController("RepairManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les réparations");

		$finder=new Repair();

		$list=$finder->getList($core);

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
