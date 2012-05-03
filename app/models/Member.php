<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
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
		return "(".$this->getAttributeValue("memberIdentifier").") ".$this->getAttributeValue("firstName")." ".$this->getAttributeValue("lastName");
	}
}

?>
