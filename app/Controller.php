<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Controller{
	public function getView($controller,$action){
		$action=str_replace("$controller::call_","",$action);

		return "app/views/$controller/$action.php";
	}
}

?>
