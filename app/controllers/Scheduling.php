<?php
// Author: Sébastien Boisvert
// Place: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Scheduling extends Controller{

	public function registerController($core){
		$core->registerControllerName("Scheduling",$this);
		$core->secureController("Scheduling");
	}

	public function call_add($core){

		$core->setPageTitle("Ajouter une période d'horaire");


		$placeIdentifier=$_GET['placeIdentifier'];

		$item=Place::findWithIdentifier($core,"Place",$placeIdentifier);

		$placeName=$item->getAttributeValue("name");

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un période d'horaire");

		$item=Schedule::add($core,$_POST['placeIdentifier'],$_POST['startingDate'],$_POST['endingDate']);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Schedule::findWithIdentifier($core,"Schedule",$identifier);

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();
		
		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
