<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
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
}

?>
