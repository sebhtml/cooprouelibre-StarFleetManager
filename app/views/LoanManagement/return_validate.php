<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$toSkip=array("actualEndingDate"=>"","returnUserIdentifier"=>"");
$this->printRowAsTableWithSkipping($item,$toSkip);

$id=$item->getAttributeValue("id");
?>

<br /><br />

<?php

$this->startForm("?controller=LoanManagement&action=return_save&id=$id");
$this->addTextFieldWithValue("Date de retour","actualEndingDate",$currentTime);
$this->endForm();




?>
