<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3



class Core{

	private $m_SESSION;
	private $m_GET;
	private $m_POST;

	private $m_pageTitle;
	private $m_registeredControllers;

	private $m_databaseHost;
	private $m_databaseUsername;
	private $m_databasePassword;
	private $m_tablePrefix;
	private $m_databaseName;

	private $m_databaseConnection;

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

	private function getPageContent(){
		return $this->m_pageContent;
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

	public function registerController($controller,$controllerObject){

		$this->m_registeredControllers[$controller]=$controllerObject;
	}

	public function setPageTitle($title){
		$this->m_pageTitle=$title;
	}

	public function setPageContent($content){
		$this->m_pageContent=$content;
	}

	public function setGET($content){
		$this->m_GET=$content;
	}

	public function setPOST($content){
		$this->m_POST=$content;
	}

	public function setSESSION($content){
		$this->m_SESSION=$content;
	}

	public function startForm($action,$method){
		echo("<form method=\"$method\" action=\"$action\">");
		echo("<table><tbody>");
	}

	public function endForm(){
		echo("<tr><td></td><td><input type=\"submit\" name=\"submit\" value=\"Soumettre\"></td></tr>");
		echo("</tbody></table></form>");
	}

	public function addTextField($description,$name){
		echo("<tr><td>$description</td><td>");
		echo("<input type=\"text\" name=\"$name\"></td></tr>");
	}

	public function addPasswordField($description,$name){
		echo("<tr><td>$description</td><td>");
		echo("<input type=\"password\" name=\"$name\"></td></tr>");
	}

	public function getGETObject(){
		return $this->m_GET;
	}
	public function getPOSTObject(){
		return $this->m_POST;
	}
	public function getSESSIONObject(){
		return $this->m_SESSION;
	}

	public function call($getData,$postData,$sessionData){

		$this->checkDatabase();
		$this->setGET($getData);
		$this->setPOST($postData);
		$this->setSESSION($sessionData);

		$controllerName="Dashboard";
		$actionName="view";

		if(!array_key_exists("controller",$getData)){
			if(!array_key_exists("username",$sessionData)){
				$controllerName="Authentification";
				$actionName="login";
			}
		}
		
		if(array_key_exists("controller",$getData)){
			$controllerName=$getData["controller"];
		}

		if(array_key_exists("action",$getData)){
			$actionName=$getData["action"];
		}

		$controllerObject=$this->getControllerObject($controllerName);
		$methodName="call_".$actionName;


		$debug=false;

		ob_start();

		if($debug){
			echo "controller= $controllerName action= $actionName";
		}

		if(method_exists($controllerObject,$methodName)){
			$controllerObject->{$methodName}($this);
		}

		$pageTitle=$this->getPageTitle();
		$pageContent=ob_get_contents();
		ob_end_clean();

		$username=NULL;

		if(array_key_exists("username",$this->m_SESSION)){
			$username=$this->m_SESSION["username"];
		}
		
		include("app/views/Template/template.php");
	}

	public function getConnection(){
		return $this->m_databaseConnection;
	}

	public function getKey($array,$key){
		if(array_key_exists($key,$array)){
			return $array[$key];
		}
		return NULL;
	}

}

?>
