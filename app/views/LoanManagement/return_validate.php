<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item);

$id=$item->getAttributeValue("id");
?>

<br /><br />

<?php

$this->startForm("?controller=LoanManagement&action=return_save&id=$id");
$this->addTextFieldWithValue("Date de retour","actualEndingDate",$currentTime);
$this->endForm();




?>
