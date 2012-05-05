<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Scheduling extends Controller{

	public function registerController($core){
		$core->registerControllerName("Scheduling",$this);
		$core->secureController("Scheduling");
	}

	public function call_add($core){

		$core->setPageTitle("Ajouter une période d'horaire");


		$placeIdentifier=$_GET['placeIdentifier'];

		$item=Place::findWithIdentifier($core,"Place",$placeIdentifier);

		$placeName=$item->getName();

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarder un période d'horaire");

		$scheduleAttributes=array();

		$scheduleAttributes["placeIdentifier"]=$_POST['placeIdentifier'];
		$scheduleAttributes['startingDate']=$_POST['startingDate'];
		$scheduleAttributes['endingDate']=$_POST['endingDate'];

		$item=Schedule::insertRow($core,"Schedule",$scheduleAttributes);

		$id=$item->getId();

		for($i=0;$i<7;$i++){

			$attributes=array();

			$attributes["scheduleIdentifier"]=$id;
			$attributes["dayOfWeek"]=$i;
			$attributes["opened"]=$_POST["opened$i"];
			$attributes["openingTime"]=$_POST["openingTime$i"];
			$attributes["returnTime"]=$_POST["returnTime$i"];
			$attributes["eveningTime"]=$_POST["eveningTime$i"];
			$attributes["closingTime"]=$_POST["closingTime$i"];
			$attributes["loanLength"]=$_POST["loanLength$i"];

			$scheduledDay=ScheduledDay::insertRow($core,"ScheduledDay",$attributes);

		}

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){
		$getData=$core->getGetData();
		$identifier=$getData["id"];

		$item=Schedule::findWithIdentifier($core,"Schedule",$identifier);

		$core->setPageTitle($item->getName());
		$columnNames=$item->getFieldNames();

		$days=$item->getScheduledDays();
		
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_edit($core){
		$identifier=$_GET["id"];

		$item=Schedule::findWithIdentifier($core,"Schedule",$identifier);

		$core->setPageTitle("Éditer ".$item->getName());
		$columnNames=$item->getFieldNames();

		$days=$item->getScheduledDays();
		
		$placeIdentifier=$item->getAttribute("placeIdentifier");

		$place=Place::findWithIdentifier($core,"Place",$placeIdentifier);

		$placeName=$place->getName();


		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_edit_save($core){

		$identifier=$_GET["id"];

		$core->setPageTitle("Sauvegarder un période d'horaire");

		$scheduleAttributes=array();

		$scheduleAttributes["placeIdentifier"]=$_POST['placeIdentifier'];
		$scheduleAttributes['startingDate']=$_POST['startingDate'];
		$scheduleAttributes['endingDate']=$_POST['endingDate'];

		$item=Schedule::updateRow($core,"Schedule",$scheduleAttributes,$identifier);

		$item=Schedule::findWithIdentifier($core,"Schedule",$identifier);

		$days=$item->getScheduledDays();

		$map=array();

		foreach($days as $day){
			$map[$day->getAttribute("dayOfWeek")]=$day;
		}

		for($i=0;$i<7;$i++){

			if(count($days)==0){
				break;
			}

			$scheduledDayIdentifier=$map[$i]->getId();

			$attributes=array();

			$attributes["scheduleIdentifier"]=$identifier;
			$attributes["dayOfWeek"]=$i;
			$attributes["opened"]=$_POST["opened$i"];
			$attributes["openingTime"]=$_POST["openingTime$i"];
			$attributes["returnTime"]=$_POST["returnTime$i"];
			$attributes["eveningTime"]=$_POST["eveningTime$i"];
			$attributes["closingTime"]=$_POST["closingTime$i"];
			$attributes["loanLength"]=$_POST["loanLength$i"];

			ScheduledDay::updateRow($core,"ScheduledDay",$attributes,$scheduledDayIdentifier);

		}

		include($this->getView(__CLASS__,__METHOD__));
	}


};

?>
