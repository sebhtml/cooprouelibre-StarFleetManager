<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class LoanManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("LoanManagement",$this);
		$core->secureController("LoanManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les prêts");

		$finder=new Loan();

		$list=$finder->getList($core);

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
