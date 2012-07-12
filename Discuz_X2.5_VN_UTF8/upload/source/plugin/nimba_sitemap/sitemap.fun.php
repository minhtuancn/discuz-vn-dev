<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

    function sitemap_auto()
	 {
			//组织参数
			global $_G;
			loadcache('plugin');			
			$var = $_G['cache']['plugin']['nimba_sitemap'];
			$filename =trim($var['filename']);
			$url =trim($var['web_root']);
			$web_root=empty($url) ? $_G['siteurl']:$url;
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
					//更新地图
					get_sitemap($filename,$web_root,$cycle,$charset,$notin,$show);//生成地图
					return '1';//返回值仅作调试用
	 }//获取上次更新时间并自动更新
	 
function isrewrite($item)
{
/*
portal_topic
portal_article
forum_forumdisplay
forum_viewthread
group_group
home_space
home_blog
forum_archiver
*/
    $query=DB::query("SELECT svalue FROM ".DB::table('common_setting')." where skey='rewritestatus'");	//rewritestatus
    $value=DB::fetch($query);
    $data=$value['svalue'];
    $data=unserialize($data);
    if(in_array($item,$data))
	{
	    $query=DB::query("SELECT svalue FROM ".DB::table('common_setting')." where skey='rewriterule'");	//rewriterule
        $value=DB::fetch($query);
        $rule=$value['svalue'];
        $rule=unserialize($rule);
		$return=$rule[$item];
		$num=stripos($return,"{");
		$return=substr($return,0,$num);
        return $return;
	}else return '';
}
//echo isrewrite('forum_viewthread');	

function subdomain($item)//查询后台设置的应用域名
{
	global $_G;
	$var = $_G['cache']['plugin']['nimba_sitemap'];
	$url =trim($var['mysite']);
    $query=DB::query("SELECT svalue FROM ".DB::table('common_setting')." where skey='domain'");
	$value=DB::fetch($query);
	$data=$value['svalue'];
    $data=unserialize($data);
	$return=empty($data['app'][$item])? $url:$data['app'][$item];
	return $return;
/*	
portal
forum
group
home
mobile
default
*/
}

function get_sitemap($filename,$web_root,$cycle,$charset,$notin,$show)
    {
	//echo $show;
/***********************************************************************************************/
//网站地图sitemap.xml
$sitemap="<?xml version=\"1.0\" encoding=\"$charset\"?>\n";
$sitemap.="<urlset\n";
$sitemap.="xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n";
$sitemap.="xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n";
$sitemap.="xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n";
$sitemap.="http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";
//论坛帖子
if($show[0]==1)
{
    $querys = DB::query("SELECT a.tid,a.lastpost FROM ".DB::table('forum_thread')." a inner join ".DB::table('forum_forum')." b on a.fid=b.fid where a.displayorder!=-2 and a.displayorder!=-1 $notin ORDER BY a.tid DESC  LIMIT 0,10000");
    while($threadfid = DB::fetch($querys))
    {
	    $isrewrite=isrewrite('forum_viewthread');
	    if(!empty($isrewrite)) $turl='http://'.subdomain('forum').$web_root.$isrewrite.$threadfid['tid'].'-1-1.html';//静态规则
		else $turl='http://'.subdomain('forum').$web_root.'forum.php?mod=viewthread&amp;tid='.$threadfid['tid'];//动态规则,xml中&要换成&amp;
        $link = $turl;
		$riqi=date("Y-m-d",$threadfid['lastpost']);
		//$priority=rand(1,10)/10;
$sitemap.="<url>\n";
$sitemap.="<loc>$link</loc>\n";
$sitemap.="<priority>0.8</priority>\n";
$sitemap.="<lastmod>$riqi</lastmod>\n";
$sitemap.="<changefreq>$cycle</changefreq>\n";
$sitemap.="</url>\n";
    }
}	
//论坛版块
if($show[1]==1)
{
    $querys = DB::query("SELECT a.fid FROM ".DB::table('forum_forum')." a where a.type='forum' and status=1 $notin ORDER BY a.fid DESC  LIMIT 0,10000");
    while($threadfid = DB::fetch($querys))
    {
	    $isrewrite=isrewrite('forum_forumdisplay');
	    if(!empty($isrewrite)) $turl='http://'.subdomain('forum').$web_root.$isrewrite.$threadfid['fid'].'-1.html';//静态规则
		else $turl='http://'.subdomain('forum').$web_root.'forum.php?mod=forumdisplay&amp;fid='.$threadfid['fid'];//动态规则,xml中&要换成&amp;
        $link = $turl;
		$t=time();
		$riqi=date("Y-m-d",$t);
		//$priority=rand(1,10)/10;
$sitemap.="<url>\n";
$sitemap.="<loc>$link</loc>\n";
$sitemap.="<priority>0.9</priority>\n";
$sitemap.="<lastmod>$riqi</lastmod>\n";
$sitemap.="<changefreq>$cycle</changefreq>\n";
$sitemap.="</url>\n";
    }
}
//门户文章
if($show[2]==1)
{
    $querys = DB::query("SELECT a.aid,a.dateline,count(distinct a.aid) FROM ".DB::table('portal_article_title')." a inner join ".DB::table('portal_article_content')." b on a.aid=b.aid group by a.aid ORDER BY a.aid DESC  LIMIT 0,10000");
    while($threadfid = DB::fetch($querys))
    {
	    $isrewrite=isrewrite('portal_article');
	    if(!empty($isrewrite)) $turl='http://'.subdomain('portal').$web_root.$isrewrite.$threadfid['aid'].'-1.html';//静态规则
		else $turl='http://'.subdomain('portal').$web_root.'portal.php?mod=view&amp;aid='.$threadfid['aid'];//动态规则,xml中&要换成&amp;
        $link = $turl;
		//$t=time();
		$riqi=date("Y-m-d",$threadfid['dateline']);
		//$priority=rand(1,10)/10;
$sitemap.="<url>\n";
$sitemap.="<loc>$link</loc>\n";
$sitemap.="<priority>0.8</priority>\n";
$sitemap.="<lastmod>$riqi</lastmod>\n";
$sitemap.="<changefreq>$cycle</changefreq>\n";
$sitemap.="</url>\n";
    }
}



    $sitemap .= "</urlset>\n";
    $fp = fopen(DISCUZ_ROOT.'/'.$filename,'w');
    fwrite($fp,$sitemap);
    fclose($fp);
	}
?>