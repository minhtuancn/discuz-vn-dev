<?php
/*
	[Discuz!] (C)2001-2009 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: kk_xshow hack 2010-09-20 22:00:00Z ANE $
 */

if(!defined('IN_DISCUZ')) {
       exit('Access Denied'); 
}

class plugin_kk_xshow_forum {
	function index_top() {
		global $_G,$kk_xshow,$notshow,$onlyshow,$thread_num;

		$kk_xshow = $_G['cache']['plugin']['kk_xshow'];
		$attachurl = $_G['setting']['attachurl'];
		$kk_xshow['cache_time'] = $kk_xshow['cache_time'] < 10 ? 10 : $kk_xshow['cache_time'];
		
		if($kk_xshow['is_guest'] || $_G['uid']) {
			$cacheFile = DISCUZ_ROOT.'./data/sysdata/cache_kk_xshow.php';
			$kk_xkk_xshowupdate = ($_G['timestamp']-@filemtime($cacheFile)) > $kk_xshow['cache_time'] ? 1 : 0;//
			$notshow = $kk_xshow['not_show'] ? 'AND f.fid not IN('.$kk_xshow['not_show'].')' : '';//不显示的版块  all
			$onlyshow = $kk_xshow['only_show'] ? 'AND f.fid IN('.$kk_xshow['only_show'].')' : '';//仅显示的版块  all
			$x_title = explode('|', str_replace(array("\r\n", "\n"), '|', $kk_xshow['set_title']));// all
			$propre = explode('|', str_replace(array("\r\n", "\n"), '|', $kk_xshow['propre']));//前缀 all

			$linkwindow = $kk_xshow['link_window'] == 1 ? ' target="_blank"' : ''; //all
			$pic_color = $kk_xshow['pic_color'] ? str_replace('#', '0x', $kk_xshow['pic_color']) : '0x0099ff'; //all
			$authnum_color = $kk_xshow['authnum_color'] ? $kk_xshow['authnum_color'] : str_replace('0x', '#', $pic_color); //all
			$author_color = $kk_xshow['author_color'] ? $kk_xshow['author_color'] : $authnum_color; //all
			$user_num = $kk_xshow['user_num'] ? $kk_xshow['user_num'] : 10; //user
			$pic_on = $kk_xshow['pic_on']; //image
			$userdefinecss = $kk_xshow['userdefinecss']; //none
			$thread_num = $kk_xshow['thread_num'] ? $kk_xshow['thread_num'] : 10; //thread reply 4th	
			$tab_style = $kk_xshow['tab_style']; //all
			if(!$kk_xshow['five_list']) {
				$pic_height = max($user_num,$thread_num)*20 -2; //pic
				$thread_num = max($user_num,$thread_num);
			} else {
				$pic_height = $thread_num*20 - 2;
			}
			$thread_height = $thread_num*20; //thread reply 4th

			$row_num = 5;
			$td_star_row = '13%';
			!$pic_on && $row_num--;
			$kk_xshow['five_list'] && $row_num--;
			if($row_num == 5) {
				$td_row = '21%';
			} elseif($row_num == 4 && $pic_on) {
				$td_row = '25%';
			} elseif($row_num == 4 && !$pic_on) {
				$td_row = '29%';
			} elseif($row_num == 3) {
				$td_row = '33%';
			}
			if($kk_xshow['five_list']) {
				$tab_num = 3;
			} else {
				$tab_num = 4;
			}

			if ($kk_xshow['pic_switch'] && $pic_on) {//是否自定义图片
				$picpics = str_replace(array("\r\n", "\n"), '|', $kk_xshow['pic_urls']);
				$piclinks = str_replace(array("\r\n", "\n"), '|', $kk_xshow['pic_links']);
				$pictexts = str_replace(array("\r\n", "\n"), '|', $kk_xshow['pic_titles']);
			}

			require_once libfile('function/cache');
			require_once DISCUZ_ROOT.'./source/plugin/kk_xshow/xshow.func.php';
			$cache_array = array(
				5 => 'image',
				2 => 'thread',
				0 => 'reply',
				1 => '4th',
				3 =>'user'
			);
			foreach($cache_array as $time => $cache) {
				$cache_file = DISCUZ_ROOT.'./data/sysdata/cache_kk_xshow_'.$cache.'.php';
				if(($_G['timestamp'] - @filemtime($cache_file)) > ($kk_xshow['cache_time'] + $time)) {
					$a = 'update_'.$cache;
					$this->$a();
				}
			}
			
			@include_once DISCUZ_ROOT.'./data/sysdata/cache_kk_xshow_image.php';
			@include_once DISCUZ_ROOT.'./data/sysdata/cache_kk_xshow_thread.php';
			@include_once DISCUZ_ROOT.'./data/sysdata/cache_kk_xshow_reply.php';
			@include_once DISCUZ_ROOT.'./data/sysdata/cache_kk_xshow_4th.php';
			@include_once DISCUZ_ROOT.'./data/sysdata/cache_kk_xshow_user.php';
			
			if (@$pic && !$kk_xshow['pic_switch']) {//
				PHP_VERSION > 4.3 ? shuffle($pic) : '';
				$i = 0; $comma = '';
				foreach ($pic as $key=>$val) {
					if (is_readable($val['picpics']) || substr($val['picpics'], 0, 4) == 'http') {
						$picpics .= $comma.$val['picpics'];
						$piclinks .= $comma.$val['piclinks'];
						$pictexts .= $comma.$val['pictexts'];
						$i++;
					} else {
						if($_G['setting']['ftp']['on']) {
							$picpics .= $comma.$_G['setting']['ftp']['attachurl'].str_replace($attachurl, '', $val['picpics']);
							$piclinks .= $comma.$val['piclinks'];
							$pictexts .= $comma.$val['pictexts'];
							$i++;
						} else {
							$picpics .= $comma.$val['picpics'];
							$piclinks .= $comma.$val['piclinks'];
							$pictexts .= $comma.$val['pictexts'];
							$i++;
						}
					}
					$comma = '|';
					if ($i == $kk_xshow['pic_num']) break;
				}
				unset($pic);
			}
			if($kk_xshow['tab_style']) {
				include template('kk_xshow:xshow_tab');
			} else {
				include template('kk_xshow:xshow');
			}
			
		}

		//include_once DISCUZ_ROOT.'./data/cache/cache_kk_xshow.php';
		
		return $return;
	}


