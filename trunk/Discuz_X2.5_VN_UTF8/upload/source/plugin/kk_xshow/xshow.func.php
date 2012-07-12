<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once './source/class/class_core.php';
function sethighlight($string) {
	$colorarray = array('', '#EE1B2E', '#EE5023', '#996600', '#3C9D40', '#2897C5', '#2B65B7', '#8F2A90', '#EC1282');
	$string = sprintf('%02d', $string);
	$stylestr = sprintf('%03b', $string[0]);
	$highlight = ' style="';
	$highlight .= $stylestr[0] ? 'font-weight: bold;' : '';
	$highlight .= $stylestr[1] ? 'font-style: italic;' : '';
	$highlight .= $stylestr[2] ? 'text-decoration: underline;' : '';
	$highlight .= $string[1] ? 'color: '.$colorarray[$string[1]].';' : '';
	$highlight .= '"';
	return $highlight;
}
function kk_xshow_query($sql) {
	global $_G, $kk_xshow; 
	$objarray = array();
	$query = DB::query($sql);
	while($result = DB::fetch($query)) {
		$result['tuantv'] = locdau($result['name']);
		$result['tuantv1'] = cutstr($result['name'],1, '...');
		$result['view_subject'] = cutstr($result['subject'], $kk_xshow['subject_length'], '..');
		$result['name'] = strip_tags($result['name']);
		$result['date'] = gmdate('d-m-Y/H:i', $result['dateline'] + $_G['setting']['timeoffset'] * 3600);
		$result['retime'] = gmdate('d-m-Y/H:i', $result['lastpost'] + ($_G['setting']['timeoffset'] * 3600));
		$result['authors'] = cutstr($result['author'], $kk_xshow['ahthor_nums'], '..');
		$result['lastposters_klxy']=urlencode($result['lastposter']);
		$result['lastposters'] = cutstr($result['lastposter'], $kk_xshow['ahthor_nums'], '..');		
		$result['highlight'] = ($result['highlight'] && $kk_xshow['highlight']) ? sethighlight($result['highlight']) : '';
		$objarray[] = $result;
	}
	unset($sql, $query, $result);
	return $objarray;
}
?>
