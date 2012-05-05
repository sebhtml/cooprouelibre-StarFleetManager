<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>


<?php

if($schedule==NULL){

?>

Il n'y a pas d'horaire de programmé pour cette date.<br /><br />

<?php

}

$this->startForm("?controller=LoanManagement&action=add_save");

$this->renderHiddenFieldWithValue("memberIdentifier","Membre",$member->getName(),$member->getId());

$this->renderHiddenFieldWithValue("placeIdentifier","Point de service",$place->getName(),$place->getId());

$this->renderHiddenFieldWithValue("bikeIdentifier","Vélo",$bike->getName(),$bike->getId());

$this->addTextFieldWithValue("Début du prêt","startingDate",$startingDate);
$this->addTextFieldWithValue("Retour du prêt","expectedEndingDate",$endingDate);

$this->renderHiddenFieldWithValue("actualEndingDate","","",$startingDate);

$this->endForm();
?>
