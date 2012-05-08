<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class RightManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("RightManagement",$this);
		$core->secureController("RightManagement");
	}

	public function call_add($core){

		$core->setPageTitle("Ajouter un droit");

		$places=Place::findAll($core,"Place");
		$user=User::findOne($core,"User",$_GET['userIdentifier']);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_addSave($core){

		$core->setPageTitle("Ajouter un droit");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isAdministrator=$user->isAdministrator();
	
		if(!$isAdministrator){
			return;
		}

		Right::insertRow($core,"Right",$_POST);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_remove($core){

		$core->setPageTitle("Supprimer un droit");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isAdministrator=$user->isAdministrator();
	
		if(!$isAdministrator){
			return;
		}

		Right::removeRow($core,"Right",$_GET['id']);

		include($this->getView(__CLASS__,__METHOD__));
	}
	
};

?>
