<?php // Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item);


?>

<br />
<h1>Balance</h1>

<?php

echo "Quantité disponible: $balance<br />";

?>

<h1>Transactions</h1>
<?php

if(count($transactions)==0){
	echo "Aucune.";
}else{

	$this->printArrayAsTable($table,$transactions[0]->getFieldNames());
}

echo "<br /><br />";

if($isMechanic){
	$core->makeButton("?controller=PartManagement&action=addTransaction&id={$item->getId()}","mettre à jour l'inventaire");
}


?>
