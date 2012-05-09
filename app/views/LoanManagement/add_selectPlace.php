<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>



<?php

if(count($items)==0){

?>

Il n'y a aucun point de service.

<?php

}else{

$this->startForm("?controller=LoanManagement&action=add_selectBike");


$this->renderHiddenFieldWithValue("memberIdentifier","Membre",$member->getName(),$member->getId());

if(count($items)==1){

$this->renderHiddenFieldWithValue("placeIdentifier","Point de service",$items[0]->getName(),$items[0]->getId());

}else{

echo "<tr><td  class=\"tableContentCell\">Point de service</td><td class=\"tableContentCell\">";

echo "<select name=\"placeIdentifier\" class=\"tableContentCell\">";




foreach($items as $item){

	$id=$item->getId();
	$name=$item->getName();

	echo "<option class=\"tableContentCell\" value=\"$id\"  >$name</option>";

}


echo "</select>";

echo "</td></tr>";

}

$this->endForm();

}

?>
