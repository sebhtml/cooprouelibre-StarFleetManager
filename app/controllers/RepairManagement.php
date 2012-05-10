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


		$bikes=Bike::findAll($core,"Bike");

		if(array_key_exists("bikeIdentifier",$_GET)){

			$item=Bike::findWithIdentifier($core,"Bike",$_GET["bikeIdentifier"]);

			$core->setPageTitle("Voir les réparations pour le vélo ".$item->getName());

			$listToDo=$item->findAllRepairsToDo($core);
			$listDone=$item->findAllRepairsDone($core);
		}else{

			$core->setPageTitle("Voir toutes les réparations");

			$listToDo=Repair::findAllRepairsToDo($core);
			$listDone=Repair::findAllRepairsDone($core);
		}

		$user=User::findOne($core,"User",$_SESSION['id']);

		$isMechanic=$user->isMechanic();

		include($this->getView(__CLASS__,__METHOD__));
	}


	public function call_add($core){

		$core->setPageTitle("Ajouter une réparation");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$bikes=$user->getAvailableBikesForRepair();

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder une réparation");

		$_POST['completionDate']=$_POST['creationDate'];
		$_POST['completionUserIdentifier']=$_POST['userIdentifier'];

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

		$user=User::findOne($core,"User",$_SESSION['id']);

		$item->complete($date,$user);
		$item=Repair::findWithIdentifier($core,"Repair",$identifier);

		$core->setPageTitle("Réparation complétée.");
		$columnNames=$item->getFieldNames();
		
		$currentTime=$core->getCurrentTime();

		include($this->getView(__CLASS__,__METHOD__));

	}


};

?>
