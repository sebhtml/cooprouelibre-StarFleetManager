<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("index.php?controller=PlaceManagement&action=add_save");
$this->renderFormForModel($core,"Place");
$this->endForm();

?>
