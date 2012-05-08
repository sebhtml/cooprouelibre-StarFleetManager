<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

define("RIGHT_MANAGER",0x0);
define("RIGHT_MECHANIC",0x1);
define("RIGHT_LOAN_OPERATOR",0x2);
define("RIGHT_VIEWER",0x3);


class Right extends Model{

	public function getPlace(){
		return Place::findOne($this->m_core,"Place",$this->getAttribute("placeIdentifier"));
	}
}

?>
