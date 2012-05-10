<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($isManager){
$core->makeButton("?controller=BikeManagement&action=add","Ajouter un vélo");
}

echo "<br />";
echo "<br />";
echo "Nombre de vélos: ".count($list);
echo "<br />";
echo "<br />";

foreach($list as $i){
	$id=$i->getAttributeValue("id");
	$name=$i->getName();

	echo "<a href=\"?controller=BikeManagement&action=view&id=$id\">$name</a> ";

	if($i->isLoaned()){
		echo "prêté";
	}elseif($i->hasRepairs()){
		echo "en réparation";
	}else{
		echo "disponible";
	}

	echo "<br />";
}

?>
