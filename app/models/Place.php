<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Place extends Model{

	public function getFieldNames(){
		$names=array();
		$names["name"]="Nom du point de service";
	
		return $names;
	}
	public function getName(){
		return $this->getAttributeValue("name");
	}

	public function getSchedules(){

		return Schedule::getObjectsInRelation($this->m_core,"Schedule","placeIdentifier",$this->getId());
	}

}

?>
