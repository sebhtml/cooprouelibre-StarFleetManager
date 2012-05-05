<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

echo "<a href=\"index.php?controller=LoanManagement&action=add\">Ajouter un prêt</a><br />";

echo "Nombre de prêts: ".count($list);

foreach($list as $i){
	$id=$i->getAttributeValue('uniqueIdentifier');
	$name=$i->getAttributeValue('startingDate');

	echo "<a href=\"index.php?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

?>
