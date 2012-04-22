<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

echo "<a href=\"index.php?controller=RepairManagement&action=add\">Ajouter une réparation</a><br />";

echo "Nombre de réparations: ".count($list);

foreach($list as $i){
	$id=$i->getAttributeValue('uniqueIdentifier');
	$name=$i->getAttributeValue('description');

	echo "<a href=\"index.php?controller=Repair&action=view&id=$id\">$name</a><br />";
}

?>
