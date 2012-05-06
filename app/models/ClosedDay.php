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

}

?>
