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

	public function returnBike($date){
		$core=$this->m_core;
		$table=$core->getTablePrefix()."Loan";
		$id=$this->getId();

		$query=" update $table set actualEndingDate = '$date' where id = $id and actualEndingDate = startingDate ;";

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


}

?>
