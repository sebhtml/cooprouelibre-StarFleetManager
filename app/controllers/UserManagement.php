<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class UserManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("UserManagement",$this);
		$core->secureController("UserManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les comptes");

		$finder=new User();

		$list=$finder->findAll($core,"User");

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$identifier=$_GET["id"];

		$item=User::findWithIdentifier($core,"User",$identifier);

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();
		
		include($this->getView(__CLASS__,__METHOD__));

	}
};

?>
