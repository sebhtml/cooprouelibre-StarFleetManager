<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Statistics extends Controller{

	public function registerController($core){
		$core->registerControllerName("Statistics",$this);
		$core->secureController("Statistics");
	}

	public function call_list($core){

		$user=User::findOne($core,"User",$_SESSION['id']);
		$isViewer=$user->isViewer();

		if(!$isViewer){
			return;
		}

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_computeReport($core){

		$place=Place::findOne($core,"Place",$_POST['placeIdentifier']);

		$start=$_POST['periodHead'];
		$end=$_POST['periodTail'];

		$core->setPageTitle($place->getName()." pour la période ".$start." -- ".$end);

		$bikes=$place->getLoanedBikesForPeriod($start,$end);
		$members=$place->getMembersForPeriod($start,$end);
		$loanList=$place->getLoansForPeriod($start,$end);

		$parts=Part::findAll($core,"Part");

		$repairs=$place->getRepairsForPeriod($start,$end);

		include($this->getView(__CLASS__,__METHOD__));
	}

	public function call_report($core){

		$core->setPageTitle("Pour quel point de service voulez-vous obtenir un rapport ?");

		$user=User::findOne($core,"User",$_SESSION['id']);

		$items=$user->getPlaces();

		include($this->getView(__CLASS__,__METHOD__));
	}
};

?>
