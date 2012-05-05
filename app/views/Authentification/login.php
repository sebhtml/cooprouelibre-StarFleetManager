<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=Authentification&action=loginCheck");
$this->addTextField("Nom d'utilisateur ou d'utilisatrice","username");
$this->addPasswordField("Mot de passe","password");
$this->endForm();

/*
foreach($users as $user){
	echo $user["username"];
}
*/

?>

