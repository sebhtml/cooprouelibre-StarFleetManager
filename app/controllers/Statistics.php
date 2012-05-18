<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Statistics extends Controller{

	public function registerController($core){
		$core->registerControllerName("Statistics",$this);
		$core->secureController("Statistics");
	}

	public function call_list($core){

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isViewer=$user->isViewer();

		if(!$isViewer){
			return;
		}

		include($this->getView(__CLASS__,__METHOD__));
	}


};

?>
