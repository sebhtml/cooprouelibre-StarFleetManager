<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$id=$_GET['id'];

$this->startForm("?controller=MemberManagement&action=cancelLockSave&id=$id");
$this->addTextField("Explication","explanation");
$this->endForm();

?>

