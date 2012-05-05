<?php

// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if(array_key_exists("identifier",$_SESSION) && $_SESSION["identifier"]==$item->getAttributeValue("id")){

	$core->makeButton("index.php?controller=UserManagement&action=selfEdit","changer son profil");
}

?>

