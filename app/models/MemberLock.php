<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class MemberLock extends Model{

	public function getUser(){
		return User::findOne($this->m_core,"User",$this->getAttribute("userIdentifier"));
	}
}

?>
