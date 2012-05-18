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

		if(array_key_exists("placeIdentifier",$_GET)){
			
			$item=Place::findWithIdentifier($core,"Place",$_GET["placeIdentifier"]);

			$core->setPageTitle("Voir les vélos au point de service ".$item->getName());

			$list=$item->getBikes();
		}else{

			$core->setPageTitle("Voir tous les vélos");
			$list=Bike::findAll($core,"Bike");

		}

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isAdministrator=$user->isAdministrator();
		$isManager=$user->isManager();

		include($this->getView(__CLASS__,__METHOD__));
	}


	public function call_add($core){

		$core->setPageTitle("Ajouter un vélo");


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un vélo");

		Bike::insertRow($core,"Bike",$core->getPostData());
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Bike::findWithIdentifier($core,"Bike",$identifier);

		$core->setPageTitle($item->getName());
		
		$places=$item->getBikePlaces();

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isAdministrator=$user->isAdministrator();
		$isManager=$user->isManager();
		$isMechanic=$user->isMechanic();
		$isLoaner=$user->isLoaner();

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_edit($core){
		$identifier=$_GET["id"];

		$item=Bike::findOne($core,"Bike",$identifier);

		$core->setPageTitle("Éditer un vélo");
		
		$user=User::findOne($core,"User",$_SESSION['id']);
		$isManager=$user->isManager();

		if(!$isManager){
			return;
		}

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_editSave($core){


		$core->setPageTitle("Éditer un vélo");
		
		$user=User::findOne($core,"User",$_SESSION['id']);
		$isManager=$user->isManager();

		if(!$isManager){
			return;
		}

		Bike::updateRow($core,"Bike",$_POST,$_POST['id']);

		include($this->getView(__CLASS__,__METHOD__));
	}


};

?>
