<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Loan extends Model{

	public function getList($core){
		$list=$core->getConnection()->query("select * from {$core->getTablePrefix()}Loan")->getRows();

		$a=array();
		foreach($list as $i){
			$object=new Loan();
			$object->setAttributes($i);
			array_push($a,$object);
		}

		return $a;
	}
}

?>
