<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Part extends Model{

	public function getName(){
		return $this->getAttribute("name");
	}

	public function getFieldNames(){
		$names=array();
		
		$names["name"]="Description";
		$names["value"]="Coût";
		
		return $names;
	}

	public static function findAvailableParts($core){

		$tablePart=$core->getTablePrefix()."Part";
		$tablePartTransaction=$core->getTablePrefix()."PartTransaction";

		$query= "select * from $tablePart where exists ( select * from $tablePartTransaction where partIdentifier = $tablePart.id )  and
			( select balance from $tablePartTransaction where partIdentifier = $tablePart.id order by id desc limit 1) >= 1 ;";
		
		return Part::findAllWithQuery($core,$query,"Part");

	}

	public function getBalance(){

		$tablePartTransaction=$this->m_core->getTablePrefix()."PartTransaction";

		$query= "select * from $tablePartTransaction where partIdentifier = {$this->getId()} order by id desc limit 1 ;";

		$balance=0;

		$items=PartTransaction::findAllWithQuery($this->m_core,$query,"PartTransaction");

		if(count($items)==1){
			$balance=$items[0]->getAttribute("balance");
		}

		return $balance;
	}

	public function getPartTransactions(){

		return RepairPart::getObjectsInRelation($this->m_core,"PartTransaction","partIdentifier",$this->getId());

	}

	public function runTransaction($change){

		$balance=$this->getBalance();

		$balance+=$change;

		$data['partIdentifier']=$this->getId();
		$data['transactionDate']=$this->m_core->getCurrentTime();
		$data['partChange']=$change;
		$data['userIdentifier']=$_SESSION['id'];
		$data['balance']=$balance;

		//echo "Running transaction.";

		PartTransaction::insertRow($this->m_core,"PartTransaction",$data);

	}

}

?>
