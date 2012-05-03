<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item->getAttributes(),$columnNames);

?>


<h2>Période d'horaires</h2>

Périodes programmées: 

<?php

echo count($schedules);

?>

<br />
<br />

<?php

$core->makeButton("index.php?controller=Scheduling&action=add&placeIdentifier=$placeIdentifier","ajouter une période d'horaire");
?>


