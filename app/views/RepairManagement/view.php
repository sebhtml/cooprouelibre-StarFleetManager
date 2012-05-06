<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item);

$id=$item->getId();

?>

<br /><br />

<?php

if($item->isActive()){

	$core->makeButton("?controller=RepairManagement&action=complete_validate&id=$id","Compléter la réparation");
}

?>
