<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=ClosedDays&action=add_save");

$this->renderHiddenFieldWithValue("placeIdentifier","Point de service",$place->getName(),$place->getId());
$this->addTextField("Date (aaaa-mm-jj)","dayOfYear");
$this->addTextField("Nom","name");
$this->renderHiddenFieldWithValue("userIdentifier","Créateur",$currentUser->getName(),$currentUser->getId());

$this->endForm();

?>
