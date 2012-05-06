<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class BikePlace extends Model{

	public function getName(){

		$user=User::findOne($this->m_core,"User",$this->getAttribute("userIdentifier"));
		$place=Place::findOne($this->m_core,"Place",$this->getAttribute("placeIdentifier"));

		return $this->getAttribute("startingDate")." ".$place->getName();
	}
}

?>
