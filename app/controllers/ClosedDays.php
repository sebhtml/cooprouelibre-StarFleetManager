<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class ClosedDays extends Controller{

	public function registerController($core){
		$core->registerControllerName("ClosedDays",$this);
		$core->secureController("ClosedDays");
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=ClosedDay::findWithIdentifier($core,"ClosedDay",$identifier);

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();
		
		$id=$item->getAttributeValue("id");
		$name=$item->getAttributeValue("name");

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add($core){

		$core->setPageTitle("Ajouter un jour fermé");

		$place=Place::findWithIdentifier($core,"Place",$_GET['placeIdentifier']);
		$currentUser=User::findWithIdentifier($core,"User",$_SESSION['id']);


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un jour fermé");

		ClosedDay::insertRow($core,"ClosedDay",$_POST);

		include($this->getView(__CLASS__,__METHOD__));
	}



};

?>
