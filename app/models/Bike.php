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
		return "(".$this->getAttributeValue("bikeIdentifier").") ".$this->getAttributeValue("vendorName")." ".$this->getAttributeValue("modelName");
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


}

?>
