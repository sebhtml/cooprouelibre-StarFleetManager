<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Entertainment extends Controller{

	public function registerController($core){
		$core->registerControllerName("Entertainment",$this);
		$core->secureController("Entertainment");
	}

	public function call_viewSchema($core){

		$core->setPageTitle("Entrailles");

		$finder=new Model();

		$list=$finder->getTableList($core);

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
