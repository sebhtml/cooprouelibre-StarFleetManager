<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Bike extends Model{

	public function getList($core){
		$list=$core->getConnection()->query("select * from {$core->getTablePrefix()}Bike ")->getRows();

		$a=array();
		foreach($list as $i){
			$object=new Bike();
			$object->setAttributes($i);
			array_push($a,$object);
		}

		return $a;
	}
}

?>
