<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Place extends Model{

	public function getFieldNames(){
		$names=array();
		$names["name"]="Nom du point de service";
	
		return $names;
	}
	public function getName(){
		return $this->getAttributeValue("name");
	}

	public function getSchedules($core){

		$table=$core->getTablePrefix()."Schedule";

		$identifier=$this->getAttributeValue("id");

		$list=$core->getConnection()->query("select * from $table where placeIdentifier=$identifier ;")->getRows();
		
		$objects=array();

		foreach($list as $i){
			$item=new Schedule();

			$item->setAttributes($i);
			array_push($objects,$item);

		}

		return $objects;
	}

}

?>
