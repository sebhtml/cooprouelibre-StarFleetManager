<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class UserManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("UserManagement",$this);
		$core->secureController("UserManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les opérateurs");

		$list=User::findAll($core,"User");

		$user=User::findWithIdentifier($core,"User",$_SESSION["id"]);

		$isAdministrator=$user->getAttribute("isAdministrator");

		include($this->getView(__CLASS__,__METHOD__));
	}



	public function call_view($core){
		$identifier=$_GET["id"];

		$item=User::findWithIdentifier($core,"User",$identifier);

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();
		
		$currentUser=User::findWithIdentifier($core,"User",$_SESSION['id']);

		$rights=$item->getRights();

		$isAdministrator=$currentUser->isAdministrator();
		
		include($this->getView(__CLASS__,__METHOD__));

	}

	public function call_add($core){

		$core->setPageTitle("Ajouter un opérateur");


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un opérateur");

		$valid=false;

		if(strlen($_POST['password']) >= 8 &&  $_POST['password']==$_POST['password2']){

			$_POST['md5Password']=md5($_POST['password']);

			Bike::insertRow($core,"User",$_POST);

			$valid=true;
		}
	
		include($this->getView(__CLASS__,__METHOD__));
	}


	public function getFieldNames(){
		$names=array();
		$names["username"]="Nom d'utilisateur";
		$names["md5Password"]="Mot de passe";
		$names["firstName"]="Prénom";
		$names["lastName"]="Nom de famille";
		$names["isAdministrator"]="Peut créer d'autres opérateurs?";
	
		return $names;
	}


};

?>
