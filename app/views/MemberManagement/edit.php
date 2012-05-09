<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=MemberManagement&action=editSave&id={$member->getId()}");

$this->renderHiddenFieldWithValue("id","Numéro du membre",$member->getId(),$member->getId());
$this->renderFormForModelWithObject($core,"Member",$member);
$this->endForm();

?>