	function update_image() {
		global $_G,$kk_xshow,$notshow,$onlyshow,$thread_num;
		
		if ($kk_xshow['pic_switch'] && $kk_xshow['pic_on']) {//是否自定义图片
			$picpics = str_replace(array("\r\n", "\n"), '|', $kk_xshow['pic_urls']);
			$piclinks = str_replace(array("\r\n", "\n"), '|', $kk_xshow['pic_links']);
			$pictexts = str_replace(array("\r\n", "\n"), '|', $kk_xshow['pic_titles']);
		}
		if($kk_xshow['pic_on']) {
			if (!@$picpics || !$kk_xshow['pic_switch']) {//正常状态
				$datapic = array();
				$fids = $kk_xshow['only_pic'] ? 'AND t.fid IN('.$kk_xshow['only_pic'].')' : '';
				$PicNums = $kk_xshow['pic_schnum'];
	
				if ($kk_xshow['pic_transfer'] == 1) { 
					$orderby = 'tid'; 
				} else if ($kk_xshow['pic_transfer'] == 2) { 
					$orderby = 'tid'; 
				} else { 
					$orderby = 'rand'; 
				}
				$orderby = $orderby != 'rand' ? 'attach.'.$orderby : 'rand()';
				$query = DB::query("SELECT attach.attachment,t.tid, t.fid, t.subject FROM ".DB::table('forum_threadimage')." attach INNER JOIN ".DB::table('forum_thread')." t ON t.tid=attach.tid WHERE t.isgroup=0 AND t.displayorder>=0 $fids GROUP BY attach.tid ORDER BY $orderby DESC LIMIT 0, ".$PicNums);
				while($pic = DB::fetch($query)) {
					$pics['picpics'] = $_G['setting']['attachurl'].'forum/'.$pic['attachment'];
					$pics['piclinks'] = 'forum.php?mod=viewthread%26tid='.$pic['tid'];
					$pics['pictexts'] = str_replace('\'', ' ',$pic['subject']);
					$pics['attaid'] = $pic['aid'];
					$datapic[] = $pics;
				}
				$cacheArray .= "\$pic=".arrayeval($datapic).";\n";
				unset($query, $datapic, $pics);
			}
			writetocache('kk_xshow_image', $cacheArray);
		}

	}

