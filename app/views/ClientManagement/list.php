<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$core->makeButton("index.php?controller=ClientManagement&action=add","Ajouter un client");
echo "<br />";

echo "Nombre de clients: ".count($list);

foreach($list as $i){
	$id=$i->getAttributeValue('id');
	$name=$i->getAttributeValue('firstName');
	$name=$i->getAttributeValue('lastName');

	echo "<a href=\"index.php?controller=ClientManagement&action=view&id=$id\">$name</a><br />";
}

?>
