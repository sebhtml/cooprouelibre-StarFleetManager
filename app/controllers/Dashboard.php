<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Dashboard extends Controller{
	public function registerController($core){
		$core->registerControllerName("Dashboard",$this);
		$core->secureController("Dashboard");
	}

	public function call_view($core){

		$core->setPageTitle("Tableau de bord");

		if($core->debugMode()){
			echo "Calling call_view";
		}

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
