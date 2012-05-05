<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>



<?php

$this->startForm("?controller=LoanManagement&action=add_selectPlace");

echo "<tr><td  class=\"tableContentCell\">Membre</td><td class=\"tableContentCell\">";

echo "<select name=\"memberIdentifier\" class=\"tableContentCell\">";

foreach($items as $item){

	$memberIdentifier=$item->getId();
	$memberName=$item->getName();

	echo "<option class=\"tableContentCell\" value=\"$memberIdentifier\" >$memberName</option>";

}

echo "</select>";

echo "</td></tr>";
$this->endForm();
?>
