<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
function tenthanhven($id){
	$query = DB::query("select username from ".DB::table('common_member')." where uid = $id");
	$result = DB::fetch($query);
	return $result['username'];
}
function iconthanhven($id){
	$query = DB::query("select groupid from ".DB::table('common_member')." where uid = $id");
	$result = DB::fetch($query);
	return $result['groupid'];
}
function mautv($id){
	$query = DB::query("SELECT color FROM ".DB::table('common_usergroup')." WHERE groupid=$id");
	$result = DB::fetch($query);
	return $result['color'];
}
?>
