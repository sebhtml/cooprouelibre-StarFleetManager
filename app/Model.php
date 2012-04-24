<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Model{
	protected $m_attributes;
	protected $m_tableName;

	public function getAttributes(){
		return $this->m_attributes;
	}

	public function setAttributes($values){
		$this->m_attributes=$values;
	}

	public function getPersistentAttributes($core,$table){
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
}

?>
