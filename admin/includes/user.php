<?php

class User extends Db_object{

	protected static $db_table = 'users';
	protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
	protected static $primary = 'id';
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_image;
	public $type;
	public $size;
	public $tmp_path;
	public $upload_directory = 'images';
	public $image_placeholder = "http://placehold.it/200x200";

	public $errors = array();
	public $upload_errors_array = array(
		UPLOAD_ERR_OK       				 	=> "There is no errors",
		UPLOAD_ERR_FORM_SIZE     	=> "This file exceeds the MAX_FILE_SIZE",
		UPLOAD_ERR_INI_SIZE       	 	=> "This file exceeds the UPLOAF_MAX_FILE_SIZE",
		UPLOAD_ERR_PARTIAL       	 	=> "You missed a partial from this file",
		UPLOAD_ERR_NO_FILE       		=> "No file was uploded",
		UPLOAD_ERR_NO_TMP_DIR		=> "Missing a temporary folder",
		UPLOAD_ERR_CANT_WRITE      => "Faild To write file to disk",
		UPLOAD_ERR_EXTENSION        	=> "A php extension stopped the file upload",
	);



	public function image_path_and_plasceholder(){
		return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory .'/'. trim($this->user_image, ' ');
	}

	public function primary(){
		$primary = $this->id;
		return $primary;
	}
     //VERIFY ATTRIBUTE FOR USERS LOGIN
    public static function verify_user($username, $password){
    	global $db;
    	$sql = "SELECT * FROM " .  self::$db_table . " WHERE username = '{$username}' AND password = '{$password}'";
    	$result_set = self::find_this_query($sql);
    	return !empty($result_set) ? array_shift($result_set) : false;
    }	

    //UPLOAD USER IMAGE

	public function set_file($file){
 		if(empty($file)  || !$file || !is_array($file)){
 			$this->errors[] = 'There was no file uploaded here';
 			return false;
 		}elseif($file['error'] != 0){
 			$this->errors[] = $this->upload_errors_array[$file['error']];
 			return false;
 		}else{
 			$this->user_image = $file['name'];
 			$this->tmp_path = $file['tmp_name'];
 			$this->size = $file['size'];
 			$this->type = $file['type'];
 		}
 	}

 	public function save_user(){
 			if(!empty($this->errors)){
 				//return false;
 			}

 			if (empty($this->user_image) || empty($this->tmp_path)) {
 				$this->errors[] = 'The file was not avilable';
 				//return false;
 			}


 			$target_path = SITE_ROOT . '/admin/' . $this->upload_directory . '/' . $this->user_image;

 			if (file_exists($target_path)) {
 				$this->errors[] = 'The file {$this->user_image} already exists';
 				return false;
 			}

 			if (move_uploaded_file($this->tmp_path, $target_path)) {
 				if ($this->create()) {
 					unset($this->tmp_path);
 					return true;
 				}
 			}else{
 				$this->errors[] = 'The file directory probably does not have permission';
 				return false; 
 			}
 			//$this->create();
 		}

 		public function save_img_ajax($user_img, $user_id){
 			global $db;
 			$this->user_image = $user_img;
 			$this->id = $user_id;
 			$sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' WHERE id = '{$this->id}' ";
 			self::find_this_query($sql);
 			echo $this->image_path_and_plasceholder();
 		}

 		public function delete_photo(){
 		if ($this->delete()) {
 			$target_path = SITE_ROOT . '/admin/' . $this->upload_directory . '/' . $this->user_image;
 			return unlink($target_path) ? true : false;
 		}else{
 			return false;
 		}
 	}

}

?>