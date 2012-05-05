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

/*
- are located at the place
- have no repairs to do
- are not loaned
*/
	public function getAvailableBikes(){

		$core=$this->m_core;

		$tableMember=$core->getTablePrefix()."Member";
		$tableLoan=$core->getTablePrefix()."Loan";
		$tableBike=$core->getTablePrefix()."Bike";
		$tableRepair=$core->getTablePrefix()."Repair";

		$query= "select * from $tableBike where  not exists (select * from $tableLoan where bikeIdentifier=$tableBike.id and startingDate = actualEndingDate ) 
and not exists ( select * from $tableRepair  where bikeIdentifier= $tableBike.id and creationDate = completionDate ) ; ";
		
		$list=$core->getConnection()->query($query)->getRows();

		return Bike::makeObjectsFromRows($core,$list,"Bike");

	}

/* compute the return date and time
 */
	public function getSchedule($date){
		$core=$this->m_core;

		
		$tableSchedule=$core->getTablePrefix()."Schedule";

		$placeIdentifier=$this->getId();

		$query=" select * from $tableSchedule where placeIdentifier=$placeIdentifier and startingDate <= '$date' and '$date' <= endingDate limit 1 ; ";

		$schedule=Schedule::findOneWithQuery($core,$query,"Schedule");

		return $schedule;
	}
}

?>
