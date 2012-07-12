<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


class Result{

	private $m_result;
	private $m_driver;

	public function __construct($result,$driver){

		//echo "Building result with $result<br />";

		if(!$result){
			//echo "result is false<br />";
		}

		$this->m_result=$result;
		$this->m_driver=$driver;
	}

	public function getRow(){
		if(!$this->m_result){
			return false;
		}

		$this->m_driver->addRow();

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
	private $m_queries;
	private $m_rows;

	public function connect($host,$user,$password,$database){
		$this->m_connection=mysql_pconnect($host,$user,$password);

		if($this->m_connection==false){
			echo "An error occured while connecting to the database.<br />";
		}else{
			//echo "Connected.<br />";
		}

		mysql_select_db($database,$this->m_connection);
		
		$this->m_rows=0;
		$this->m_queries=0;
	}

	public function query($query){
		//echo "Query: $query<br />";

		if(!$this->m_connection){
			echo "Invalid connection<br />";
		}

		$result=mysql_query($query,$this->m_connection);

		if(!$result){
			echo "<div class=\"error\">";
			echo "<b>MySQL error</b><br /><br />";
			echo mysql_error();
		
			echo "<br /><br />";
			echo "<b>SQL query</b><br /><br />";

			echo $query;
			echo "</div>";
		}

		$this->m_queries++;

		return new Result($result,$this);
	}

	public function getInsertedIdentifier(){
		return mysql_insert_id($this->m_connection);
	}

	public function escapeString($string){
		return mysql_real_escape_string($string);
	}

	public function addRow(){
		$this->m_rows++;
	}

	public function getFetchedRows(){
		return $this->m_rows;
	}

	public function getProcessedSQLQueries(){
		return $this->m_queries;
	}
}


?>
