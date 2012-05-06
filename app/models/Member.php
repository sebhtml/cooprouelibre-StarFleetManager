<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Member extends Model{

	public function getFieldNames(){
		$names=array();
		$names["memberIdentifier"]="Numéro de membre";
		$names["firstName"]="Prénom";
		$names["lastName"]="Nom de famille";
		$names["dateOfBirth"]="Date de naissance (aaaa-mm-jj)";
		$names["sex"]="Sexe";
		$names["physicalAddress"]="Adresse";
		$names["phoneNumber"]="Téléphone";
		$names["email"]="Courriel";
		$names["userIdentifier"]="Créateur";
		
		return $names;
	}

	public function isSelectField($field){
		return $field=="sex";
	}

	public function getSelectOptions($core,$field){

		//echo "Member.getSelectOptions $field";

		if($field=="sex"){
			return array('F' => 'Femme','M' => 'Homme');
		}

		return array();
	}

	public function getName(){
		return $this->getAttributeValue("firstName")." ".$this->getAttributeValue("lastName")." (#".$this->getAttributeValue("memberIdentifier").")";
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
- account not locked
- no actual loan
*/

	public static function getMembersThatCanLoanABike($core){
		$tableMember=$core->getTablePrefix()."Member";
		$tableLoan=$core->getTablePrefix()."Loan";

		$query="select * from $tableMember where not exists (select * from $tableLoan where memberIdentifier=$tableMember.id and startingDate = actualEndingDate ) ; ";

		$list=$core->getConnection()->query($query)->getRows();
		
		return Member::makeObjectsFromRows($core,$list,"Member");

	}


	public function findAllReturnedLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$query= "select * from $table where actualEndingDate > expectedEndingDate and actualEndingDate != startingDate  and memberIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllReturnedNotLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$query= "select * from $table where actualEndingDate <= expectedEndingDate  and actualEndingDate != startingDate  and memberIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllActiveNotLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$now=$core->getCurrentTime();

		$query= "select * from $table where '$now' <= expectedEndingDate  and actualEndingDate = startingDate  and memberIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllActiveLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$now=$core->getCurrentTime();

		$query= "select * from $table where '$now' > expectedEndingDate   and actualEndingDate = startingDate  and memberIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}



}

?>
