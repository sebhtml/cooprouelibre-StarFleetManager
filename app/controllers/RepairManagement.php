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
		$hasBike=false;

		if(array_key_exists("bikeIdentifier",$_GET)){

			$item=Bike::findWithIdentifier($core,"Bike",$_GET["bikeIdentifier"]);

			$core->setPageTitle("Voir les réparations pour le vélo ".$item->getName());

			$listToDo=$item->findAllRepairsToDo($core);
			$listDone=$item->findAllRepairsDone($core);
			$hasBike=true;

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
		$_POST['minutes']=0;

		Repair::insertRow($core,"Repair",$_POST);
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Repair::findWithIdentifier($core,"Repair",$identifier);

		$repairParts=$item->getRepairParts();

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();
		
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
		$identifier=$_GET["id"];

		$item=Repair::findOne($core,"Repair",$identifier);

		$data=$item->getAttributes();

		$data['completionDate']=$_POST['completionDate'];
		$data['completionUserIdentifier']=$_SESSION['id'];
		$data['minutes']=$_POST['minutes'];

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		if(!$isMechanic){
			return;
		}

		
		Repair::updateRow($core,"Repair",$data,$_GET['id']);

		$item=Repair::findOne($core,"Repair",$identifier);

		$core->setPageTitle("Réparation complétée.");
		$columnNames=$item->getFieldNames();
		
		$currentTime=$core->getCurrentTime();

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_listTypes($core){

		$core->setPageTitle("Types de réparations");

		$items=RepairType::findAll($core,"RepairType");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_addType($core){

		$core->setPageTitle("Ajouter un type de réparation");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		if(!$isMechanic){
			return;
		}

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_addTypeSave($core){

		$core->setPageTitle("Ajouter un type de réparation");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		if(!$isMechanic){
			return;
		}

		RepairType::insertRow($core,"RepairType",$_POST);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_addPart($core){

		$core->setPageTitle("Ajouter un pièce pour une réparation");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		if(!$isMechanic){
			return;
		}

		$items=Part::findAvailableParts($core);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_addPartSave($core){

		$core->setPageTitle("Ajouter un pièce pour une réparation");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		if(!$isMechanic){
			return;
		}

		$part=Part::findOne($core,"Part",$_POST['partIdentifier']);

		$_POST['repairIdentifier']=$_GET['id'];

		RepairPart::insertRow($core,"RepairPart",$_POST);

		$change=-1;
		$part->runTransaction($change);


		include($this->getView(__CLASS__,__METHOD__));
	}


};

?>
