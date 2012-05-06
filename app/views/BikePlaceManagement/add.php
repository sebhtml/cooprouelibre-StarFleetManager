<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=BikePlaceManagement&action=add_save");

$this->renderHiddenFieldWithValue("bikeIdentifier","Vélo",$bike->getName(),$bike->getId());
$this->renderHiddenFieldWithValue("userIdentifier","Opérateur",$user->getName(),$user->getId());


$this->renderHiddenFieldWithValue("startingDate","Date",$now,$now);

$list=array();

foreach($places as $item){
	$list[$item->getId()]=$item->getName();
}

$this->renderSelector("placeIdentifier","Point de service",$list);


$this->endForm();

?>
