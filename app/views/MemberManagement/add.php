<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("index.php?controller=MemberManagement&action=add_save");
$this->renderFormForModel($core,"Member");
$this->endForm();

?>
