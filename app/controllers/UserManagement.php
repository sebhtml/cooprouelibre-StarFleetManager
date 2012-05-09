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

		$core->setPageTitle("Voir les utilisateurs");

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
		
		$allowed=$isAdministrator || $_GET['id'] == $_SESSION['id'];

		include($this->getView(__CLASS__,__METHOD__));

	}

	public function call_add($core){

		$core->setPageTitle("Ajouter un utilisateur");


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function validateInformation(){
		if(strlen($_POST['password']) < 8){
			return false;
		}

		if( $_POST['password']!=$_POST['password2']){
	
			return false;

		}
		
		return true;
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un utilisateur");

		$valid=$this->validateInformation();

		if($valid){
			$_POST['md5Password']=md5($_POST['password']);
			User::insertRow($core,"User",$_POST);
		}

	
		include($this->getView(__CLASS__,__METHOD__));
	}


	public function getFieldNames(){
		$names=array();
		$names["username"]="Nom d'utilisateur";
		$names["md5Password"]="Mot de passe";
		$names["firstName"]="Prénom";
		$names["lastName"]="Nom de famille";
		$names["isAdministrator"]="Est un administrateur du système ?";
	
		return $names;
	}

	public function call_edit($core){
		$identifier=$_GET["id"];

		$item=User::findOne($core,"User",$identifier);

		$core->setPageTitle("Éditer son profil");
		
		$user=User::findOne($core,"User",$_GET['id']);
		$isAdministrator=$user->isAdministrator();
		$allowed=$isAdministrator || $_GET['id'] == $_SESSION['id'];

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_editSave($core){


		$core->setPageTitle("Éditer son profil");
		
		$user=User::findOne($core,"User",$_SESSION['id']);
		$isAdministrator=$user->isAdministrator();

		$allowed=$isAdministrator || $_GET['id'] == $_SESSION['id'];
		
		if(!$allowed){
			return;
		}

		$valid=$this->validateInformation();

		if($valid){
			$_POST['md5Password']=md5($_POST['password']);

			// only an administrator can spawn an administrator
			if(!$isAdministrator){
				$_POST['isAdministrator']=$user->getAttribute("isAdministrator");
			}


			User::updateRow($core,"User",$_POST,$_GET['id']);
		}


		include($this->getView(__CLASS__,__METHOD__));
	}

};

?>
