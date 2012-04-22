<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Person extends Model{

	public function findPerson($core,$username,$password){

		$md5=md5($password);

		$query="select username from {$core->getTablePrefix()}Person where username='$username' and md5Password='$md5' limit 1";
		$rows=$core->getConnection()->query($query)->getRows();

		//echo $query;

		//echo "Rows: ".count($rows);

		if(count($rows)==1){
			$person=new Person();
			$person->setAttributes($rows[0]);
			return $person;
		}

		return NULL;
	}

	public function getList($core){
		return $core->getConnection()->query("select username from {$core->getTablePrefix()}Person")->getRows();
	}

	public function findWithUsername($core,$username){
		$query="select * from {$core->getTablePrefix()}Person where username='$username' limit 1";
		$rows=$core->getConnection()->query($query)->getRows();

		if(count($rows)==1){
			$person=new Person();
			$person->setAttributes($rows[0]);
			return $person;
		}

		return NULL;
	}

	public function isAdministrator(){
		return (boolean) $this->m_attributes["isAdministrator"];
	}
}

?>
