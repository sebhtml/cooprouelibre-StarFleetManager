<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


if($user->isAdministrator()){
	echo "Nombre de points de service: ".count($list)."<br /><br />";
}

foreach($list as $i){
	$id=$i->getAttributeValue('id');
	$name=$i->getName();

	echo "<a href=\"?controller=PlaceManagement&action=view&id=$id\">$name</a><br />";
}

echo "<br />";
echo "<br />";

if($user->isAdministrator()){
	$core->makeButton("?controller=PlaceManagement&action=add","Ajouter un point de service");
}


?>
