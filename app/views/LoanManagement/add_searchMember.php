<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>



<?php

if(count($items)==0){

?>

Aucun membre ne peut louer de vélo présentement.

<?php

}else{



$this->startForm("?controller=LoanManagement&action=add_selectMember");
$this->addTextField("Nom du membre","query");
$this->endForm();

}

?>


