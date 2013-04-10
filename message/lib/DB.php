<?php

/**
 * 数据库操作的工具类
 * @author ruirayli
 */

class DB extends PDO{

	static private $db_instance = null;



	/**
 	  * todo: 配置PDO的数据源
      * @author ruirayli
      */
	public function __construct($dsn, $user_name, $password){ 
		parent::__construct($dsn, $user_name, $password);		
	}

	private function __clone(){}

	/**
 	  * 获取单例
      * @author ruirayli
      */
	static public function instance(){
		if(!(self::$db_instance instanceof DB)){
			$ini_array = parse_ini_file("db.ini");

			print_r($ini_array);

			$dsn = 'mysql:host=localhost;dbname=test';
			try{
				if(!isset($ini_array['host']) || !isset($ini_array['database']) || !isset($ini_array['username ']) || !isset($ini_array['password'])){
					throw new Exception("Error Processing Request", 1);					
				}
				$dsn = 'mysql:host=localhost;dbname=test';
				self::$db_instance = new DB($dsn, 'root', '^root@ifxoxO');
			}catch(PDOException $err){
				var_dump($err->getMessage());				
			}			
		}
		return self::$db_instance;
	}
}