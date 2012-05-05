<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Schedule extends Model{

	public function getName(){
	
		$place=Place::findWithIdentifier($this->m_core,"Place",$this->getAttributeValue("placeIdentifier"));

		return $place->getAttribute("name")." ".$this->getAttribute("startingDate")." à ".$this->getAttribute("endingDate");
	}

	public function getScheduledDays(){

		return ScheduledDay::getObjectsInRelation($this->m_core,"ScheduledDay","scheduleIdentifier",$this->getId());
	}
}

?>
