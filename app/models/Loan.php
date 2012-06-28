<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Loan extends Model{

	public function getName(){

		$member=Member::findWithIdentifier($this->m_core,"Member",$this->getAttribute("memberIdentifier"));
		$place=Place::findWithIdentifier($this->m_core,"Place",$this->getAttribute("placeIdentifier"));
		$bike=Bike::findWithIdentifier($this->m_core,"Bike",$this->getAttribute("bikeIdentifier"));

		return $this->getAttribute("startingDate")." ".$bike->getName()." par ".$member->getAttribute("firstName")." ".$member->getAttribute("lastName")." (".$place->getName().")";
	}


	public static function findAllReturnedLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$query= "select * from $table where actualEndingDate > expectedEndingDate and actualEndingDate != startingDate";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public static function findAllReturnedNotLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$query= "select * from $table where actualEndingDate <= expectedEndingDate  and actualEndingDate != startingDate";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public static function findAllActiveNotLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$now=$core->getCurrentTime();

		$query= "select * from $table where '$now' <= expectedEndingDate  and actualEndingDate = startingDate";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public static function findAllActiveLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$now=$core->getCurrentTime();

		$query= "select * from $table where '$now' > expectedEndingDate   and actualEndingDate = startingDate";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function isActive(){

		return $this->getAttribute("actualEndingDate")==$this->getAttribute("startingDate");
	}

	public function returnBike($date,$user){
		$core=$this->m_core;
		$table=$core->getTablePrefix()."Loan";
		$id=$this->getId();

		$query=" update $table set actualEndingDate = '$date', returnUserIdentifier = {$user->getId()}
			 where id = $id and actualEndingDate = startingDate ;";

		$core->getConnection()->query($query);
	}

	public function getFieldNames(){
		$names=array();
		$names["bikeIdentifier"]="Vélo";
		$names["userIdentifier"]="Opérateur pour le début du prêt";
		$names["memberIdentifier"]="Membre";
		$names["placeIdentifier"]="Point de service";
		$names["startingDate"]="Début du prêt";
		$names["expectedEndingDate"]="Fin prévu du prêt";
		$names["actualEndingDate"]="Fin du prêt";
		$names["returnUserIdentifier"]="Opérateur pour le retour";
	
		return $names;
	}

	public function isLinkedAttribute($name){
		if($name=="userIdentifier" || $name=="bikeIdentifier" || $name=="memberIdentifier" || $name=="placeIdentifier" || $name=="returnUserIdentifier"){
			return true;
		}else{
			return false;
		}
	}


	public function getAttributeLink($name){
		if($name=="userIdentifier" || $name=="returnUserIdentifier"){
			$id=$this->getAttribute($name);
			$object=User::findOne($this->m_core,"User",$id);

			return $object->getLink();

		}elseif($name=="bikeIdentifier"){
			$id=$this->getAttribute($name);
			$object=Bike::findOne($this->m_core,"Bike",$id);
		
			return $object->getLink();

		}elseif($name=="placeIdentifier"){
			$id=$this->getAttribute($name);
			$object=Place::findOne($this->m_core,"Place",$id);

			return $object->getLink();

		}elseif($name=="memberIdentifier"){
			$id=$this->getAttribute($name);
			$object=Member::findOne($this->m_core,"Member",$id);

			return $object->getLink();
		}

	}
	public function getBike(){
		return Bike::findOne($this->m_core,"Bike",$this->getAttribute("bikeIdentifier"));
	}


	public function getMember(){
		return Member::findOne($this->m_core,"Member",$this->getAttribute("memberIdentifier"));
	}


	public function getPlace(){
		return Place::findOne($this->m_core,"Place",$this->getAttribute("placeIdentifier"));
	}

	public function isLate(){
		$planned=strtotime($this->getAttribute("expectedEndingDate"));
		$actual=strtotime($this->getAttribute("actualEndingDate"));

		if($this->getAttribute("actualEndingDate")==$this->getAttribute("startingDate")){
			$actual=time();
		}

		return $actual > $planned;
	}

	public function getLateHours(){
		$planned=strtotime($this->getAttribute("expectedEndingDate"));
		$actual=strtotime($this->getAttribute("actualEndingDate"));

		$difference=$actual-$planned;

		// here, we need to substract the closed hours for the place 
		// between these 2 time points:
		// - expectedEndingDate
		// - actualEndingDate
		
		$place=Place::findOne($this->m_core,"Place",$this->getAttribute("placeIdentifier"));

		$closedSeconds=0;


		$rightNow=strtotime(date("H:i:s",$actual));

		/*

		schedules are defined on a per-day basis

		1. compute the seconds closed on the day for expectedEndingDate after expectedEndingDate

		*/

		$plannedDay=date("Y-m-d",$planned);
		$actualDate=date("Y-m-d",$actual);
		$schedule=$place->getSchedule($plannedDay);

		if($schedule==NULL){
			echo "Error, no schedule for day ".$plannedDay." expectedEndingDate -> ".$planned."<br />";
		}

		$dayOfWeek=date("N",$planned)-1;
		$scheduledDay=$schedule->getScheduledDay($dayOfWeek);
		$closingTime=$scheduledDay->getAttribute("closingTime");

		$upperBound=strtotime("23:59:59");

		// if it closes at 18:00 and the person brings it back at 20:00, only
		// charge 2 late hours

		if($actualDate == $plannedDay && $rightNow < $upperBound){
			$upperBound=$rightNow;
		}

		$value=($upperBound - strtotime($closingTime));
		$closedSeconds+= $value;

		//echo "Closed seconds on day 0:".$value."<br />";

		/*
		2. compute the seconds closed for days after expectedEndingDate but before the day of actualEndingDate
		*/

		$tomorrow=date("Y-m-d",$planned+24*60*60);
		$max=32;
		$iteration=0;

		// this code will be useful for weekends

		while($actualDate != $plannedDay && $tomorrow != $actualDate && $iteration != $max){

			$schedule=$place->getSchedule($tomorrow);
			$dayOfWeek=date("N",strtotime($tomorrow))-1;
			$scheduledDay=$schedule->getScheduledDay($dayOfWeek);
			$openingTime=$scheduledDay->getAttribute("openingTime");
			$closingTime=$scheduledDay->getAttribute("closingTime");

			$value1=(strtotime($openingTime) - strtotime("00:00:00"));
			$value2=(strtotime("23:59:59") - strtotime($closingTime));

			$closedSeconds+= $value1;
			$closedSeconds+= $value2;

			$tomorrow=date("Y-m-d",strtotime($tomorrow)+24*60*60);
	
			$iteration++;
		}

		/*
		3. compute the seconds closed for the day of actualEndingDate before actualEndingDate

		sum these 3 results

		*/

		$schedule=$place->getSchedule($actualDate);
		$dayOfWeek=date("N",$actual)-1;
		$scheduledDay=$schedule->getScheduledDay($dayOfWeek);
		$openingTime=$scheduledDay->getAttribute("openingTime");

		$upperBound=strtotime($openingTime);

		// if the person bring back the bike during the night, don't remove future closed second !
		// this won't happen haha

		if($rightNow < strtotime($openingTime)){
			$upperBound=$rightNow;
		}

		$closedSeconds+= ($upperBound - strtotime("00:00:00"));

		$difference-=$closedSeconds;

		// compute hours

		$hours=$difference/(60*60.0);

		return ceil($hours);
	}


}

?>
