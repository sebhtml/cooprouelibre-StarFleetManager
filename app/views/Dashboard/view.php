<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($isAdministrator){
?>


<a href="index.php?controller=Administration&action=addEmployee">Ajouter un employé</a><br />

<?php

}

?>


<a href="index.php?controller=Bike&action=list">Voir les vélos</a><br />
<a href="index.php?controller=Client&action=list">Voir les clients</a><br />
<a href="index.php?controller=Repair&action=list">Voir les réparations</a><br />
<a href="index.php?controller=Loan&action=list">Voir les emprunts</a><br />

