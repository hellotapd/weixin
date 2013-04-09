<?php
require_once("SplitWords.php");

$split = new SplitWords();
$okWord = "切分技术参考指定and++两边重点讲解,今天天气怎么样？";
  echo "开始<br>";
  //echo "粗分词结果：".$split->UpdateStr($okWord)."<br>";
  //$myWord = $split->UpdateStr($okWord);
  //echo "提取关键词 SplitRMM：".$split->SplitRMM($myWord)."<br>";
  echo "Run RMM :".$split->RunRMM($okWord);
  $a = $split->RunRMM($okWord);
  var_dump($a);
?>
