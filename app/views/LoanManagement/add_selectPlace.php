<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>



<?php

$this->startForm("?controller=LoanManagement&action=add_selectBike");


$this->renderHiddenFieldWithValue("memberIdentifier","Membre",$member->getName(),$member->getId());

echo "<tr><td  class=\"tableContentCell\">Point de service</td><td class=\"tableContentCell\">";

echo "<select name=\"placeIdentifier\" class=\"tableContentCell\">";

foreach($items as $item){

	$id=$item->getId();
	$name=$item->getName();

	echo "<option class=\"tableContentCell\" value=\"$id\" >$name</option>";

}

echo "</select>";

echo "</td></tr>";

$this->endForm();
?>
