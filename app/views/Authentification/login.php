<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$core->startForm("index.php?controller=Authentification&action=loginCheck","post");
$core->addTextField("Nom d'utilisateur ou d'utilisatrice","username");
$core->addPasswordField("Mot de passe","password");
$core->endForm();

/*
foreach($users as $user){
	echo $user["username"];
}
*/

?>

