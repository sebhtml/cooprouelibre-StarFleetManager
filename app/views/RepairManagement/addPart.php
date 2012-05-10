<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

?>

<?php

$id=$_GET['id'];

$this->startForm("?controller=RepairManagement&action=addPartSave&id=$id");

foreach($items as $i){
	$list[$i->getId()]=$i->getName();
}

$this->renderSelector("partIdentifier","Pièce",$list);

$this->endForm();




?>
