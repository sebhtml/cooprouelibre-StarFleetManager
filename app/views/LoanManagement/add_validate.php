<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>


<?php

if($schedule==NULL || $endingDate==NULL){

?>

Il n'y a pas d'horaire de programmé pour  <?php echo $startingDate ; ?> au 
point de service <?php echo $place->getName(); ?>.

<?php

}else{

$this->startForm("?controller=LoanManagement&action=add_save");
$this->renderHiddenFieldWithValue("memberIdentifier","Membre",$member->getName(),$member->getId());
$this->renderHiddenFieldWithValue("placeIdentifier","Point de service",$place->getName(),$place->getId());
$this->renderHiddenFieldWithValue("bikeIdentifier","Vélo",$bike->getName(),$bike->getId());
$this->renderHiddenFieldWithValue("startingDate","Début du prêt",$startingDate,$startingDate);
$this->renderHiddenFieldWithValue("expectedEndingDate","Retour du prêt",$endingDate,$endingDate);
$this->renderHiddenFieldWithValue("actualEndingDate","","",$startingDate);
$this->endForm();

}
?>
