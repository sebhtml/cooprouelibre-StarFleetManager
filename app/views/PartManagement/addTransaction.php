<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=PartManagement&action=addTransactionSave");

$this->renderHiddenFieldWithValue("partIdentifier","Pièce",$part->getName(),$part->getId());
$this->renderHiddenFieldWithValue("transactionDate","Date",$now,$now);
$this->addTextFieldWithValue("Changement","partChange",-1);

$this->endForm();

?>
