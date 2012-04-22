<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Model{
	protected $m_attributes;

	public function getAttributes(){
		return $this->m_attributes;
	}

	public function setAttributes($values){
		$this->m_attributes=$values;
	}
}

?>
