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

		if($field=="creationDate" || $field == "userIdentifier"  || $field=="completionDate"){
			return true;
		}

		return false;
	}

	public function getFilledValue($core,$field){
		if($field=="creationDate"){
			$time=$core->getCurrentTime();
			return array($time,$time);

		}elseif($field=="userIdentifier"){
			

			$username=$_SESSION["username"];

			$user=User::findWithUsername($core,$username);
	
			return array($user->getAttributeValue("id"),$user->getName());

		}else if($field=="completionDate"){
			return array(0,"-");

		}
		return "NULL";
	}

	public function getFieldNames(){
		$names=array();
		$names["bikeIdentifier"]="Vélo";
		$names["creationDate"]="Date et heure de création";
		$names["description"]="Description";
		$names["userIdentifier"]="Auteur";
		$names["repairIsCompleted"]="Complétée";
		$names["completionDate"]="Date et heure de complétion";
		
		
		return $names;
	}

	public function getName(){
		return $this->getAttribute("description");
	}


	public static function findAllRepairsToDo($core){

		$table=$core->getTablePrefix()."Repair";

		$query= "select * from $table where creationDate = completionDate;";
		
		return Repair::findAllWithQuery($core,$query,"Repair");
	}

	public static function findAllRepairsDone($core){

		$table=$core->getTablePrefix()."Repair";

		$query= "select * from $table where creationDate != completionDate ;";
		
		return Repair::findAllWithQuery($core,$query,"Repair");
	}

	public function isActive(){
	
		return $this->getAttribute("creationDate") == $this->getAttribute("completionDate");
	}

	public function complete($date){
		$core=$this->m_core;
		$table=$core->getTablePrefix()."Repair";
		$id=$this->getId();

		$query=" update $table set completionDate = '$date' where id = $id and  completionDate = creationDate ; ";

		$core->getConnection()->query($query);
	}

}

?>