	function update_thread() {
		global $_G,$kk_xshow,$notshow,$onlyshow,$thread_num;

		$thread_num = $kk_xshow['thread_num'] ? $kk_xshow['thread_num'] : 10; //thread reply 4th
		$sql = "SELECT t.*, f.name FROM ".DB::table('forum_thread')." t, ".DB::table('forum_forum')." f WHERE f.status<>'3' AND f.fid=t.fid $notshow $onlyshow AND t.displayorder not IN(-1,-2) ORDER BY t.dateline DESC LIMIT 0, $thread_num";
		$objarray = kk_xshow_query($sql);
		$cacheArray .= "\$newPost=".arrayeval($objarray).";\n\n";
		unset($sql, $objarray);
		writetocache('kk_xshow_thread', $cacheArray);
	}
	function update_reply() {
		global $_G,$kk_xshow,$notshow,$onlyshow,$thread_num;

		$thread_num = $kk_xshow['thread_num'] ? $kk_xshow['thread_num'] : 10; //thread reply 4th
		//$thread_num = 20; //thread reply 4th
		$sql = "SELECT t.*, f.name FROM ".DB::table('forum_thread')." t, ".DB::table('forum_forum')." f WHERE f.status<>'3' AND f.fid=t.fid $notshow $onlyshow AND t.displayorder not IN(-1,-2) AND t.closed NOT LIKE 'moved|%' AND t.replies!=0 ORDER BY t.lastpost DESC LIMIT 0, $thread_num";
		$objarray = kk_xshow_query($sql);
		$cacheArray .= "\$newReply=".arrayeval($objarray).";\n\n";
		writetocache('kk_xshow_reply', $cacheArray);
	}
	function update_4th() {
		global $_G,$kk_xshow;
//$thread_num = 20; //thread reply 4th
		$thread_num = $kk_xshow['thread_num'] ? $kk_xshow['thread_num'] : 10; //thread reply 4th
		$sortway = array('', 'replies', 'views', 'dateline', 'lastpost');
		$hotdig = $kk_xshow['hot_dig'] == 2 ? $sortway[$kk_xshow['dig_list']] : $sortway[$kk_xshow['hot_list']];
		$ctime = $kk_xshow['tid_day'] ? $_G['timestamp'] - (3600 * 24 * $kk_xshow['tid_day']) : 0;
		$DigShow = $kk_xshow['hot_dig'] == 2 && $kk_xshow['dig_rank'] ? 'AND t.digest IN('.$kk_xshow['dig_rank'].')' : '';
		
		$sql = "SELECT t.*, f.name FROM ".DB::table('forum_thread')." t, ".DB::table('forum_forum')." f WHERE f.status<>'3' AND f.fid=t.fid $notshow $onlyshow $DigShow AND t.displayorder not IN(-1,-2) AND t.replies!=0 AND t.dateline>$ctime ORDER BY t.$hotdig DESC LIMIT 0, $thread_num";
		$objarray = kk_xshow_query($sql);
		$cacheArray .= "\$ObjArray=".arrayeval($objarray).";\n\n";
		unset($sortway, $hotdig, $sql, $ctime, $DigShow, $objarray);
		writetocache('kk_xshow_4th', $cacheArray);
	}
	function update_user() {
		global $_G,$kk_xshow;
		
		if(!$kk_xshow['five_list']){
			$user_num = $kk_xshow['user_num'] ? $kk_xshow['user_num'] : 10; //user
		}else{
			$user_num = $kk_xshow['user_num'] ? $kk_xshow['user_num'] : 10;
		}
		$poststar = array(); 
		$tomonth = date('n'); 
		$todate = date('j'); 
		$toyear = date('Y');
		if ($kk_xshow['author_date'] == 1) { 
			$time = mktime(0, 0, 0, $todate, $tomonth, $toyear); 
		}else if ($kk_xshow['author_date'] == 2) { 
			$time = mktime(0, 0, 0, $todate, $tomonth, $toyear) - 604800; 
		}else if ($kk_xshow['author_date'] == 3) { 
			$time = mktime(0, 0, 0, $tomonth, 1, $toyear); 
		}else if ($kk_xshow['author_date'] == 4) { 
			$time = mktime(0, 0, 0, 1, 1, $toyear); 
		}else { 
			$time = 0; 
		}
		if($kk_xshow['author_date'] != 6) {
			$query = DB::query("select count(pid) as num, authorid, author from ".DB::table('forum_post')." where dateline>=$time group by authorid order by num desc limit 0, $user_num");
		} else {
			$query = DB::query("SELECT uid as authorid,username as author,regdate FROM ".DB::table('common_member')." ORDER BY regdate DESC limit 0, $user_num");
		}
		while($result = DB::fetch($query)) {
			$result['avatar'] = discuz_uc_avatar($result['authorid'], 'small');
			$result['autitl'] = $result['author'];
			if($kk_xshow['author_date'] == 6) {
				$result['num'] = gmdate('d-m-Y', $result['regdate'] + $_G['setting']['timeoffset'] * 3600);
			}
			$poststar[] = $result;
		}
		$cacheArray .= "\$postStar=".arrayeval($poststar).";\n";
		writetocache('kk_xshow_user', $cacheArray);
	}
}
?>
