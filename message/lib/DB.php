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
			try{
				if(!isset($ini_array['host']) || !isset($ini_array['database']) || !isset($ini_array['username']) || !isset($ini_array['password'])){
					throw new Exception("配置文件配置项缺失", 1);					
				}
				$dsn = "mysql:host=" . $ini_array['host'] . ";dbname=" . $ini_array['database'];
				self::$db_instance = new DB($dsn, $ini_array['username'], $ini_array['password']);
			}catch(PDOException $err){
				var_dump($err->getMessage());	 			
			}			
		}
		return self::$db_instance;
	}
}