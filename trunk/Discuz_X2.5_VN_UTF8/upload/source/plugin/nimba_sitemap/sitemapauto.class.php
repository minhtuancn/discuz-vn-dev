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
            if($time-$last>$date)//$date���¼��
            {
		        $data=sitemap_auto();
				
		    }
        }		
		return '';//�ڲ�������������ʾ����
	} 
 }

class plugin_nimba_sitemap_forum extends plugin_nimba_sitemap{ 
} 
?>