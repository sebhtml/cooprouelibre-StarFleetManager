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




}

?>
