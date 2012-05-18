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

	public function getClosedDays(){

		return ClosedDay::getObjectsInRelation($this->m_core,"ClosedDay","placeIdentifier",$this->getId());
	}

	public function getLoans(){

		return Loan::getObjectsInRelation($this->m_core,"Loan","placeIdentifier",$this->getId());
	}

	public function isFilledField($core,$field){
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
		$tableBikePlace=$core->getTablePrefix()."BikePlace";

		$placeIdentifier=$this->getId();

		$query= "select * from $tableBike where 
			 not exists (select * from $tableLoan where bikeIdentifier=$tableBike.id and startingDate = actualEndingDate ) 

			and not exists ( select * from $tableRepair  where bikeIdentifier= $tableBike.id and creationDate = completionDate )

			 and  $placeIdentifier in 
				(select placeIdentifier from $tableBikePlace where bikeIdentifier = $tableBike.id 
					and startingDate = (select max(startingDate) from $tableBikePlace where bikeIdentifier = $tableBike.id ) ) ; ";
		
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

	public function isClosedDay($date){
		$core=$this->m_core;
		$table=$core->getTablePrefix()."ClosedDay";
		$placeIdentifier=$this->getId();
		$query=" select * from $table where placeIdentifier=$placeIdentifier  and dayOfYear='$date' limit 1 ; ";

		$item=ClosedDay::findOneWithQuery($core,$query,"ClosedDay");

		return $item!=NULL;
	}

	public function getOtherPlaces(){
		$core=$this->m_core;
		$table=$core->getTablePrefix()."Place";
		$placeIdentifier=$this->getId();
		$query=" select * from $table where id != $placeIdentifier ;";

		return Place::findAllWithQuery($core,$query,"Place");
	}


	public function findAllReturnedLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$query= "select * from $table where actualEndingDate > expectedEndingDate and actualEndingDate != startingDate  and placeIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllReturnedNotLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$query= "select * from $table where actualEndingDate <= expectedEndingDate  and actualEndingDate != startingDate  and placeIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllActiveNotLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$now=$core->getCurrentTime();

		$query= "select * from $table where '$now' <= expectedEndingDate  and actualEndingDate = startingDate  and placeIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllActiveLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$now=$core->getCurrentTime();

		$query= "select * from $table where '$now' > expectedEndingDate   and actualEndingDate = startingDate  and placeIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}


	public function getBikes(){

		$core=$this->m_core;

		$tableMember=$core->getTablePrefix()."Member";
		$tableLoan=$core->getTablePrefix()."Loan";
		$tableBike=$core->getTablePrefix()."Bike";
		$tableRepair=$core->getTablePrefix()."Repair";
		$tableBikePlace=$core->getTablePrefix()."BikePlace";

		$placeIdentifier=$this->getId();

		$query= "select * from $tableBike where 

			 $placeIdentifier in 
				(select placeIdentifier from $tableBikePlace where bikeIdentifier = $tableBike.id 
					and startingDate = (select max(startingDate) from $tableBikePlace where bikeIdentifier = $tableBike.id ) ) ; ";
		
		$list=$core->getConnection()->query($query)->getRows();

		return Bike::makeObjectsFromRows($core,$list,"Bike");

	}

	public function isLinkedAttribute($name){
		if($name=="userIdentifier"){
			return true;
		}else{
			return false;
		}
	}

	public function getAttributeLink($name){
		$id=$this->getAttribute($name);
		$object=User::findOne($this->m_core,"User",$id);

		return $object->getLink();
	}

	public function isManager($user){
		return $this->hasRight($user,RIGHT_MANAGER);
	}

	public function isMechanic($user){
		return $this->hasRight($user,RIGHT_MECHANIC);
	}

	public function isViewer($user){
		return $this->hasRight($user,RIGHT_VIEWER);
	}

	public function isLoaner($user){
		return $this->hasRight($user,RIGHT_LOAN_OPERATOR);
	}


	private function hasRight($user,$right){

		$table=$this->m_core->getTablePrefix()."Right";
		$query= "select * from $table where userIdentifier = {$user->getId()} and placeIdentifier= {$this->getId()} and rightNumber= $right ; ";

		//echo $query;
		
		$list=Right::findAllWithQuery($this->m_core,$query,"Right");

		return count($list)!=0;

	}
}

?>
