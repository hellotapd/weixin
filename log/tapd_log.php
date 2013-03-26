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

	private $path_of_log_file = 'log/tapd.log';

	private $limited_of_log_file = 1099511627776;

	/**
 	  * todo: 日志文件若不存在，创建；若超过文件大小限制，归档并创建
      * @author ruirayli
      */
	private function __construct(){ 
			// trigger_error("A custom error has been triggered");
		$size = filesize($this->path_of_log_file);

		echo $size . "<br>";
		$fh = fopen($this->path_of_log_file,"a+");  			
		if(filesize($this->path_of_log_file) > $this->limited_of_log_file){
			fclose($fh);
			rename($this->path_of_log_file, $this->path_of_log_file . '_' . date('Ymd'));
		}else{
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

	public function write_log($content, $level = 0){		
		$format_content = $this->_format_log_content($content, $level);
		file_put_contents($this->path_of_log_file, $format_content, FILE_APPEND);
	}

	private function _format_log_content($content, $level){
		$trace = debug_backtrace(false);
		$LF = (DIRECTORY_SEPARATOR=='\\') ? "\r\n" : '\n';
		var_dump($trace );
		if(isset($trace[0]['file']) && isset($trace[0]['line'])){
			$file = $trace[0]['file'];
			$line = $trace[0]['line'];
			return date('Ymd H:i:s') . " Level:$level " .  " File:$file Line:$line " . $content . $LF;
		}else{
			return date('Ymd H:i:s') . " Level:$level " . $content . $LF;
		}
	}
}