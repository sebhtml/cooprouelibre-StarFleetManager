<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("index.php?controller=Authentification&action=loginCheck");
$this->addTextField("Nom d'utilisateur ou d'utilisatrice","username");
$this->addPasswordField("Mot de passe","password");
$this->endForm();

/*
foreach($users as $user){
	echo $user["username"];
}
*/

?>

