<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Repair extends Model{

	public function isSelectField($field){
		if($field=="bikeIdentifier"){
			return true;
		}

		return false;
	}

	public function getSelectOptions($core,$field){
		
		if($field=="bikeIdentifier"){
		
			$items=Bike::findAll($core,"Bike");

			$output=array();
	
			foreach($items as $i){
				$key=$i->getAttributeValue("id");
				$value=$i->getName();

				$output[$key]=$value;
			}
	
			return $output;
		}

		return array();
	}

	public function isFilledField($field){

		if($field=="creationTime" || $field == "userIdentifier" || $field=="repairIsCompleted" || $field=="completionTime"){
			return true;
		}

		return false;
	}

	public function getFilledValue($core,$field){
		if($field=="creationTime"){
			$time=$core->getCurrentTime();

			return array($time,$time);

		}elseif($field=="userIdentifier"){
			

			$username=$_SESSION["username"];

			$user=User::findWithUsername($core,$username);
	
			return array($user->getAttributeValue("id"),$user->getName());
		}else if($field=="repairIsCompleted"){
			return array(0,"non");
		}else if($field=="completionTime"){
			return array(0,"à venir");

		}
		return "NULL";
	}

	public function getFieldNames(){
		$names=array();
		$names["bikeIdentifier"]="Vélo";
		$names["creationTime"]="Date et heure";
		$names["description"]="Description";
		$names["userIdentifier"]="Auteur";
		$names["repairIsCompleted"]="Complétée";
		$names["completionTime"]="Date et heure de complétion";
		
		
		return $names;
	}

	public function getName(){
		return $this->getAttribute("description");
	}
}

?>
