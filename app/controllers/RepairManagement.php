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

		$list=Repair::findAll($core,"Repair");

		include($this->getView(__CLASS__,__METHOD__));
	}


	public function call_add($core){

		$core->setPageTitle("Ajouter une réparation");

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder une réparation");

		Repair::insertRow($core,"Repair",$core->getPostData());
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Repair::findWithIdentifier($core,"Repair",$identifier);

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();
		
		include($this->getView(__CLASS__,__METHOD__));
	}

};

?>
