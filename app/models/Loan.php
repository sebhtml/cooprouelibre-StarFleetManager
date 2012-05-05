<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Loan extends Model{

	public function getName(){

		$member=Member::findWithIdentifier($this->m_core,"Member",$this->getAttribute("memberIdentifier"));

		return $member->getAttribute("firstName")." ".$member->getAttribute("lastName")." ".$this->getAttribute("startingDate")." ".$this->getAttribute("expectedEndingDate");
	}

	public function getFieldNames(){
	
		$values=array();

		return $values;
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



}

?>
