<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item);

?>

<br />

<?php
$core->makeButton("?controller=LoanManagement&action=add_selectMember","Ajouter un prêt");

$core->makeButton("?controller=LoanManagement&action=list&placeIdentifier=$placeIdentifier","Voir les prêts");
$core->makeButton("?controller=BikeManagement&action=list&placeIdentifier=$placeIdentifier","Voir les vélos");

?>

<h2>Horaires</h2>

<?php

if($isManager){

?>

Horaires:

<?php

echo count($schedules);
}

?>

<br />
<br />

<?php

foreach($schedules as $item){

	$id=$item->getAttributeValue("id");
	$name=$item->getName();

	echo "<a href=\"?controller=Scheduling&action=view&id=$id\">$name</a><br />";
}

?>


<br />
<br />

<?php

if($isManager){

	$core->makeButton("?controller=Scheduling&action=add&placeIdentifier=$placeIdentifier","ajouter un horaire");
}


?>

<br />
<br />

<h2>Jours fermés</h2>

<?php

if($isManager){

?>

Jours fermés:

<?php

echo count($closedDays);
}

?>

<br />
<br />

<?php

foreach($closedDays as $item){

	$id=$item->getId();
	$name=$item->getName();

	echo "<a href=\"?controller=ClosedDayManagement&action=view&id=$id\">$name</a>";

	echo "<br />";
}

?>

<br />
<br />

<?php


if($isManager){
	$core->makeButton("?controller=ClosedDayManagement&action=add&placeIdentifier=$placeIdentifier","ajouter un jour fermé");
}

?>


