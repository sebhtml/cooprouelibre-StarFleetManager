<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Client extends Model{


	public function getList($core){
		$list=$core->getConnection()->query("select * from {$core->getTablePrefix()}Client ")->getRows();

		$a=array();
		foreach($list as $i){
			$object=new Client();
			$object->setAttributes($i);
			array_push($a,$object);
		}

		return $a;
	}

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

	public function getSelectOptions($field){
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
