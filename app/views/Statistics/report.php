<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->startForm("?controller=Statistics&action=computeReport");


echo "<tr><td  class=\"tableContentCell\">Point de service</td><td class=\"tableContentCell\">";

echo "<select name=\"placeIdentifier\" class=\"tableContentCell\">";


foreach($items as $item){

	$id=$item->getId();
	$name=$item->getName();

	echo "<option class=\"tableContentCell\" value=\"$id\"  >$name</option>";

}


echo "</select>";

echo "</td></tr>";


$this->addTextField("Date de début (aaaa-mm-jj ou aaaa-mm-jj hh:mm:ss)","periodHead");
$this->addTextField("Date de fin (aaaa-mm-jj ou aaaa-mm-jj hh:mm:ss)","periodTail");


$this->endForm();

?>
