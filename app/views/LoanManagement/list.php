<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$core->makeButton("?controller=LoanManagement&action=add_selectMember","Ajouter un prêt");

?>

<br /><br />

<h1>Prêts en cours sans retard</h1>

<?php

echo "Nombre de prêts: ".count($listActiveNotLate);

?>


<br /><br />

<?php

foreach($listActiveNotLate as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

?>

<h1>Prêts en cours avec retard</h1>

<?php

echo "Nombre de prêts: ".count($listActiveLate);

?>


<br /><br />

<?php

foreach($listActiveLate as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

?>

<h1>Prêts terminés sans retard</h1>

<?php

echo "Nombre de prêts: ".count($listReturnedNotLate);

?>


<br /><br />

<?php

foreach($listReturnedNotLate as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

?>

<h1>Prêts terminés avec retard</h1>

<?php

echo "Nombre de prêts: ".count($listReturnedLate);

?>


<br /><br />

<?php

foreach($listReturnedLate as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}



?>
