<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class User extends Model{

	public function findPerson($core,$username,$password){

		$md5=md5($password);

		$query="select username from {$core->getTablePrefix()}User where username='$username' and md5Password='$md5' limit 1";
		$rows=$core->getConnection()->query($query)->getRows();

		if(count($rows)==1){
			$person=new User();
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

	public function getClientList($core){
		$list=$core->getConnection()->query("select * from {$core->getTablePrefix()}Person where isClient=1")->getRows();

		$a=array();
		foreach($list as $i){
			$object=new Person();
			$object->setAttributes($i);
			array_push($a,$object);
		}

		return $a;
	}

}

?>
