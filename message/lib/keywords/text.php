<?php
require_once("SplitWords.php");
require_once("dictionary.php");

$split = new SplitWords();
$okWord = "决";
$split->dic = $dic;
$split->MaxLen = 3;
$split->MinLen = 2;
// $split->MatchMaxFirst = false;
$a = $split->split($okWord);
echo "the return is :<br>";
print_r($a);

?>