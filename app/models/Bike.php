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
		$names["bikeSize"]="Grandeur";
		
		return $names;
	}

	public function getName(){
		return "vélo #".$this->getAttribute("bikeIdentifier").", taille ".$this->getAttribute("bikeSize");
		//return $this->getAttributeValue("vendorName")." ".$this->getAttributeValue("modelName").;
	}

	public function isFilledField($field){
		return $field=="userIdentifier"|| $field=="acquisitionDate";
	}

	public function getFilledValue($core,$field){

		if($field=="userIdentifier"){
			$user=User::findWithIdentifier($core,"User",$_SESSION['id']);
			return array($user->getId(),$user->getName());
		}elseif($field=="acquisitionDate"){
			$item=$core->getCurrentDate();
			return array($item,$item);
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

}

?>
