<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class MemberManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("MemberManagement",$this);
		$core->secureController("MemberManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les membres");

		$list=Member::findAll($core,"Member");

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add($core){

		$core->setPageTitle("Ajouter un membre");


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un membre");

		Member::insertRow($core,"Member",$core->getPostData());
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$member=Member::findWithIdentifier($core,"Member",$identifier);

		$core->setPageTitle($member->getName());
		$columnNames=$member->getFieldNames();
		
		$user=User::findOne($core,"User",$_SESSION['id']);
		$isAdministrator=$user->isAdministrator();

		include($this->getView(__CLASS__,__METHOD__));
	}


	public function call_edit($core){

		$core->setPageTitle("Éditer un membre");

		$member=Member::findOne($core,"Member",$_GET['id']);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_editSave($core){

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isAdministrator=$user->isAdministrator();

		if(!$isAdministrator){
			return;
		}

		$core->setPageTitle("Sauvegarder un membre");

		Member::updateRow($core,"Member",$_POST,$_POST['id']);
	
		include($this->getView(__CLASS__,__METHOD__));
	}

};

?>
