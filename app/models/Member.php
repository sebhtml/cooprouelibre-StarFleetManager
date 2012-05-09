<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Member extends Model{

	public function getFieldNames(){
		$names=array();
		$names["id"]="Numéro de membre pour le prêt";
		$names["memberIdentifier"]="Numéro de membre à la coopérative (facultatif)";
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
		return $this->getAttributeValue("firstName")." ".$this->getAttributeValue("lastName")." (#".$this->getId().")";
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

	public static function getMembersThatCanLoanABikeWithKeywords($core,$words){
		if(count($words)==0){
			return array();
		}

		$tableMember=$core->getTablePrefix()."Member";
		$tableLoan=$core->getTablePrefix()."Loan";

		$fields=array("firstname","lastname");

		$keyWordQuery=" and ( ";

		$first=true;
		foreach($fields as $field){
			foreach($words as $word1){

				$word=$core->getConnection()->escapeString($word1);

				if($first){
					$first=false;

				}else{
					$keyWordQuery.=" or ";
				}

				$keyWordQuery.=" $field like '%$word%' ";
			}
		}

		$keyWordQuery.=" ) ; ";

		$query="select * from $tableMember where not exists (select * from $tableLoan where memberIdentifier=$tableMember.id and startingDate = actualEndingDate ) $keyWordQuery  ; ";

		//echo $query;

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

		return "<a href=\"?controller=UserManagement&action=view&id=$id\">{$object->getName()}</a>";
	}

	public function mustSkipAttribute($name){

		return false;
	}



}

?>
