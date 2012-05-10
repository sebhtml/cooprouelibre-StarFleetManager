<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($valid){
	echo "La transaction a été ajoutée.";
}else{
	echo "La transaction est invalide. La balance ne peut pas être négative et le changement ne peut pas être 0.";
}
?>
