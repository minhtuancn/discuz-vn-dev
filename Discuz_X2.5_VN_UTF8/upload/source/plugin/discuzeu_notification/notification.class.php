<?php
class plugin_discuzeu_notification {
	function global_header() {
		global $_G;
		$msg = '';
		if($_G['member']['newpm']) {
			$msg = '<p>'.lang('plugin/discuzeu_notification', 'new_pm').', <a href="home.php?mod=space&do=pm">'.lang('plugin/discuzeu_notification', 'view_pm').'</a></p>';
		}
		if($_G['member']['newprompt']) {
			$msg .= '<p>'.lang('plugin/discuzeu_notification', 'have').' <b>'.$_G['member']['newprompt'].'</b> '.lang('plugin/discuzeu_notification', 'new_notice').', <a href="home.php?mod=space&do=notice">'.lang('plugin/discuzeu_notification', 'view_notice').'</a></p>';
		}
		if(!$msg) {
			return '';
		}
		if(!function_exists('widthauto') || !widthauto()) {
			$right = 'right: 50%; margin-right: -420px;';
		} else {
			$right = 'right: 2%;';
		}
		$tip = <<<EOF
<div style="position: absolute; $right top: 70px; display: block;" id="discuzeu_notification_tip">
<div class="discuzeu_notification_tip">
	<a class="adel" href="javascript:void(0)" onclick="$('discuzeu_notification_tip').style.display='none';">close</a>
	$msg
</div></div>
<script type="text/javascript">
_attachEvent(window, 'scroll', function(){discuzeu_notification_tip();});
function discuzeu_notification_tip() {
	var scrollHeight = parseInt(document.body.getBoundingClientRect().top);
	if (scrollHeight < -70) {
		$('discuzeu_notification_tip').style.position = 'fixed';
		$('discuzeu_notification_tip').style.top = '0px';
	} else {
		$('discuzeu_notification_tip').style.position = 'absolute';
		$('discuzeu_notification_tip').style.top = '70px';
	}
}
</script>
EOF;
		return $tip;
	}
}

?>