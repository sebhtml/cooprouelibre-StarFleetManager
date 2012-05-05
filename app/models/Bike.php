<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Bike extends Model{

	public function getFieldNames(){
		$names=array();
		$names["bikeIdentifier"]="Numéro de vélo";
		$names["vendorName"]="Manufacturier";
		$names["modelName"]="Modèle";
		$names["serialNumber"]="Numéro de série";
		$names["acquisitionDate"]="Date d'acquisition";
		
		
		return $names;
	}

	public function getName(){
		return "(".$this->getAttributeValue("bikeIdentifier").") ".$this->getAttributeValue("vendorName")." ".$this->getAttributeValue("modelName");
	}
}

?>
