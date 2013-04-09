<?php
class SplitWords{
 var $TagDic = Array();
 var $RankDic = Array();
 var $SourceStr = '';
 var $ResultStr = '';
 var $SplitChar = ' '; //
 var $SplitLen = 4;  //.....
 var $MaxLen = 7;  //.......................
 var $MinLen = 3;  //.....................

  function SplitWord(){
   $this->__construct();
  }
  
  function __construct(){      
   //..................
   $dicfile = dirname(__FILE__)."/ppldic.csv"; 
   $fp = fopen($dicfile,'r');   //.......
   while($line = fgets($fp,256)){
      $ws = explode(' ',$line);  //..........
      $this->TagDic[$ws[0]] = $ws[1];
      $this->RankDic[strlen($ws[0])][$ws[0]] = $ws[2];
   }
   fclose($fp);  //......
  }
  
  //....
 function Clear(){
   @fclose($this->QuickDic);
  }
  
  //......
  function SetSource($str){
   $this->SourceStr = $this->UpdateStr($str);
   $this->ResultStr = "";
  }
  
  //............
  function NotGBK($str)
  {
    if($str=="") return "";
   if( ord($str[0])>0x80 ) return false;
   else return true;
  }

  //......
  function SplitRMM($str=""){
   if($str!="") $this->SetSource($str);
   if($this->SourceStr=="") return "";
   $this->SourceStr = $this->UpdateStr($this->SourceStr);
   $spwords = explode(" ",$this->SourceStr);
   $spLen = count($spwords);
   $spc = $this->SplitChar;
   for($i=($spLen-1);$i>=0;$i--){
    if($spwords[$i]=="") continue;
    if($this->NotGBK($spwords[$i])){
  	if(ereg("[^0-9\.\+\-]",$spwords[$i]))
  	{ $this->ResultStr = $spwords[$i].$spc.".".$this->ResultStr; 
  	}
  	else
  	{
  	$nextword = "";
  	@$nextword = substr($this->ResultStr,0,strpos($this->ResultStr,""));
  	}
    }
    else
    {
      $c = $spwords[$i][0].$spwords[$i][1];
      $n = hexdec(bin2hex($c));
       if(strlen($spwords[$i]) <= $this->SplitLen)
       {
       }
       else
       {
        $this->ResultStr = $this->RunRMM($spwords[$i]).$spc.$this->ResultStr;
  	
       }
     }
   }
  // echo strlen($this->ResultStr)."<br>";
  // .............
    $this->ResultStr = substr($this->ResultStr,0,strlen($this->ResultStr)-3);
   return $this->ResultStr;
  }
  //RMM.... .................
  function RunRMM($str){
   $spLen = strlen($str);
   $rsStr = "";
   $okWord = "";
   $tmpWord = "";
   $WordArray = Array();
   
   //......
   for($i=($spLen-1);$i>=0;){
    //.i..........
    if($i<=$this->MinLen){
     if($i==1){
       $WordArray[] = substr($str,0,2);
      }else
     {
        $w = substr($str,0,$this->MinLen+1);
  	//echo "$w is :".$w."<br>";
        if($this->IsWord($w)){
         $WordArray[] = $w;                                                                                  
        }else{
         //$WordArray[] = substr($str,2,2);
         //$WordArray[] = substr($str,0,2);
        }
      }
     $i = -1; break;
    }
    //............
    if($i>=$this->MaxLen) $maxPos = $this->MaxLen;
    else $maxPos = $i;
    $isMatch = false;
  
    for($j=$maxPos;$j>=0;$j=$j-2){
      $w = substr($str,$i-$j,$j+1);
      if($this->IsWord($w)){
       $WordArray[] = $w;
       $i = $i-$j-1;
       $isMatch = true;
       break;
      }
    }
  if($isMatch == false){
  	//echo "false $i<br>";
  	$i -= 2;
  }
   }
   $rsStr = $this->otherword($WordArray);
   return explode(' ',$rsStr);
  }
  
/** ............................
**/
function otherword($WordArray){

   $wlen = count($WordArray)-1;      //.........
   //echo "$wlen<br>";
   $rsStr = $WordArray[$wlen];          //.....
   $spc = $this->SplitChar;
   for($i=$wlen-1;$i>=0;$i--)
   {
   $rsStr .= $spc.$WordArray[$i];   //..........
   }
   //........
   // ........
   $rsStr = preg_replace("/^".$spc."/","",$rsStr);
  
   return $rsStr;
  }
  
  //............
  function IsWord($okWord){
   $slen = strlen($okWord);
   if($slen > $this->MaxLen) return false;
   else return isset($this->RankDic[$slen][$okWord]);
  }
  
  //.......................
  function UpdateStr($str){
   $spc = $this->SplitChar;
    $slen = strlen($str);
    if($slen==0) return '';
    $okstr = '';
    $prechar = 0; // 0-.. 1-.. 2-.. 3-..
    for($i=0;$i<$slen;$i++){
      if(ord($str[$i]) < 0x81){
        //.......
        if(ord($str[$i]) < 33){
          if($prechar!=0&&$str[$i]!="\r"&&$str[$i]!="\n") $okstr .= $spc;
          $prechar=0;
          continue; 
        }else if(ereg("[^0-9a-zA-Z@\.%#:/\\&_-]",$str[$i])){
          if($prechar==0){ $okstr .= $str[$i]; $prechar=3;}
          else{ $okstr .= $spc.$str[$i]; $prechar=3;}
        }else{
         if($prechar==2||$prechar==3)
         { $okstr .= $spc.$str[$i]; $prechar=1;}
         else
         { 
           if(ereg("@#%:",$str[$i])){ $okstr .= $str[$i]; $prechar=3; }
           else { $okstr .= $str[$i]; $prechar=1; }
         }
        }
      }
      else{
        //......................
        if($prechar!=0 && $prechar!=2) $okstr .= $spc;
        //......
        if(isset($str[$i+1])){
          $c = $str[$i].$str[$i+1];
          
          $n = hexdec(bin2hex($c));
          if($n<0xA13F && $n > 0xAA40){
             if($prechar!=0) $okstr .= $spc.$c;
             else $okstr .= $c;
             $prechar = 3; 
            }
          else{
            $okstr .= $c;
            $prechar = 2;
          }
          $i++;
        }
      }
    }
    return $okstr;
  }
}
?>
 

