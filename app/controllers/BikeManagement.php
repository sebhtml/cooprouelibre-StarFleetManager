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

		$core->setPageTitle("Voir les vélos");

		$list=Bike::findAll($core,"Bike");

		include($this->getView(__CLASS__,__METHOD__));
	}


	public function call_add($core){

		$core->setPageTitle("Ajouter un vélo");


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un vélo");

		$finder=new Bike();

		$finder->insertRow($core,"Bike",$core->getPostData());
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Bike::findWithIdentifier($core,"Bike",$identifier);

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();
		
		include($this->getView(__CLASS__,__METHOD__));
	}

};

?>
