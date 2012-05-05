<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3



class Core{

	private $m_getData;
	private $m_postData;

	private $m_debug;

	private $m_pageTitle;
	private $m_pageContent;

	private $m_registeredControllers;
	private $m_securedControllers;

	private $m_databaseHost;
	private $m_databaseUsername;
	private $m_databasePassword;
	private $m_tablePrefix;
	private $m_databaseName;

	private $m_databaseConnection;

	private $m_controllerName;
	private $m_actionName;

	private function getPageContent(){
		return $this->m_pageContent;
	}

	private function canAccess($controllerName,$actionName){
		$answer=false;
		if(!array_key_exists($controllerName,$this->m_securedControllers)){
			$answer=true;
		}else{
			$answer=array_key_exists("username",$_SESSION);
		}

		if(!$answer && $this->m_debug){
			echo "Access denied for controller $controllerName<br />";
		}

		return $answer;
	}

	private function checkDatabase(){
		$this->m_databaseConnection=new Driver();
		$this->m_databaseConnection->connect($this->m_databaseHost,$this->m_databaseUsername,$this->m_databasePassword,
			$this->m_databaseName);

/*
		$result=$this->m_databaseConnection->query("show tables from ".$this->m_databaseName);

		while($row=$result->getRow()){
		}
*/
	}

	private function getPageTitle(){
		return $this->m_pageTitle;
	}


	private function getControllerObject($controller){
	
		if(!array_key_exists($controller,$this->m_registeredControllers)){
			echo "Controller is not registered.";

			return NULL;
		}

		return $this->m_registeredControllers[$controller];
	}

	public function getTablePrefix(){
		return $this->m_tablePrefix;
	}

	public function __construct($engine,$host,$database,$username,$password,$prefix){
		$this->m_registeredControllers==array();
		$this->m_tablePrefix=$prefix;
		$this->m_databaseUsername=$username;
		$this->m_databasePassword=$password;
		$this->m_databaseHost=$host;
		$this->m_databaseName=$database;
	}

	public function registerController($object){
		$object->registerController($this);
	}

	public function registerControllerName($controller,$controllerObject){

		$this->m_registeredControllers[$controller]=$controllerObject;
	}

	public function setPageTitle($title){
		$this->m_pageTitle=$title;
	}

	public function setPageContent($content){
		$this->m_pageContent=$content;
	}

	public function call(){
	

		$this->m_debug=false;

		$this->checkDatabase();

		$this->m_controllerName="Dashboard";
		$this->m_actionName="view";

		if(!array_key_exists("controller",$this->m_getData)){
			if(!array_key_exists("username",$_SESSION)){
				$this->m_controllerName="Authentification";
				$this->m_actionName="login";
			}
		}
		
		if(array_key_exists("controller",$this->m_getData)){
			$this->m_controllerName=$this->m_getData["controller"];
		}

		if(array_key_exists("action",$this->m_getData)){
			$this->m_actionName=$this->m_getData["action"];
		}

		$this->callController($this->m_controllerName,$this->m_actionName);

		$pageTitle=$this->getPageTitle();
		$pageContent=$this->getPageContent();

		$username=NULL;
		$identifier=NULL;

		if(array_key_exists("username",$_SESSION)){
			$username=$_SESSION["username"];
			$identifier=$_SESSION["identifier"];
		}
		
		$core=$this;

		include("app/views/Template/template.php");
	}

	public function getConnection(){
		return $this->m_databaseConnection;
	}

	public function getKey(&$array,$key){
		if(array_key_exists($key,$array)){
			return $array[$key];
		}
		return NULL;
	}

	public function setControllerName($name){
		$this->m_controllerName=$name;
	}

	public function setActionName($name){
		$this->m_actionName=$name;
	}

	public function secureController($name){
		$this->m_securedControllers[$name]=true;
	}

	public function callController($controllerName,$actionName){

		if($this->m_debug){
			echo "callController controller= $controllerName action= $actionName<br />";
		}

		$controllerObject=$this->getControllerObject($this->m_controllerName);
		$methodName="call_".$this->m_actionName;

		ob_start();

		if($this->canAccess($controllerName,$actionName) && method_exists($controllerObject,$methodName)){
			$controllerObject->{$methodName}($this);
		}

		$this->m_pageContent=ob_get_contents();
		ob_end_clean();

	}

	public function debugMode(){
		return $this->m_debug;
	}

	public function setSessionData(&$object){
	}

	public function setGetData(&$object){
		$this->m_getData=$object;
	}

	public function setPostData(&$object){
		$this->m_postData=$object;
	}

	public function getGetData(){
		return $this->m_getData;
	}

	public function getPostData(){
		return $this->m_postData;
	}

	public function makeButton($link,$text){
		echo "<div class=\"button\"><a class=\"buttonLink\"  href=\"$link\">$text</a></div>";
	}

	public function getDatabaseName(){
		return $this->m_databaseName;
	}
	
	public function getCurrentTime(){
		return date("Y-m-d H:i:s");
	}
}

?>
