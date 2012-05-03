<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

echo "<a href=\"index.php?controller=UserManagement&action=add\">Ajouter un compte</a><br />";

?>


<br />

<?php

echo "Nombre de comptes: ".count($list);

?>


<br />
<br />

<?php

foreach($list as $i){
	$id=$i->getAttributeValue('id');
	$name=$i->getAttributeValue('username');

	echo "<a href=\"index.php?controller=UserManagement&action=view&id=$id\">$name</a><br />";
}

?>
