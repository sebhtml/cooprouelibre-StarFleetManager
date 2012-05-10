<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class RepairPart extends Model{

	public function getName(){
		$item=$this->getPart();
		return $item->getName();
	}

	public function getPart(){

		$item=Part::findOne($this->m_core,"Part",$this->getAttribute("partIdentifier"));

		return $item;
	}
}

?>
