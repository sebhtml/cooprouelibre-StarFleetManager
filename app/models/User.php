<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class User extends Model{

	public static function findPerson($core,$username,$password){

		$md5=md5($password);

		$query="select * from {$core->getTablePrefix()}User where username='$username' and md5Password='$md5' limit 1";
		$rows=$core->getConnection()->query($query)->getRows();

		if(count($rows)==1){
			$person=new User();
			$person->setAttributes($rows[0]);
			return $person;
		}

		return NULL;
	}

	public function isAdministrator(){
		return $this->getAttribute("isAdministrator");
	}


	public static function findWithUsername($core,$username){
		$query="select * from {$core->getTablePrefix()}User where username='$username' limit 1";
		$rows=$core->getConnection()->query($query)->getRows();

		if(count($rows)==1){
			$person=new User();
			$person->setAttributes($rows[0]);
			return $person;
		}

		return NULL;
	}

	public function getName(){
		return $this->getAttributeValue("firstName")." ".$this->getAttributeValue("lastName")." (".$this->getAttributeValue("username").")";
	}

	public function getFieldNames(){
		return array(
			"username" => "Nom d'utilisateur",
			"md5Password" => "Mot de passe",
			"firstName" => "Prénom",
			"email" => "Courriel",
			"lastName" => "Nom de famille",
			"isAdministrator" => "Est un administrateur du système ?"
		);
	}

	public function mustSkipAttribute($name){
		if($name=="id" || $name=="md5Password"){
			return true;
		}else{
			return false;
		}
	}

	public function getRights(){

		return Right::getObjectsInRelation($this->m_core,"Right","userIdentifier",$this->getId());
	}

	public function getPlaces(){

		$tablePlace=$this->m_core->getTablePrefix()."Place";
		$tableRight=$this->m_core->getTablePrefix()."Right";

		$query= "select * from $tablePlace where exists (
				select * from $tableRight where userIdentifier = {$this->getId()} and placeIdentifier = $tablePlace.id ) ;";

		//echo $query;
		
		return Place::findAllWithQuery($this->m_core,$query,"Place");
	}


	public function isMechanic(){

		$right=RIGHT_MECHANIC;
		$table=$this->m_core->getTablePrefix()."Right";

		$query= "select * from $table where userIdentifier = {$this->getId()} and rightNumber= $right ; ";

		$list=Right::findAllWithQuery($this->m_core,$query,"Right");

		return count($list)!=0;

	}

	public function isManager(){

		$right=RIGHT_MANAGER;
		$table=$this->m_core->getTablePrefix()."Right";

		$query= "select * from $table where userIdentifier = {$this->getId()} and rightNumber= $right ; ";

		$list=Right::findAllWithQuery($this->m_core,$query,"Right");

		return count($list)!=0;

	}


	public function isViewer(){

		$right=RIGHT_VIEWER;
		$table=$this->m_core->getTablePrefix()."Right";

		$query= "select * from $table where userIdentifier = {$this->getId()} and rightNumber= $right ; ";

		$list=Right::findAllWithQuery($this->m_core,$query,"Right");

		return count($list)!=0;

	}

	public function isLoaner(){

		$right=RIGHT_LOAN_OPERATOR;
		$table=$this->m_core->getTablePrefix()."Right";

		$query= "select * from $table where userIdentifier = {$this->getId()} and rightNumber= $right ; ";

		$list=Right::findAllWithQuery($this->m_core,$query,"Right");

		return count($list)!=0;

	}

	public function getAvailableBikesForRepair(){

		$core=$this->m_core;

		$tableMember=$core->getTablePrefix()."Member";
		$tableLoan=$core->getTablePrefix()."Loan";
		$tableBike=$core->getTablePrefix()."Bike";
		$tableRepair=$core->getTablePrefix()."Repair";
		$tableBikePlace=$core->getTablePrefix()."BikePlace";
		$tableRight=$this->m_core->getTablePrefix()."Right";

		$userIdentifier=$this->getId();

		$query= "select * from $tableBike where 
			 not exists (select * from $tableLoan where bikeIdentifier=$tableBike.id and startingDate = actualEndingDate ) 

			 and exists ( select * from $tableRight where userIdentifier = $userIdentifier and placeIdentifier  in 
				(select placeIdentifier from $tableBikePlace where bikeIdentifier = $tableBike.id 
					and startingDate = (select max(startingDate) from $tableBikePlace where bikeIdentifier = $tableBike.id ) ) ) ; ";
		
		// echo $query;

		$list=$core->getConnection()->query($query)->getRows();

		return Bike::makeObjectsFromRows($core,$list,"Bike");

	}


}

?>
