<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Bike extends Model{

	public function isSelectField($core,$field){
		return $field=="bikeSex" || $field=="bikeSize";
	}

	public function getSelectOptions($core,$field){

		//echo "Member.getSelectOptions $field";

		if($field=="bikeSex"){
			return array('F' => 'Femme','M' => 'Homme');
		}

		if($field=="bikeSize"){
			return array(
					0 => 'petit',
					1 => 'moyen',
					2 => 'grand',
			
				);
		}

		return array();
	}

	public function getSex(){
		if($this->getAttribute("bikeSex")=='F'){
			return "Femme";
		}else{
			return "Homme";
		}
	}

	public function getFieldNames(){
		$names=array();
		$names["bikeIdentifier"]="Numéro de vélo";
		$names["vendorName"]="Manufacturier";
		$names["modelName"]="Modèle";
		$names["bikeSex"]="Sexe";
		$names["serialNumber"]="Numéro de série";
		$names["acquisitionDate"]="Date d'acquisition (aaaa-mm-jj)";
		
		$names["userIdentifier"]="Créateur";
		$names["bikeSize"]="Grandeur";
		
		return $names;
	}

	public function getSize(){
		$values= array(
					0 => 'petit',
					1 => 'moyen',
					2 => 'grand',
				);

		return $values[$this->getAttribute("bikeSize")];
	}

	public function getName(){
		return "vélo #".$this->getAttribute("bikeIdentifier")." (".$this->getSex().", ".$this->getSize().")";
		//return $this->getAttributeValue("vendorName")." ".$this->getAttributeValue("modelName").;
	}

	public function isFilledField($core,$field){
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

		return BikePlace::getObjectsInRelation($this->m_core,"BikePlace","bikeIdentifier",$this->getId());
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
		if($name=="userIdentifier" || $name=="bikeSex" || $name=="bikeSize"){
			return true;
		}else{
			return false;
		}
	}


	public function getAttributeLink($field){
		if($field=="userIdentifier"){
			$id=$this->getAttribute($field);
			$object=User::findOne($this->m_core,"User",$id);

			return $object->getLink();
		}elseif($field=="bikeSex"){
			return $this->getSex();
		}elseif($field=="bikeSize"){
			return $this->getSize();
		}
	}

	public function isLoaned(){
		$core=$this->m_core;
		$table=$core->getTablePrefix()."Loan";

		$id=$this->getId();

		// get active loans

		$query=" select * from $table where bikeIdentifier = $id and actualEndingDate = startingDate limit 1 ;";

		$item=Loan::findOneWithQuery($core,$query,"Loan");

		return $item!=NULL;
	}

	public function hasRepairs(){
		$items=$this->findAllRepairsToDo($this->m_core);

		return count($items)!=0;
	}

	public function isAvailable(){
		return !$this->isLoaned() && !$this->hasRepairs();
	}

	public function getLoans(){

		return Loan::getObjectsInRelation($this->m_core,"Loan","bikeIdentifier",$this->getId());
	}


}

?>
