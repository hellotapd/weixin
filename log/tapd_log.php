<?php

/**
 * 日志操作的工具类
 * @author ruirayli
 */

class TapdLog{

	static private $log_instance = null;

	// log级别：info, 用于记录所有的显示信息
	static public $INFO = 0;

	// log级别：debug, 用于记录所有的调试信息
	static public $DEBUG = 1;

	// log级别：warn, 用于记录所有的非正常预期结果，定位错误
	static public $WARN = 2;

	// log级别：error, 用于记录所有的异常情况
	static public $ERROR = 3;

	private $log_file = null;

	private $path_of_log_file = 'tapd.log';

	private $limited_of_log_file = 100;

	private function __construct(){
		if(!file_exists($path_of_log_file)){
			// trigger_error("A custom error has been triggered");
			$fh = fopen($path_of_log_file,"rw");
    		fclose($fh);
		}
	}

	private function __clone(){}

	/**
 	  * 获取单例
      * @author ruirayli
      */
	static public function instance(){
		if(!(self::$log_instance instanceof TapdLog)){
			self::$log_instance = new TapdLog();
		}
		return self::$log_instance;
	}

	public function write_log(){

	}




}