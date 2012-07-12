<?php
if(!defined('IN_DISCUZ')) {
       exit('Access Denied'); 
}
require_once 'online_24h.func.php';
class plugin_online_24h_forum {
	function index_middle() {
		global $_G,$online_24h;
		$day_time = time()-date('H',time())*60*60;		
		$queryshow = DB::query("select * from ".DB::table('common_member_status')." where lastvisit > $day_time order by lastvisit DESC ");
		while($resultshow = DB::fetch($queryshow)){
		$showcount ++;
		$resultshow['username'] = tenthanhven($resultshow['uid']);
		$resultshow[lastvisit] = dgmdate($resultshow['lastvisit']);
					$xxx = iconthanhven($resultshow['uid']);				
					$resultshow['icon'] = isset($_G['cache']['onlinelist']["$xxx"]) ? $_G['cache']['onlinelist']["$xxx"] : $_G['cache']['onlinelist'][0];
					$resultshow['color'] = mautv($xxx);			
		$receiveshow[] = $resultshow;
		}
		$tomonth = date('n'); 
  $todate = date('j'); 
  $toyear = date('Y');  
  $query = DB::query("SELECT p.*,m.username FROM ".DB::table('common_member_profile')." p,".DB::table('common_member')." m WHERE p.uid=m.uid AND p.birthmonth=$tomonth AND p.birthday=$todate ORDER BY m.credits DESC limit 0, 20");  
  while($result = DB::fetch($query)) {
   $result['authorid'] = $result['uid'];
   $result['autitl'] = $result['username'];
   $result['avatar'] = discuz_uc_avatar($result['authorid'], 'small');
   $result['birthyear'] = $result['birthyear'];
   $birthuser[] = $result;
  }
		include template('online_24h:online_24h');
		return $return;
	}
}

?>
