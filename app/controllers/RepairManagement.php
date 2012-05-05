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

		$bikes=Bike::findAll($core,"Bike");

		$listToDo=Repair::findAllRepairsToDo($core);
		$listDone=Repair::findAllRepairsDone($core);

		include($this->getView(__CLASS__,__METHOD__));
	}


	public function call_add($core){

		$core->setPageTitle("Ajouter une réparation");

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder une réparation");

		$_POST['completionDate']=$_POST['creationDate'];

		Repair::insertRow($core,"Repair",$_POST);
	
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

	public function call_complete_validate($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Repair::findWithIdentifier($core,"Repair",$identifier);

		$core->setPageTitle("Compléter la réparation");
		$columnNames=$item->getFieldNames();
		
		$currentTime=$core->getCurrentTime();

		include($this->getView(__CLASS__,__METHOD__));

	}

	public function call_complete_save($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Repair::findWithIdentifier($core,"Repair",$identifier);
		$date=$_POST['completionDate'];
		$item->complete($date);
		$item=Repair::findWithIdentifier($core,"Repair",$identifier);

		$core->setPageTitle("Réparation complétée.");
		$columnNames=$item->getFieldNames();
		
		$currentTime=$core->getCurrentTime();

		include($this->getView(__CLASS__,__METHOD__));

	}


};

?>
