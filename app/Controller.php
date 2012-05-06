<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
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

	public function addYesNoSelector($description,$name){
		echo("<tr><td   class=\"tableContentCell\">$description</td><td>");

		$this->renderYesNoSelector($name);

		echo("</td></tr>");
	}

	public function renderYesNoSelector($name){
		$this->renderYesNoSelectorWithValue($name,0);
	}

	private function getSelected($value1,$value2){
		$selected="";

		if($value1==$value2){
			$selected="selected=\"selected\"";
		}

		return $selected;
	}

	public function renderYesNoSelectorWithValue($name,$value){

		echo "<select name=\"$name\" class=\"tableContentCell\">";

		$selected=$this->getSelected(1,$value);
		echo "<option class=\"tableContentCell\" value=\"1\" $selected >Oui</option>";

		$selected=$this->getSelected(0,$value);
		echo "<option class=\"tableContentCell\" value=\"0\" $selected >Non</option>";
	
		echo "</select>";
	}

	public function renderTimeSelector($name,$first,$last){
		$this->renderTimeSelectorWithValue($name,$first,$last,"");
	}

	public function renderTimeSelectorWithValue($name,$first,$last,$value){

		echo "<select name=\"$name\" class=\"tableContentCell\">";

		for($i=$first;$i<$last;$i++){
			for($j=0;$j<60;$j+=30){

				$minutes=$j;
				if($j==0){
					$minutes="00";
				}

				$current="$i:$minutes:00";
				if(strlen($current)!=8){
					$current="0$current";
				}

				$selected=$this->getSelected($value,$current);
				echo "<option value=\"$i:$minutes\" $selected >$i:$minutes</option>";
			}

		}

		echo "</select>";
	}

	public function endForm(){
		echo("<tr><td></td><td><div class=\"button\"><a class=\"buttonLink\" href=\"#\" onclick=\"document.forms[0].submit();\">Soumettre</a></td></tr>");
		echo("</tbody></table></form>");
	}

	public function addTextField($description,$name){
		$this->addTextFieldWithValue($description,$name,"");
	}

	public function addTextFieldWithValue($description,$name,$value){
		echo("<tr><td   class=\"tableContentCell\">$description</td><td>");
		echo("<input  class=\"tableContentCell\" type=\"text\" name=\"$name\" value=\"$value\"></td></tr>");
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

				$this->renderHiddenFieldWithValue($field,$fieldName,$value[1],$value[0]);
			}else{
				$this->renderFormElement($field,$fieldName,$type);
			}
		}


	}

	public function renderHiddenFieldWithValue($field,$fieldName,$visibleValue,$hiddenValue){
		echo "<tr><td class=\"tableContentCell\">$fieldName</td><td class=\"tableContentCellFilled\">$visibleValue";
		echo "<input type=\"hidden\" name=\"$field\" value=\"$hiddenValue\" />";
		echo "</td></tr>";

	}

	public function renderSelector($field,$fieldName,$list){
		echo "<tr><td class=\"tableContentCell\" >$fieldName</td><td   class=\"tableContentCell\">";

		echo "<select name=\"$field\"   class=\"tableContentCell\">";

		$keys=array_keys($list);
		foreach($keys as $key){
			$description=$list[$key];

			echo "<option  class=\"tableContentCell\"  value=\"$key\">$description</option>";
		}

		echo "</select></td></tr>";
	}

	public function printRowAsTable($object){

		$row=$object->getAttributes();
		$columnNames=$object->getFieldNames();

		$keys=array_keys($row);

		echo "<table><caption></caption><tbody>";
	
		foreach($keys as $key){
			$value=$row[$key];

			if($object->mustSkipAttribute($key)){
				continue;
			}

			$name=$key;
			if(array_key_exists($key,$columnNames)){
				$name=$columnNames[$key];
			}
		
			echo "<tr>";
			echo "<td class=\"tableContentCell\">$name</td>";

			echo  "<td class=\"tableContentCell\">";

			if($object->isLinkedAttribute($key)){
				echo $object->getAttributeLink($key);
			}else{
				echo $value;
			}

			echo "</td>";

			echo "</tr>";
		}

		echo "</tbody></table>";
	}

}

?>
