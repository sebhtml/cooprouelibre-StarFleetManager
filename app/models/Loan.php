<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Loan extends Model{

	public function getName(){

		$member=Member::findWithIdentifier($this->m_core,"Member",$this->getAttribute("memberIdentifier"));

		return $member->getAttribute("firstName")." ".$member->getAttribute("lastName")." ".$this->getAttribute("startingDate")." ".$this->getAttribute("expectedEndingDate");
	}

	public function getFieldNames(){
	
		$values=array();

		return $values;
	}
}

?>
