<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3


class Result{

	private $m_result;

	public function __construct($result){

		//echo "Building result with $result<br />";

		if(!$result){
			//echo "result is false<br />";
		}

		$this->m_result=$result;
	}

	public function getRow(){
		if(!$this->m_result){
			return false;
		}

		return mysql_fetch_assoc($this->m_result);
	}
	
	public function getRows(){
		$output=array();

		while($row=$this->getRow()){
			//echo "Got 1 row";
			array_push($output,$row);
		}

		return $output;
	}
}

class Driver{

	private $m_connection;

	public function connect($host,$user,$password,$database){
		$this->m_connection=mysql_pconnect($host,$user,$password);

		if($this->m_connection==false){
			echo "An error occured while connecting to the database.<br />";
		}else{
			//echo "Connected.<br />";
		}

		mysql_select_db($database,$this->m_connection);
	}

	public function query($query){
		//echo "Query: $query<br />";

		if(!$this->m_connection){
			echo "Invalid connection<br />";
		}

		$result=mysql_query($query,$this->m_connection);

/*
		if(!$result){
			//echo mysql_error();
			//echo "Is already false.<br />";
		}
*/

		return new Result($result);
	}
}


?>
