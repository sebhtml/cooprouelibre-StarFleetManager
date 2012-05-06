<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class User extends Model{

	public static function findPerson($core,$username,$password){

		$md5=md5($password);

		$query="select * from {$core->getTablePrefix()}User where username='$username' and md5Password='$md5' limit 1";
		$rows=$core->getConnection()->query($query)->getRows();

		if(count($rows)==1){
			$person=new User();
			$person->setAttributes($rows[0]);
			return $person;
		}

		return NULL;
	}

	public static function findWithUsername($core,$username){
		$query="select * from {$core->getTablePrefix()}User where username='$username' limit 1";
		$rows=$core->getConnection()->query($query)->getRows();

		if(count($rows)==1){
			$person=new User();
			$person->setAttributes($rows[0]);
			return $person;
		}

		return NULL;
	}

	public function getName(){
		return $this->getAttributeValue("firstName")." ".$this->getAttributeValue("lastName")." (".$this->getAttributeValue("username").")";
	}

	public function getFieldNames(){
		return array(
			"username" => "Nom d'utilisateur",
			"md5Password" => "Mot de passe",
			"firstName" => "Prénom",
			"lastName" => "Nom de famille",
			"isAdministrator" => "Est un administrateur du système ?"
		);
	}

	public function mustSkipAttribute($name){
		if($name=="id" || $name=="md5Password"){
			return true;
		}else{
			return false;
		}
	}

}

?>
