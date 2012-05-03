<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class LoanManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("LoanManagement",$this);
		$core->secureController("LoanManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les prêts");

		$list=Loan::findAll($core,"Loan");

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
