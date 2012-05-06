<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class BikePlaceManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("BikePlaceManagement",$this);
		$core->secureController("BikePlaceManagement");
	}

	public function call_add($core){

		$core->setPageTitle("Déplacer un vélo");

		$bike=Bike::findWithIdentifier($core,"Bike",$_GET['bikeIdentifier']);
		$user=User::findWithIdentifier($core,"User",$_SESSION['id']);
		$date=$core->getCurrentDate();

		$places=Place::findAll($core,"Place");

		$now=$core->getCurrentTime();

		$place=$bike->getCurrentPlace();

		if($place!=NULL){

			$places=$place->getOtherPlaces();
		}

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un déplacement de vélo");

		BikePlace::insertRow($core,"BikePlace",$_POST);

		include($this->getView(__CLASS__,__METHOD__));
	}



};

?>
