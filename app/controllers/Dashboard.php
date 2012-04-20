<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Dashboard{

	public function checkDatabase($connection){

	}

	public function registerPlugin($core){
		$core->registerController("Dashboard",$this);
	}

	public function call($action){
		echo("Hello");
	}
};

?>
