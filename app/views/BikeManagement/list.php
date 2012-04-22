<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

echo "<a href=\"index.php?controller=BikeManagement&action=add\">Ajouter un vélo</a><br />";

echo "Nombre de vélos: ".count($list);

foreach($list as $i){
	$id=$i->getAttributeValue('uniqueIdentifier');
	$name=$i->getAttributeValue('commonName');

	echo "<a href=\"index.php?controller=Bike&action=view&id=$id\">$name</a><br />";
}

?>
