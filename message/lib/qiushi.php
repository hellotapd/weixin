<?php 

class Qiushi {
	var $url = "http://feed.feedsky.com/qiushi";
	var $content = null;
	function __construct(){
		$this->get_top10();
	}

	function get_top10() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($ch);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		if( $curl_errno ) {
			//error 计log
			$this->content = $this->get_default_content();
			return false;
		}

		$pattern = "@&lt;p&gt;([\s]+)([^\t]+)&lt;br/&gt;@";
		$math = array();
		preg_match_all($pattern,$content, $math);
		if( !empty($math[2]) ) {
			$this->content = $math[2];
		}

	}

	function get_qiushi() {
		$count = count($this->content);
		$rand = rand(0,$count-1);
		return strip_tags($this->content[$rand])."(内容来源--糗事百科)";
	}


	function get_default_content() {
		$default_content = array(
			"就刚刚，就刚刚…长沙63路…很挤…一帅哥要下车…结果背包的拉链跟一妹纸的镂空蕾丝外套缠住了…怎么都解不开啊…解风情的司机大哥一直不停的催啊…结果他就把妹纸带下车了啊…车上的公交站台的人都在笑啊…特么的这就是缘分啊…",
	        "本人在一家幼儿园旁边开了一家蛋糕店，儿子今年刚刚入学，就在里面上小班，第一天放学回来带来一个漂亮的小萝莉，说要请她吃蛋糕，我问为什么那，儿子说，如果我请她吃蛋糕，她就做我女朋友。好小子，比老子以前强，于是我挑了一块最大最好蛋糕。第二天下午，店里面冲进来一群小萝莉，都在喊，叔叔，我是豪豪的女朋友！呃、、、、、",
	        "刚刚在一新开的面馆去吃面，。。。。割了老板娘。。。老板娘问前面一姑娘，今天吃什么绍子？那姑娘说我自己来吧，然后就端着面去舀了一大勺牛肉和肥肠。我心想，这新开的就是不一样啊，还自助的，然后老板娘问我吃什么，我也说我自己来，老板娘就说，你只能我来，她是我闺女！然后就没有然后了。。。",
	        "lz高三，男，我班班主任（女）30多岁至今未婚，我同桌是个男生叫文哥，此为背景……割了文哥的……上课时文哥管我借手机，我也没多想，就借了。手机还我之后我发现他给我班班主任发了三个字“我爱你”，这不是gc,一分钟之后，我收到了回信，“知道了，好好学习吧！”知道了……知道了……道了……了……",
	        "想起第一天把女朋友带回家，然后女朋友和五岁的妹妹玩的很好，然后妹妹偷偷的问了女朋友一句话：“我哥哥结婚时你来喝喜酒吧”",
	        "“老公，你在网上给我买条裙子吧”<br/>“要什么样的”<br/>“你感觉我穿了好看的就行”<br/>三天后，快递员打电话“你的包裹”<br/>兴冲冲的跑出去签了，打开一看，尼玛，一条围裙。。。",
	        "老公长相一般，缺乏自信。。一天在卫生间照镜子，发现头发长，手指一梳就能让头发立起来，于是捯饬几下问我:帅么？难得他问我这种问题，我赶紧答应:帅！并用真诚的眼神看着他。这货飘来一句:我就喜欢像你这样瞎眼的……",
	        "说个真事！过年一女性朋友的大黄蜂（车）在楼下停着！下楼开车时过来几个熊孩子，问姐姐姐姐你的车是大黄蜂吗？答是啊！那姐姐你让它变身呗！答姐姐的车不会变身！小孩曰：怪不得拿炮仗嘣它半天它也不变身、、",
	        "说个新鲜的。。。车子坏了，下班打车回家，因我住的地方拥堵！出租车不想去，拦了两辆都说回家吃饭，第三辆出租车又说去加气，我生气的喊：你拒载，我要投诉你！师傅急了：兄弟我真是加气，不信我带你去新客站那边加气！新客站和我住的地方方向相反！我一生气：去就去！上车了！走了两分钟，出租车司机说：兄弟，算你狠，我送你回家。。。",
	        "听来的真事，单位驻地偏远，不好打车，只好依赖黑车……是这么割吗……一日同事打黑车，倒霉催的遇见交警了，交警问司机认不认识同事，司机自信满满地说不但认识而且还有电话，不信打一个给你看，gc来了，只见同事手机上的来电显示是：黑车司机！交警默默笑了。。。。",
     	);
		return $default_content;
	}
}

?>