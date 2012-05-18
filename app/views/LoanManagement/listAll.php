<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>

Nombre de prêts: <?php  echo count($items); ?>
<br /><br />

<?php

foreach($items as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=LoanManagement&action=view&id=$id\">$name</a><br />";
}

?>


