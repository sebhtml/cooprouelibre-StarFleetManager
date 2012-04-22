<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

echo "<a href=\"index.php?controller=UserManagement&action=add\">Ajouter un compte</a><br />";

echo "Nombre de comptes: ".count($list);

foreach($list as $i){
	$id=$i->getAttributeValue('id');
	$name=$i->getAttributeValue('username');

	echo "<a href=\"index.php?controller=UserManagement&action=view&id=$id\">$name</a><br />";
}

?>
