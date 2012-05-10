<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class RepairType extends Model{
	public function getName(){
		return $this->getAttribute("name");
	}

	public function getFieldNames(){
		$names=array();

		$names["name"]="Description";

		return $names;
	}

	public static function getDefault($core){

		$table=$core->getTablePrefix()."RepairType";

		$query=" select * from $table order by id asc limit 1 ; ";

		$item=RepairType::findOneWithQuery($core,$query,"RepairType");

		return $item;
	}
}

?>
