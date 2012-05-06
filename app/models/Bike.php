<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Bike extends Model{

	public function getFieldNames(){
		$names=array();
		$names["bikeIdentifier"]="Numéro de vélo";
		$names["vendorName"]="Manufacturier";
		$names["modelName"]="Modèle";
		$names["serialNumber"]="Numéro de série";
		$names["acquisitionDate"]="Date d'acquisition (aaaa-mm-jj)";
		
		$names["userIdentifier"]="Créateur";
		
		return $names;
	}

	public function getName(){
		return $this->getAttributeValue("vendorName")." ".$this->getAttributeValue("modelName")." (#".$this->getAttribute("bikeIdentifier").")";
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

	public function getCurrentPlace(){
		$core=$this->m_core;
		$table=$core->getTablePrefix()."Place";
		$tableBikePlace=$core->getTablePrefix()."BikePlace";

		$id=$this->getId();

		$query=" select * from $table where id = 
			(select placeIdentifier from $tableBikePlace where bikeIdentifier = $id 
				and startingDate = 
					(select max(startingDate) from $tableBikePlace where bikeIdentifier = $id)
			); ";

		$item=Place::findOneWithQuery($core,$query,"Place");

		return $item;
	}


	public function getBikePlaces(){

		return Schedule::getObjectsInRelation($this->m_core,"BikePlace","bikeIdentifier",$this->getId());
	}

	public function canBeMoved(){
		$core=$this->m_core;
		$table=$core->getTablePrefix()."Loan";

		$id=$this->getId();

		// get active loans

		$query=" select * from $table where bikeIdentifier = $id and actualEndingDate = startingDate ;";

		$item=Loan::findOneWithQuery($core,$query,"Loan");

		return $item==NULL;
	}


	public function findAllReturnedLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$query= "select * from $table where actualEndingDate > expectedEndingDate and actualEndingDate != startingDate  and bikeIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllReturnedNotLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$query= "select * from $table where actualEndingDate <= expectedEndingDate  and actualEndingDate != startingDate  and bikeIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllActiveNotLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$now=$core->getCurrentTime();

		$query= "select * from $table where '$now' <= expectedEndingDate  and actualEndingDate = startingDate  and bikeIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}

	public function findAllActiveLateLoans($core){

		$table=$core->getTablePrefix()."Loan";

		$now=$core->getCurrentTime();

		$query= "select * from $table where '$now' > expectedEndingDate   and actualEndingDate = startingDate  and bikeIdentifier = {$this->getId()} ";
		
		return Loan::findAllWithQuery($core,$query,"Loan");
	}


	public function findAllRepairsToDo($core){

		$table=$core->getTablePrefix()."Repair";

		$query= "select * from $table where creationDate = completionDate and bikeIdentifier = {$this->getId()} ;";
		
		return Repair::findAllWithQuery($core,$query,"Repair");
	}

	public function findAllRepairsDone($core){

		$table=$core->getTablePrefix()."Repair";

		$query= "select * from $table where creationDate != completionDate  and bikeIdentifier = {$this->getId()} ;";
		
		return Repair::findAllWithQuery($core,$query,"Repair");
	}


}

?>
