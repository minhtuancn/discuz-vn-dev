<?php

/*
 *    $ sitemap.inc.php  2012-3-4  网站地图 手动版
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
    include 'sitemap.fun.php';
	//组织参数
	loadcache('plugin');
	global $_G;
	$var = $_G['cache']['plugin']['nimba_sitemap'];
    $auto =$var['auto'];
	$filename =str_replace(array("\r\n", "\n", "\r"), '/hhf/', $var['filename']);
	$url =str_replace(array("\r\n", "\n", "\r"), '/hhf/', $var['web_root']);
	$web_root=empty($url) ? $_G['siteurl']:$url;
	$date=str_replace(array("\r\n", "\n", "\r"), '/hhf/', $var['cycle']);
	$charset =$var['charset'];
	if($charset==2) $charset='utf-8';
	else $charset='gbk';//默认使用gbk
	$ban=unserialize($var['ban']);
	if(count($ban)==0) $notin='';
	else{
		$notin='and a.fid not in (0';
	    for($i=0;$i<count($ban);$i++)
	    {
		    if($ban[$i]>0)  $notin.=",$ban[$i]";
	    }
		$notin.=")";
	}
	if($notin=='and a.fid not in (0)') $notin='';	
	$show=array(0,0,0);
	$urls=unserialize($var['urls']);
	if(in_array('1',$urls)) $show[0]=1;	
	if(in_array('2',$urls)) $show[1]=1;	
	if(in_array('3',$urls)) $show[2]=1;	
	$cycle='weekly';
	//记录更新时间
    $fp = fopen(dirname(__FILE__).'/time.txt','w');
    fwrite($fp,time());
    fclose($fp);
    //更新提示
    get_sitemap($filename,$web_root,$cycle,$charset,$notin,$show);//生成地图
	//返回结果
	$tip='<br>提示：['.date("Y-m-d H:i:s",time()).']您的网站地图已更新,地图地址：<br>http://'.subdomain('portal').$web_root.$filename;
	if(strtolower(CHARSET) == 'utf-8') $tip=iconv('GB2312', 'UTF-8',$tip);//utf-8
	echo $tip;
	//echo time();
	//echo $filename;
?>