<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=RepairManagement&action=addTypeSave");
$this->renderFormForModel($core,"RepairType");
$this->endForm();

?>
