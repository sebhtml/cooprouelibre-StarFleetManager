<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$core->makeButton("index.php?controller=RepairManagement&action=add","Ajouter une réparation");

echo "<br />";
echo "<br />";
echo "Nombre de réparations: ".count($list);

echo "<br />";
echo "<br />";
foreach($list as $i){
	$id=$i->getAttributeValue('id');
	$name=$i->getName();

	echo "<a href=\"index.php?controller=RepairManagement&action=view&id=$id\">$name</a><br />";
}

?>
