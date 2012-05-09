<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=UserManagement&action=editSave&id={$item->getId()}");

$this->renderHiddenFieldWithValue("username","Nom d'utilisateur",$item->getAttribute("username"),$item->getAttribute("username"));
$this->addPasswordField("Mot de passe","password");
$this->addPasswordField("Mot de passe (validation)","password2");
$this->addTextFieldWithValue("Prénom","firstName",$item->getAttribute("firstName"));
$this->addTextFieldWithValue("Nom de famille","lastName",$item->getAttribute("lastName"));
$this->addTextFieldWithValue("Courriel","email",$item->getAttribute("email"));

$this->renderHiddenFieldWithValue("isAdministrator","Est un administrateur du système ?",$item->getAttribute("isAdministrator"),$item->getAttribute("isAdministrator"));


$this->endForm();

?>
