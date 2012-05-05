<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class LoanManagement extends Controller{

	public function registerController($core){
		$core->registerControllerName("LoanManagement",$this);
		$core->secureController("LoanManagement");
	}

	public function call_list($core){

		$core->setPageTitle("Voir les prêts");

		$listReturnedLate=Loan::findAllReturnedLateLoans($core);
		$listReturnedNotLate=Loan::findAllReturnedNotLateLoans($core);
		$listActiveLate=Loan::findAllActiveLateLoans($core);
		$listActiveNotLate=Loan::findAllActiveNotLateLoans($core);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_selectMember($core){

		$core->setPageTitle("Quel membre veut emprunter un vélo ?");


		$items=Member::getMembersThatCanLoanABike($core);

		include($this->getView(__CLASS__,__METHOD__));
	}


	public function call_add_selectPlace($core){

		$core->setPageTitle("À quel point de service êtes-vous ?");

		$items=Place::findAll($core,"Place");

		$member=Member::findWithIdentifier($core,"Member",$_POST['memberIdentifier']);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_selectBike($core){

		$core->setPageTitle("Quel vélo voulez-vous ?");

		$place=Place::findWithIdentifier($core,"Place",$_POST['placeIdentifier']);
	
		$items=$place->getAvailableBikes();

		$member=Member::findWithIdentifier($core,"Member",$_POST['memberIdentifier']);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_add_validate($core){

		$core->setPageTitle("Voulez-vous faire ce prêt ?");

		$place=Place::findWithIdentifier($core,"Place",$_POST['placeIdentifier']);
	
		$bike=Bike::findWithIdentifier($core,"Bike",$_POST['bikeIdentifier']);

		$member=Member::findWithIdentifier($core,"Member",$_POST['memberIdentifier']);

		$startingDate=$core->getCurrentTime();

		$today=$core->getCurrentDate();

		$schedule=$place->getSchedule($today);

		$endingDate=$this->getEndingDate($place,$today,$startingDate);

		$minutes=(strtotime($endingDate)-strtotime($startingDate))/60;

		include($this->getView(__CLASS__,__METHOD__));
	}

	private function getEndingDate($place,$today,$startingDate){

		$now=strtotime($startingDate);
		$length=3*60*60;
		$final=$now+$length;
		$endingDate=date("Y-m-d H:i:s",$final);

		$schedule=$place->getSchedule($today);

		if($schedule!=NULL){
			$dayOfWeek=date("N")-1;

			$scheduledDay=$schedule->getScheduledDay($dayOfWeek);

			$length=$scheduledDay->getAttribute("loanLength")*60*60;

			$final=$now+$length;
			$endingDate=date("Y-m-d H:i:s",$final);
		}

		return $endingDate;

	}

	public function call_add_save($core){

		$core->setPageTitle("Sauvegarde d'un prêt");

		$place=Place::findWithIdentifier($core,"Place",$_POST['placeIdentifier']);
	
		$bike=Bike::findWithIdentifier($core,"Bike",$_POST['bikeIdentifier']);

		$member=Member::findWithIdentifier($core,"Member",$_POST['memberIdentifier']);

		$startingDate=$core->getCurrentTime();

		$today=$core->getCurrentDate();

		$endingDate=$this->getEndingDate($place,$today,$startingDate);

		$attributes=array();

		$attributes["bikeIdentifier"]=$_POST['bikeIdentifier'];
		$attributes["userIdentifier"]=$_SESSION['id'];
		$attributes["memberIdentifier"]=$_POST['memberIdentifier'];
		$attributes["startingDate"]=$_POST['startingDate'];
		$attributes["expectedEndingDate"]=$_POST['expectedEndingDate'];
		$attributes["actualEndingDate"]=$_POST['actualEndingDate'];
		$attributes["returnUserIdentifier"]=$_SESSION['id'];
		$attributes["placeIdentifier"]=$_POST['placeIdentifier'];

		$item=Loan::insertRow($core,"Loan",$attributes);

		$id=$item->getId();
		$name=$item->getName();

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_view($core){

		$core->setPageTitle("Voir un prêt");

		$item=Loan::findWithIdentifier($core,"Loan",$_GET['id']);

		$columnNames=Loan::getFieldNames();
		
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_return_validate($core){

		$core->setPageTitle("Voulez-vous terminer le prêt ?");

		$item=Loan::findWithIdentifier($core,"Loan",$_GET['id']);

		$columnNames=Loan::getFieldNames();

		$currentTime=$core->getCurrentTime();
		
		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_return_save($core){

		$core->setPageTitle("Le prêt est terminé.");

		$item=Loan::findWithIdentifier($core,"Loan",$_GET['id']);

		$item->returnBike($_POST["actualEndingDate"]);
		
		$item=Loan::findWithIdentifier($core,"Loan",$_GET['id']);

		$columnNames=Loan::getFieldNames();

		include($this->getView(__CLASS__,__METHOD__));
	}



};

?>
