<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
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

		$finder=new Member();

		$finder->insertRow($core,"Member",$core->getPostData());
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$member=Member::findWithIdentifier($core,"Member",$identifier);

		$core->setPageTitle($member->getName());
		$columnNames=$member->getFieldNames();
		
		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
