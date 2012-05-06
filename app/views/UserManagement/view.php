<?php

// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


$this->printRowAsTable($item);

if(array_key_exists("id",$_SESSION) && $_SESSION["id"]==$item->getAttributeValue("id")){

	$core->makeButton("?controller=UserManagement&action=selfEdit","changer son profil");
}

?>

