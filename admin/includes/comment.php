<?php

class Comment extends Db_object{

	protected static $db_table = 'comments';
	protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');
	protected static $primary = 'id';
	public $id;
	public $photo_id;
	public $author;
	public $body;

	public function primary(){				//TO INSERT THE VALUE OF THE PRIMARY KEY TO PARENT CLASS
		$primary = $this->id;
		return $primary;
	}

	public static function creat_comment($photo_id, $author='Doe', $body=''){
		if (!empty($photo_id) && !empty($author) && !empty($body)) {
				$comment = new Comment();

				$comment->photo_id 	= $photo_id;
				$comment->author 		= $author;
				$comment->body 		= $body;

				return $comment;
		}else{
			return false;
		}
	} //End Of Function

	public static function find_the_comment($photo_id=0){
		global $db;

		$sql = "SELECT * FROM " . self::$db_table ." WHERE photo_id = " . $photo_id . " ORDER BY photo_id ASC";
		return self::find_this_query($sql);
	} //End Of Function

	public function save_comment(){
		return $this->create();
	}
}

?>