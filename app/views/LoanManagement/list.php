<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

//$core->makeButton("?controller=LoanManagement&action=add_selectMember","Ajouter un prêt");

?>

<h1>Prêts en cours sans retard</h1>


<?php

foreach($listActiveNotLate as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

if(count($listActiveNotLate)==0){
echo "Aucun.";
}

?>

<h1>Prêts en cours avec retard</h1>


<?php

foreach($listActiveLate as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

if(count($listActiveLate)==0){
echo "Aucun.";
}
?>


<?php

//<h1>Prêts terminés sans retard</h1>
//echo "Nombre de prêts: ".count($listReturnedNotLate);

?>



<?php

/*
foreach($listReturnedNotLate as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

*/
?>


<?php

//<h1>Prêts terminés avec retard</h1>
//echo "Nombre de prêts: ".count($listReturnedLate);

?>



<?php

/*
foreach($listReturnedLate as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

*/

?>


<h1>Statistiques</h1>

<?php

$total=count($listActiveNotLate)+count($listActiveLate)+count($listReturnedNotLate)+count($listReturnedLate);
$returned=count($listReturnedNotLate)+count($listReturnedLate);
$active=count($listActiveLate)+count($listActiveNotLate);

echo "Nombre de prêts en cours: ".$active."<br />";
echo "Nombre de prêts terminés: ".$returned."<br />";
echo "Nombre total de prêts: ".$total."<br />";

?>


