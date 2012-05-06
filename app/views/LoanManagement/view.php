<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item);

$id=$item->getAttributeValue("id");

?>

<br /><br />

<?php

if($item->isActive()){
	$core->makeButton("?controller=LoanManagement&action=return_validate&id=$id","Terminer le prêt");
}



?>
