<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

error_reporting(E_ALL);

include("app/configuration.php");
include("app/controllers/Dashboard.php");

class ComputeCore{

	private $m_registeredControllers;

	private $m_databaseHost;
	private $m_databaseUsername;
	private $m_databasePassword;
	private $m_tablePrefix;

	private $m_databaseConnection;

	private function checkDatabase(){
		$this->m_databaseConnection=mysql_pconnect($this->m_databaseHost,$this->m_databaseUsername,$this->m_databasePassword);

		$result=mysql_query("show tables from ".$this->m_databaseName,$this->m_databaseConnection);

		while($row=mysql_fetch_assoc($result)){

		}
	}

	private function getControllerObject($controller){
	
		if(!array_key_exists($controller,$this->m_registeredControllers)){
			echo "Controller is not registered.";
		}

		return $this->m_registeredControllers[$controller];
	}

	public function __construct($engine,$host,$database,$username,$password,$prefix){
		$this->m_registeredControllers==array();
		$this->m_tablePrefix=$prefix;
		$this->m_databaseUsername=$username;
		$this->m_databasePassword=$password;
		$this->m_databaseHost=$host;
		$this->m_databaseName=$database;
	}

	public function registerController($controller,$controllerObject){

		$this->m_registeredControllers[$controller]=$controllerObject;
	}
	
	public function registerPlugin($plugin){
		$plugin->registerPlugin($this);
	}

	public function call($getData,$postData,$sessionData){

		$this->checkDatabase();

		$controller="Dashboard";
		$action="View";
		
		if(array_key_exists("Controller",$getData)){
			$controller=$getData["Controller"];
		}

		if(array_key_exists("Action",$getData)){
			$action=$getData["Action"];
		}

		$controllerObject=$this->getControllerObject($controller);
		$controllerObject->call($action);
	}
}

session_start();

$core= new ComputeCore($CONFIG_DATABASE_SOFTWARE,$CONFIG_DATABASE_HOSTNAME,
	$CONFIG_DATABASE_NAME,$CONFIG_DATABASE_USERNAME,$CONFIG_DATABASE_PASSWORD,$CONFIG_DATABASE_TABLE_PREFIX);
$dashboard=new DashBoard();
$core->registerPlugin($dashboard);

$core->call($_GET,$_POST,$_SESSION);


?>
