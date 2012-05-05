<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$core->makeButton("?controller=LoanManagement&action=add_selectMember","Ajouter un prêt");

?>

<br /><br />

<?php

echo "Nombre de prêts: ".count($list);

?>


<br /><br />

<?php

foreach($list as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

?>
