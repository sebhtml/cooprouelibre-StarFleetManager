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

	public function getScheduledDay($day){
		$core=$this->m_core;
		
		$table=$core->getTablePrefix()."ScheduledDay";

		$id=$this->getId();

		$query=" select * from $table where scheduleIdentifier=$id and dayOfWeek=$day limit 1 ; ";

		$item=ScheduledDay::findOneWithQuery($core,$query,"ScheduledDay");

		return $item;
	}

	public function getPlace(){
		return Place::findOne($this->m_core,"Place",$this->getAttribute("placeIdentifier"));
	}
}

?>
