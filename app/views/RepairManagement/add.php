<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if(count($bikes)==0){

echo "Il n'y a aucun vélo qui peut être réparé.";

}else{

$this->startForm("?controller=RepairManagement&action=add_save");
$this->renderFormForModel($core,"Repair");
$this->endForm();

}

?>
