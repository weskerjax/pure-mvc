<?php

class CategoryDao {
	
	public static $dbh = null;
	

	/*============================================================*/

	public static function getList() {
		return self::$dbh->query("
			SELECT * FROM category ORDER BY id ASC 
		")->fetchAll();
	}

	
	public static function getData($id) {
		$stmt = self::$dbh->prepare("SELECT * FROM category WHERE id = :id");
		$stmt->execute(array('id'=>$id));
		return $stmt->fetch();
	}
	
	
	public static function setData($vars) {
		$bind = array(
			'name' 		=> $vars['name'],
			'remark'    => $vars['remark'],
			'modify_date' => date('Y-m-d H:i:s'),
		);
		
		if($vars['id']){
			$bind['id'] = $vars['id'];
			self::$dbh->prepare("
				UPDATE category 
				SET name = :name, remark = :remark, modify_date = :modify_date  
				WHERE id = :id
			")->execute($bind);
			
			return $bind['id']; 
		}
		else{
			self::$dbh->prepare("
				INSERT INTO category (name, remark, entry_date, modify_date) 
				             VALUES(:name, :remark, :modify_date, :modify_date)
			")->execute($bind);
			
			return self::$dbh->lastInsertId(); 
		}		
	}


	public static function removeData($id) {
		self::$dbh->prepare("
			DELETE FROM category WHERE id = :id
		")->execute(array('id'=>$id));
	}
	
	
 
}

