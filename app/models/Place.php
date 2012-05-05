<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Place extends Model{

	public function getFieldNames(){
		$names=array();
		$names["name"]="Nom du point de service";
		$names["userIdentifier"]="Créateur";
	
		return $names;
	}
	public function getName(){
		return $this->getAttributeValue("name");
	}

	public function getSchedules(){

		return Schedule::getObjectsInRelation($this->m_core,"Schedule","placeIdentifier",$this->getId());
	}

	public function isFilledField($field){
		return $field=="userIdentifier";
	}

	public function getFilledValue($core,$field){

		if($field=="userIdentifier"){
			$user=User::findWithIdentifier($core,"User",$_SESSION['id']);
			return array($user->getId(),$user->getName());
		}
	}
}

?>
