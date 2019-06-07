<?php

class Db_object{
	protected static $primary;
	
	//GET ALL USERS
	public static function find_all(){
		$result_set = static::find_this_query(" SELECT * FROM  " . static::$db_table);
		return $result_set;
	}

	//GET USER BY ID
	public static function find_by_id($id){
	 	global $db;
    	$result_set = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE " . static::$primary  . " = " . $id);
    	return !empty($result_set) ? array_shift($result_set) : false;
    }

    //EXECUTE ALL QUERIES
	public static function find_this_query($sql){
		global $db;
		$result_set = $db->query($sql);
		$result_set->execute(array());
		$the_object_array = array();
		while($row = $result_set->fetch(PDO::FETCH_ASSOC)){
		 	$the_object_array[ ] = static::instantation($row);
		}
		
		return $the_object_array;
	}

	public static function instantation($the_record){
		$calling_class = get_called_class();
		$the_object = new $calling_class;
		foreach ($the_record as $the_attribute  => $value) {
					if($the_object->has_the_attribute($the_attribute)){
						$the_object->$the_attribute = $value;
					}
			
		}
		return $the_object;

	}

	private function has_the_attribute($the_attribute){
		$obj_propertise = get_object_vars($this);
		return array_key_exists($the_attribute, $obj_propertise);
	}

	//ARRAY FOR FIELDS OF DATABASE
	public function properties(){
		$properties = array();

		foreach (static::$db_table_fields as $db_field) {
			if(property_exists($this, $db_field)){
				$properties[$db_field] = $this->$db_field;
			}
		}
		return $properties;
	}

	//INSERT TO DATABSE
	public function create(){
		global $db;
		$properties = $this->properties();

		$sql = "INSERT INTO  " .  static::$db_table . " ( " . implode(",", array_keys($properties)) . ") VALUES('";
		$sql .= implode("','", array_values($properties)) . " ' )";
		if($db->query($sql)){
			$result_set = $db->query($sql);
			$result_set->execute(array());
			return true;
		}else{
			echo "No It Is Error";
			return false;
		}
	}

	//UPDATE FUNCTION
	public function update(){
		global $db;
		$properties = $this->properties();

		$properties_pairs = array();
		foreach ($properties as $key => $value) {
			$properties_pairs[] = "{$key} = '{$value}' "; 
		}
		$sql = "UPDATE  " .  static::$db_table . "  SET ";
		$sql .= implode(",", $properties_pairs)  . "  WHERE " . static::$primary . " = " . $this->primary() . " LIMIT 1";
		if($db->query($sql)){
			$result_set = $db->query($sql);
			$result_set->execute(array());
			return true;
		}else{
			echo "No It Is Error";
			return false;
		}
	}

	//CREATE AND UPDATE FUNCTION
	public function save(){
		return isset(static::$primary) ? $this->update() : $this->create();
	}

	//DELETE FUNCTION
	public function delete(){
		global $db;
		$sql = "DELETE FROM  " .  static::$db_table . "  Where " . static::$primary . " = " . $this->primary() . " LIMIT 1";

		if($db->query($sql)){
			$result_set = $db->query($sql);
			$result_set->execute(array());
			return true;
		}else{
			echo "No It Is Error";
			return false;
		}
	}

	public static function count_all(){
		global $db;
		$sql = "SELECT COUNT(*) FROM " . static::$db_table;
		$result_set = $db->query($sql);
		$result_set->execute(array());
		$row = $result_set->fetch(PDO::FETCH_ASSOC);
		return array_shift($row);
	}

}

?>