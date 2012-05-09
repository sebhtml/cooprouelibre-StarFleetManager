<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=UserManagement&action=add_save");

$this->addTextField("Nom d'utilisateur","username");
$this->addPasswordField("Mot de passe","password");
$this->addPasswordField("Mot de passe (validation)","password2");
$this->addTextField("Prénom","firstName");
$this->addTextField("Nom de famille","lastName");
$this->addTextField("Courriel","email");
$this->AddYesNoSelector("Est un administrateur du système de gestion ?","isAdministrator");

$this->endForm();

?>
