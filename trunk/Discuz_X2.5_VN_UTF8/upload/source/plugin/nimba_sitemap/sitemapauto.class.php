<?php
include 'sitemap.fun.php';
class plugin_nimba_sitemap {
	function global_footer() {
	    loadcache('plugin');
		global $_G;
		$var = $_G['cache']['plugin']['nimba_sitemap'];
		$auto =$var['auto'];
		if($auto==1)
		{
	        $file = fopen(dirname(__FILE__).'/time.txt','r');
		    $last=fgets($file);
			//var_dump($last);
            fclose($file);
		    $time=time();
			$date =$var['cycle'];
            if($time-$last>$date)//$date更新间隔
            {
		        $data=sitemap_auto();
				
		    }
        }		
		return '';//内部处理，不返回显示数据
	} 
 }

class plugin_nimba_sitemap_forum extends plugin_nimba_sitemap{ 
} 
?>