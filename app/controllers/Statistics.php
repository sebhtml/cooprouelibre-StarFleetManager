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

		$numberOfBikes=count($bikes);
		$numberOfMembers=count($members);
		$numberOfLoans=count($loanList);

		// compute loan length
	
		$sum=0;

		$loansPerDay=array();

		foreach($loanList as $object){
			$seconds=$object->getSeconds();

			$sum+=$seconds;

			$bits=explode(" ",$object->getAttribute("startingDate"));
			$day=$bits[0];

			if(!array_key_exists($day,$loansPerDay)){
				$loansPerDay[$day]=0;
			}
			
			$loansPerDay[$day]++;
		}

		$days=count($loansPerDay);

		$bikeHours=sprintf("%.2f",$sum/(60*60));

		$left=0;

		if($numberOfLoans > 0){
			$left=(int)($sum/$numberOfLoans);
		}

/*
		$hours=(int)($left/(60*60));
		$left=$hours%(60*60);
		$minutes=$left/(60);
		$left=$left%60;
		$seconds=$left;
		$meanLoanLength=$hours." heures, ".$minutes." minutes, ".$seconds." secondes";
*/
		$meanLoanLength=sprintf("%.2f",$left/(60*60));

		$meanNumberOfLoansPerDay=0;

		if($days > 0){
			$meanNumberOfLoansPerDay=sprintf("%.2f",$numberOfLoans/$days);
		}

		$meanNumberOfLoansPerBike=0;

		if($numberOfBikes>0){
			$meanNumberOfLoansPerBike=sprintf("%.2f",$numberOfLoans/$numberOfBikes);
		}

		$meanNumberOfLoansPerMember=0;

		if($numberOfMembers>0){
			$meanNumberOfLoansPerMember=sprintf("%.2f",$numberOfLoans/$numberOfMembers);
		}

		$meanNumberOfLoansPerWeek=0;

		if($days>0){
			$meanNumberOfLoansPerWeek=sprintf("%.2f",$numberOfLoans*7/$days);
		}

		$men=0;
		$women=0;

		foreach($members as $object){
			$sex=$object->getAttribute("sex");

			if($sex=='M'){
				$men++;
			}elseif($sex=='F'){
				$women++;
			}
		}

		$all=$men+$women;

		$manRatio=0;

		if($all>0){
			$manRatio=sprintf("%.2f",100.0*$men/$all);
		}

		$womanRatio=0;

		if($all>0){
			$womanRatio=sprintf("%.2f",100.0*$women/$all);
		}

		$theKeys=array_keys($loansPerDay);


		$maximumLoansForADay=0;

		foreach($theKeys as $object){

			$count=$loansPerDay[$object];

			if($count>$maximumLoansForADay){
				$maximumLoansForADay=$count;
			}
		}

		$loansForMember=array();

		$maximumLoansForAMember=0;

		$manLoans=0;
		$womanLoans=0;

		foreach($members as $item){

			$sex=$item->getAttribute("sex");


			$loans=$place->getLoansForMemberAndPeriod($item,$start,$end);

			$loansForMember[$item->getId()]=$loans;
			$count=count($loans);

			if($count> $maximumLoansForAMember){
				$maximumLoansForAMember=$count;
			}

			if($sex=='M'){
				$manLoans+=$count;
			}elseif($sex=='F'){
				$womanLoans+=$count;
			}

		
		}

		$womanLoanRatio=0;
		$manLoanRatio=0;
		$all=$manLoans+$womanLoans;

		if($all>0){
			$womanLoanRatio=sprintf("%.2f",$womanLoans/$all*100);
			$manLoanRatio=sprintf("%.2f",$manLoans/$all*100);
		}
		
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
