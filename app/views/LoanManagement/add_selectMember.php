<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>



<?php

if(count($all)==0){

?>

Aucun membre ne peut louer de vélo présentement.

<?php

}else{

if(array_key_exists('query',$_POST)){
	echo "Vous avez cherché \"{$_POST['query']}\"<br /><br />";
}

if(count($items)==0){

echo "Aucun membre a été trouvé.<br />";
echo "Vous pouvez aussi trouver un membre avec une liste déroulante.<br /><br />";



$core->makeButton("?controller=LoanManagement&action=add_selectMember","Utiliser une liste déroulante");



}else{

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

}

}
?>
