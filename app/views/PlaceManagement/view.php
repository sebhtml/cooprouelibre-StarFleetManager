<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item->getAttributes(),$columnNames);

?>

<br />

<?php

$core->makeButton("?controller=LoanManagement&action=list&placeIdentifier=$placeIdentifier","Voir les prêts");

?>

<h2>Horaires</h2>

Horaires:

<?php

echo count($schedules);

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


$core->makeButton("?controller=Scheduling&action=add&placeIdentifier=$placeIdentifier","ajouter un horaire");


?>

<br />
<br />

<h2>Jours fermés</h2>

Jours fermés:

<?php

echo count($closedDays);

?>

<br />
<br />

<?php

foreach($closedDays as $item){

	$id=$item->getId();
	$name=$item->getName();

	echo "<a href=\"?controller=ClosedDays&action=view&id=$id\">$name</a><br />";
}

?>

<br />
<br />

<?php


$core->makeButton("?controller=ClosedDays&action=add&placeIdentifier=$placeIdentifier","ajouter un jour fermé");

?>


