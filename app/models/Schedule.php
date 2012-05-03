<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Schedule extends Model{

	public static function add($core,$placeIdentifier,$start,$end){

		$table=$core->getTablePrefix()."Schedule";

		$core->getConnection()->query("insert into $table (placeIdentifier,startingDate,endingDate) values ($placeIdentifier,'$start','$end');");

		$identifier=$core->getConnection()->getInsertedIdentifier();

		$item=Schedule::findWithIdentifier($core,"Schedule",$identifier);

		return $item;
	}

}

?>
