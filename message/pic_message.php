<?php
require_once("message.php");

class PicMessage extends Message{
	function __construct($data){
		$this->data = $data;
		$template = "<xml>
		 <ToUserName><![CDATA[%s]]></ToUserName>
		 <FromUserName><![CDATA[%s]]></FromUserName>
		 <CreateTime>%s</CreateTime>
		 <MsgType><![CDATA[%s]]></MsgType>
		 <ArticleCount>%s</ArticleCount>
		 <Articles>
		 %s
		 </Articles>
		 <FuncFlag>1</FuncFlag>
		 </xml>";
		parent::__construct($data, $template);
	}

	/**
	 * 对外接口
	 */
	function get_msg(){
		$content = $this->get_content();
		return $this->create_msg( $content );
	}

	/**
	 * 根据模板生成XML数据
	 * @param array $content : 具体的数据 array(0 =>array("title"=>"", "descript"=>"", "pic_url"=> "", "url"=>""))
	 *
	 */
	function create_msg( $content ){
		if(!$this->_valid_content($content)) {
			//  之后需要记录log
		}
		$article_count = count($content);
		$items_string = $this->_create_item($content);
		$msg_to = $this->current_user();
		$msg_from = $this->system_user();
        $time = time();
  		$msg_type = "news";
    	$result = sprintf($this->template, $msg_to, $msg_from, $time, $msg_type, $article_count, $items_string);
    	return $result;
	}

	/**
	 * 根据内容生成item 内容 生成XML
	 * @param array $content : 具体的数据 array(0 =>array("title"=>"", "descript"=>"", "pic_url"=> "", "url"=>""))
	 * @return xml $items_string : 生成XML
	 *
	 */
	function _create_item($content) {
		$item_template = "<item>
		 <Title><![CDATA[%s]]></Title> 
		 <Description><![CDATA[%s]]></Description>
		 <PicUrl><![CDATA[%s]]></PicUrl>
		 <Url><![CDATA[%s]]></Url>
		 </item>
		 ";
 		$items_string = "";
 		foreach ($content as $key => $value) {
 			$title = $value['title'];
 			$descript = $value['descript'];
 			$pic_url = $value['pic_url'];
 			$url = $value['url'];
 			$item = sprintf($item_template, $title, $descript, $pic_url, $url);
 			$items_string .= $item;
 		}
 		return $items_string;
	}

	/**
	 * 验证要生成item的数据 是否合法
	 */
	function _valid_content($content ) {
		if( !is_array($content) ){
			return false;
		}
		foreach ($content as $key => $value) {
			$ret1 = isset($value['title']) && isset($value['descript']);
			$ret2 = isset($value['pic_url']) && isset($value['url']);
			if( !$ret1 || !$ret2) {
				//  之后需要记录log
				return false;
			}
		}
		return true;
	}
		
	

	#======need children class do something here====

	/**
	 * 生成数据内容 ===========需要子类去继承实现该方法
	 * @return array $content : 具体的数据  array(0=>array("title"=>"", "descript"=>"", "pic_url"=> "", "url"=>""))
	 *
	 */
	function get_content(){}


}

?>