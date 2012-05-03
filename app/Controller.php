<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Controller{
	public function getView($controller,$action){
		$action=str_replace("$controller::call_","",$action);

		return "app/views/$controller/$action.php";
	}

	public function renderFormElement($field,$fieldName,$type){
		if($type=="varchar(255)" || $type=="date" || $type="char(1)"){
			$this->addTextField($fieldName,$field);
		}
	}

	public function printArrayAsTable($rows,$columnNames){

		if(count($rows)==0){
			return;
		}

		$keys=array_keys($rows[0]);


		echo "<table><caption></caption><tbody>";
	
		echo "<tr>";
		foreach($keys as $i){
			echo "<th class=\"tableHeaderCell\">";
			$name=$i;
			if(array_key_exists($i,$columnNames)){
				$name=$columnNames[$i];
			}

			echo $name;
			echo "</th>";
		}
		echo "</tr>";

		foreach($rows as $row){
	
			echo "<tr>";
			foreach($keys as $key){
				$value=$row[$key];
				
				echo "<td class=\"tableContentCell\">$value</td>";
			}
			echo "</tr>";
		}

		echo "</tbody></table>";
	}

	public function startForm($action){
		$method="post";

		echo("<form method=\"$method\" action=\"$action\">");
		echo("<table><tbody>");
	}

	public function renderYesNoSelector($name){

		echo "<select name=\"$name\" class=\"tableContentCell\"><option class=\"tableContentCell\" value=\"1\">Oui</option><option class=\"tableContentCell\" value=\"0\">Non</option</select>";
	}

	public function renderTimeSelector($name,$first,$last){

		echo "<select name=\"$name\" class=\"tableContentCell\">";

		for($i=$first;$i<$last;$i++){
			echo "<option value=\"$i:00\">$i:00</option>";
			echo "<option value=\"$i:30\">$i:30</option>";
		}

		echo "</select>";
	}

	public function endForm(){
		echo("<tr><td></td><td><div class=\"button\"><a class=\"buttonLink\" href=\"#\" onclick=\"document.forms[0].submit();\">Soumettre</a></td></tr>");
		echo("</tbody></table></form>");
	}

	public function addTextField($description,$name){
		echo("<tr><td   class=\"tableContentCell\">$description</td><td>");
		echo("<input  class=\"tableContentCell\" type=\"text\" name=\"$name\"></td></tr>");
	}

	public function addPasswordField($description,$name){
		echo("<tr><td  class=\"tableContentCell\" >$description</td><td>");
		echo("<input  class=\"tableContentCell\" type=\"password\" name=\"$name\"></td></tr>");
	}

	public function renderFormForModel($core,$model){
		$tableName=($core->getTablePrefix()).$model;

		$finder=new $model();
		$names=$finder->getFieldNames();

		$attributes=$finder->getPersistentAttributesForTable($core,$tableName);


		if(count($attributes)==0){
			return;
		}

		$keys=array_keys($attributes[0]);



		foreach($attributes as $row){
	
			$field=$row['Field'];
			$type=$row['Type'];

			if($field=='id'){
				continue;
			}

			$fieldName=$field;
			if(array_key_exists($field,$names)){
				$fieldName=$names[$field];
			}

			//echo "Field= $field";

			if($finder->isSelectField($field)){
				
				$list=$finder->getSelectOptions($core,$field);

/*
				echo "Is select. =$field=";
				echo get_class($finder);
				print_r($list);
*/
				
				$this->renderSelector($field,$fieldName,$list);

			}elseif($finder->isFilledField($field)){
				
				$value=$finder->getFilledValue($core,$field);

				echo "<tr><td class=\"tableContentCell\">$fieldName</td><td class=\"tableContentCellFilled\">{$value[1]}";
				echo "<input type=\"hidden\" name=\"$field\" value=\"$value[0]\" />";
				echo "</td></tr>";

			}else{
				$this->renderFormElement($field,$fieldName,$type);
			}
		}


	}

	public function renderSelector($field,$fieldName,$list){
		echo "<tr><td class=\"tableContentCell\">$fieldName</td><td>";

		echo "<select name=\"$field\"   class=\"tableContentCell\">";

		$keys=array_keys($list);
		foreach($keys as $key){
			$description=$list[$key];

			echo "<option  class=\"tableContentCell\"  value=\"$key\">$description</option>";
		}

		echo "</select></td></tr>";
	}

	public function printRowAsTable($row,$columnNames){

		$keys=array_keys($row);

		echo "<table><caption></caption><tbody>";
	
		foreach($keys as $key){
			echo "<tr>";
			$value=$row[$key];

			$name=$key;
			if(array_key_exists($key,$columnNames)){
				$name=$columnNames[$key];
			}
		
			echo "<td class=\"tableContentCell\">$name</td>";
			echo "<td class=\"tableContentCell\">$value</td>";
			echo "</tr>";
		}

		echo "</tbody></table>";
	}
}

?>
