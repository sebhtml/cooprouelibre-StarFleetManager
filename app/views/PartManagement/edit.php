<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=PartManagement&action=editSave&id={$item->getId()}");
$this->renderHiddenFieldWithValue("id","Numéro de la pièce (dans la base de données)",$item->getId(),$item->getId());
$this->renderFormForModelWithObject($core,"Part",$item);
$this->endForm();

?>
