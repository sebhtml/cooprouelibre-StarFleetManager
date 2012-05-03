<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Model{
	protected $m_attributes;

	public function getAttributes(){
		return $this->m_attributes;
	}

	public function getAttributeValue($field){
		return $this->m_attributes[$field];
	}

	public static function findAll($core,$model){
		$table=$core->getTablePrefix().$model;

		$list=$core->getConnection()->query("select * from $table ;")->getRows();
		
		$objects=array();

		foreach($list as $i){
			$item=new $model();

			$item->setAttributes($i);
			array_push($objects,$item);

		}

		return $objects;
	}


	public static function findWithIdentifier($core,$model,$identifier){
		$table=$core->getTablePrefix().$model;

		$list=$core->getConnection()->query("select * from $table where id=$identifier ;")->getRows();
		
		$item=new $model();

		$item->setAttributes($list[0]);

		return $item;
	}

	public function setAttributes(&$values){
		$this->m_attributes=$values;
	}

	public function getPersistentAttributesForTable($core,$table){
		return $core->getConnection()->query("describe $table ;")->getRows();
	}

	public function getTableList($core){
		$list=$core->getConnection()->query("show tables ;")->getRows();

		$output= array();
		$databaseName=$core->getDatabaseName();
		$keyName="Tables_in_".$databaseName;

		foreach($list as $i){
			array_push($output,$i[$keyName]);
		}

		return $output;
	}

	public function getFieldNames(){
		return array();
	}

	public function isSelectField($field){
		return false;
	}

	public function getSelectOptions($field){

		echo "Hi!";
		return array();
	}

	public function insertRow($core,$model,$attributeValues){
		$table=$core->getTablePrefix().$model;

		$attributes=$this->getPersistentAttributesForTable($core,$table);

		$attributeList="";
		$valuesList="";

		//print_r($attributes);
		//print_r($attributeValues);

		for($i=0;$i<count($attributes);$i++){
			$field=$attributes[$i]['Field'];

			if($i==0){
				$attributeList.=" ( ";
				$valuesList.=" ( ";
			}

			if($field=="id"){
				continue;
			}
	
			$type=$attributes[$i]['Type'];

			$value=$attributeValues[$field];

			//echo "Field: $field, Value: $value";

			if($type=="varchar(255)" || $type=="date" || $type="char(1)"){
				
				$value="'$value'";
	
			}

			$attributeList.= $field;
			$valuesList.= $value;

			if($i==count($attributes)-1){

				$attributeList.=" ) ";
				$valuesList.=" ) ";
			}else{

				$attributeList.=" , ";
				$valuesList.=" , ";

			}
		}

		$query="insert into $table $attributeList values $valuesList ; ";

		$core->getConnection()->query($query);
	}

	public function getName(){
		return $this->getAttributeValue("id");
	}

	public function isFilledField($field){
		return false;
	}

	public function getFilledValue($core,$field){
		return "NULL";
	}
}

?>
