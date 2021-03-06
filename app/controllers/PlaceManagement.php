<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class PlaceManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("PlaceManagement",$this);
		$core->secureController("PlaceManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les points de service");

		$user=User::findOne($core,"User",$_SESSION['id']);

		$list=$user->getPlaces();

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add($core){

		$core->setPageTitle("Ajouter un point de service");


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un point de service");

		Place::insertRow($core,"Place",$core->getPostData());
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Place::findWithIdentifier($core,"Place",$identifier);

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();
		
		$placeIdentifier=$item->getAttributeValue("id");
		$placeName=$item->getAttributeValue("name");

		$schedules=$item->getSchedules($core);

		$closedDays=$item->getClosedDays($core);

		$user=User::findOne($core,"User",$_SESSION['id']);
		$place=$item;
		$isManager=$place->isManager($user);
		$isLoaner=$place->isLoaner($user);

		include($this->getView(__CLASS__,__METHOD__));
	}

};

?>
