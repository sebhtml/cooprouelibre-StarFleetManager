<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($isAdministrator){
	$core->makeButton("?controller=UserManagement&action=add","Ajouter un utilisateur");

}

?>


<br />
<br />

<?php

echo "Nombre d'opérateurs: ".count($list);

?>


<br />
<br />

<?php

foreach($list as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=UserManagement&action=view&id=$id\">$name</a><br />";
}

?>
