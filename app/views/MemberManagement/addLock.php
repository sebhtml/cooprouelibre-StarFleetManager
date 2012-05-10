<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$id=$_GET['id'];

$this->startForm("?controller=MemberManagement&action=addLockSave&id=$id");
$this->addTextField("Date de début (aaaa-mm-jj)","startingDate");
$this->addTextField("Date de fin (aaaa-mm-jj)","endingDate");
$this->endForm();

?>

