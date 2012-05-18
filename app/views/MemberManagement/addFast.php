<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=MemberManagement&action=addFast_save");
$this->addTextField("Prénom","firstName");
$this->addTextField("Nom de famille","lastName");
$this->addTextField("Numéro de téléphone","phoneNumber");

$this->endForm();

?>
