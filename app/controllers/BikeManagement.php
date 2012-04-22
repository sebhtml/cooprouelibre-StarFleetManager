<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class BikeManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("BikeManagement",$this);
		$core->secureController("BikeManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les vélos");

		$finder=new Bike();

		$list=$finder->getList($core);

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
