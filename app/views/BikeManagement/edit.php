<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=BikeManagement&action=editSave&id={$item->getId()}");
$this->renderHiddenFieldWithValue("id","Numéro du vélo (dans la base de données)",$item->getId(),$item->getId());
$this->renderFormForModelWithObject($core,"Bike",$item);
$this->endForm();

?>
