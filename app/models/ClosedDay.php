<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class ClosedDay extends Model{

	public function getFieldNames(){
		$names=array();

		$names["placeIdentifier"]="Point de service";
		$names["dayOfYear"]="Date (aaaa-mm-jj)";
		$names["name"]="Nom";

		return $names;
	}

	public function getName(){
		return $this->getAttribute("dayOfYear")." ".$this->getAttribute("name");
	}

	public function isLinkedAttribute($name){
		if($name=="placeIdentifier" || $name=="userIdentifier"){
			return true;
		}else{
			return false;
		}
	}

	public function getAttributeLink($name){
		if($name=="userIdentifier"){
			$id=$this->getAttribute($name);
			$object=User::findOne($this->m_core,"User",$id);

			return $object->getLink();

		}elseif($name=="placeIdentifier"){
			$id=$this->getAttribute($name);
			$object=Place::findOne($this->m_core,"Place",$id);

			return $object->getLink();
		}


	}


}

?>
