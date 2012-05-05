<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if(count($bikes)>0){
	$core->makeButton("?controller=RepairManagement&action=add","Ajouter une réparation");
}

echo "<br />";
echo "<br />";

?>

<h1>Réparations à faire</h1>

<?php

echo "Nombre de réparations: ".count($listToDo);

echo "<br />";
echo "<br />";
foreach($listToDo as $i){

	$id=$i->getAttributeValue('id');
	$name=$i->getName();

	echo "<a href=\"?controller=RepairManagement&action=view&id=$id\">$name</a><br />";
}

?>

<h1>Réparations complétées</h1>

<?php

echo "Nombre de réparations: ".count($listDone);

echo "<br />";
echo "<br />";
foreach($listDone as $i){
	$id=$i->getAttributeValue('id');
	$name=$i->getName();

	echo "<a href=\"?controller=RepairManagement&action=view&id=$id\">$name</a><br />";
}

?>


