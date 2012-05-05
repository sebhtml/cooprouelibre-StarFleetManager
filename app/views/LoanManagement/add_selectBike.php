<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>



<?php

if(count($items)==0){

?>

Aucun vélo n'est présentement disponible.

<?php

}
else{

$this->startForm("?controller=LoanManagement&action=add_validate");


$this->renderHiddenFieldWithValue("memberIdentifier","Membre",$member->getName(),$member->getId());

$this->renderHiddenFieldWithValue("placeIdentifier","Point de service",$place->getName(),$place->getId());

echo "<tr><td  class=\"tableContentCell\">Vélo</td><td class=\"tableContentCell\">";

echo "<select name=\"bikeIdentifier\" class=\"tableContentCell\">";

foreach($items as $item){

	$id=$item->getId();
	$name=$item->getName();

	echo "<option class=\"tableContentCell\" value=\"$id\" >$name</option>";

}

echo "</select>";

echo "</td></tr>";

$this->endForm();

}
?>
