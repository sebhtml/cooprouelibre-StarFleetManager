<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Part extends Model{

	public function getName(){
		return $this->getAttribute("name");
	}

	public function getFieldNames(){
		$names=array();
		
		$names["name"]="Description";
		$names["value"]="Coût";
		
		return $names;
	}


}

?>
