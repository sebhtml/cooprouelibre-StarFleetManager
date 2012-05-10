<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class PartTransaction extends Model{

	public function getFieldNames(){
		$output=array();

		$output["id"]="Numéro";
		$output["partIdentifier"]="Pièce";
		$output["transactionDate"]="Date";
		$output["partChange"]="Changement";
		$output["userIdentifier"]="Utilisateur";
		$output["balance"]="Balance";

		return $output;
	}
}

?>
