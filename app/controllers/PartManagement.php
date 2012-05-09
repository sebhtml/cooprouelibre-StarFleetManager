<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class PartManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("PartManagement",$this);
		$core->secureController("PartManagement");
	}

	public function call_list($core){


		$core->setPageTitle("Pièces");

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		$parts=Part::findAll($core,"Part");

		include($this->getView(__CLASS__,__METHOD__));
	}


	public function call_add($core){

		$core->setPageTitle("Ajouter une pièce");


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un pièce");

		Part::insertRow($core,"Part",$_POST);
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){

		$item=Part::findOne($core,"Part",$_GET['id']);

		$core->setPageTitle($item->getName());
		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();
		$transactions=array();

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_edit($core){

		$item=Part::findOne($core,"Part",$_GET['id']);

		$core->setPageTitle("Éditer une pièce");
		
		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		if(!$isMechanic){
			return;
		}

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_editSave($core){


		$core->setPageTitle("Éditer une pièce");
		
		$user=User::findOne($core,"User",$_SESSION['id']);
		$isMechanic=$user->isMechanic();

		if(!$isMechanic){
			return;
		}

		Part::updateRow($core,"Part",$_POST,$_POST['id']);

		include($this->getView(__CLASS__,__METHOD__));
	}


};

?>
