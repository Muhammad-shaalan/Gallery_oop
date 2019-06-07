<?php

class Photo extends Db_object{

	protected static $db_table = 'photos';
	protected static $db_table_fields = array('photo_id', 'title', 'description', 'filename', 'type', 'size', 'caption', 'alternate_text');
	protected static $primary = 'photo_id';			//TO USE IT IN THE PARENT CLASS
	public $photo_id;
	public $title;
	public $description;
	public $filename;
	public $type;
	public $size;
	public $caption;
	public $alternate_text;

	public function primary(){				//TO INSERT THE VALUE OF THE PRIMARY KEY TO PARENT CLASS
		$primary = $this->photo_id;
		return $primary;
	}

	//PART OF UPLOADED PHOTOS
	public $tmp_path;
	public $upload_directory = 'images';

	public function picture_path(){
		return $this->upload_directory .'/'. trim($this->filename, ' ');
	}

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

 	public function set_file($file){
 		if(empty($file)  || !$file || !is_array($file)){
 			$this->errors[] = 'There was no file uploaded here';
 			return false;
 		}elseif($file['error'] != 0){
 			$this->errors[] = $this->upload_errors_array[$file['error']];
 			return false;
 		}else{
 			$this->filename = $file['name'];
 			$this->tmp_path = $file['tmp_name'];
 			$this->size = $file['size'];
 			$this->type = $file['type'];
 		}
 	}

 	public function save(){
 		if ($this->photo_id) {
 			$this->update();
 		}else{
 			if(!empty($this->errors)){
 				return false;
 			}

 			if (empty($this->filename) || empty($this->tmp_path)) {
 				$this->errors[] = 'The file was not avilable';
 				return false;
 			}

 			$target_path = SITE_ROOT . '/admin/' . $this->upload_directory . '/' . $this->filename;

 			if (file_exists($target_path)) {
 				$this->errors[] = 'The file {$this->filename} already exists';
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
 		}
 	}

 	public function delete_photo(){
 		if ($this->delete()) {
 			$target_path = SITE_ROOT . '/admin/' . $this->picture_path();
 			return unlink($target_path) ? true : false;
 		}else{
 			return false;
 		}
 	}

 	public static function display_sidebar_data($photo_id){
 		$photo = Photo::find_by_id($photo_id);
 		$output = "<a class='text-center d-block'><img width='100' src='{$photo->picture_path()}'></a>";
 		$output .= "<p class='text-center'>{$photo->filename}</p>";
 		$output .= "<p class='text-center'>Type: {$photo->type}</p>";
 		$output .= "<p class='text-center'>Size: {$photo->size}</p>";
 		echo $output;
 	}

}			//END OF CLASS

?>
