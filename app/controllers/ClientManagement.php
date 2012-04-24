<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class ClientManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("ClientManagement",$this);
		$core->secureController("ClientManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les clients");

		$finder=new Client();

		$list=$finder->getList($core);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add($core){

		$core->setPageTitle("Ajouter un client");


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un client");

		$finder=new Client();

		$finder->insertRow($core,"Client",$core->getPostData());
	
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$client=Client::findWithIdentifier($core,"Client",$identifier);

		$core->setPageTitle($client->getName());
		$columnNames=$client->getFieldNames();
		
		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
