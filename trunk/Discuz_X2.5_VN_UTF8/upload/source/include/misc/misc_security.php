<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_security.php 25889 2011-11-24 09:52:20Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

global $_G;

if(is_string($this->config['security']['attackevasive'])) {
	$attackevasive_tmp = explode('|', $this->config['security']['attackevasive']);
	$attackevasive = 0;
	foreach($attackevasive_tmp AS $key => $value) {
		$attackevasive += intval($value);
	}
	unset($attackevasive_tmp);
} else {
	$attackevasive = $this->config['security']['attackevasive'];
}

$lastrequest = isset($_G['cookie']['lastrequest']) ? authcode($_G['cookie']['lastrequest'], 'DECODE') : '';

if($attackevasive & 1 || $attackevasive & 4) {
	dsetcookie('lastrequest', authcode(TIMESTAMP, 'ENCODE'), TIMESTAMP + 816400, 1, true);
}

if($attackevasive & 1) {
	if(TIMESTAMP - $lastrequest < 1) {
		securitymessage('attackevasive_1_subject', 'attackevasive_1_message');
	}
}

if(($attackevasive & 2) && ($_SERVER['HTTP_X_FORWARDED_FOR'] ||
	$_SERVER['HTTP_VIA'] || $_SERVER['HTTP_PROXY_CONNECTION'] ||
	$_SERVER['HTTP_USER_AGENT_VIA'] || $_SERVER['HTTP_CACHE_INFO'] ||
	$_SERVER['HTTP_PROXY_CONNECTION'])) {
		securitymessage('attackevasive_2_subject', 'attackevasive_2_message', FALSE);
}

if($attackevasive & 4) {
	if(empty($lastrequest) || TIMESTAMP - $lastrequest > 300) {
		securitymessage('attackevasive_4_subject', 'attackevasive_4_message');
	}
}

if($attackevasive & 8) {
	list($visitcode, $visitcheck, $visittime) = explode('|', authcode($_G['cookie']['visitcode'], 'DECODE'));
	if(!$visitcode || !$visitcheck || !$visittime || TIMESTAMP - $visittime > 60 * 60 * 4 ) {
		if(empty($_POST['secqsubmit']) || ($visitcode != md5($_POST['answer']))) {
			$answer = 0;
			$question = '';
			for ($i = 0; $i< rand(2, 5); $i ++) {
				$r = rand(1, 20);
				$question .= $question ? ' + '.$r : $r;
				$answer += $r;
			}
			$question .= ' = ?';
			dsetcookie('visitcode', authcode(md5($answer).'|0|'.TIMESTAMP, 'ENCODE'), TIMESTAMP + 816400, 1, true);
			securitymessage($question, '<input type="text" name="answer" size="8" maxlength="150" /><input type="submit" name="secqsubmit" class="button" value=" Submit " />', FALSE, TRUE);
		} else {
			dsetcookie('visitcode', authcode($visitcode.'|1|'.TIMESTAMP, 'ENCODE'), TIMESTAMP + 816400, 1, true);
		}
	}

}

function securitymessage($subject, $message, $reload = TRUE, $form = FALSE) {
	global $_G;
	$scuritylang = array(
		'attackevasive_1_subject' => '<center>H&#7878; TH&#7888;NG B&#7842;O V&#7878; &#272;&#195; &#272;&#431;&#7906;C B&#7852;T.</center>',
		'attackevasive_1_message' => '<center>B&#7841;n vui l&#242;ng &#273;&#7907;i gi&#226;y l&#225;t........ <br> Ho&#7863;c th&#7917; l&#7841;i thao t&#225;c v&#7915;a d&#249;ng. <br> (B&#7841;n n&#234;n thao t&#225;c ch&#7853;m khi chuy&#7875;n trang nh&#233;.) </center>',
		'attackevasive_2_subject' => 'Truy c&#7853;p qua Proxy Server b&#7883; h&#7841;n ch&#7871;.',
		'attackevasive_2_message' => 'Trang web c&#7911;a ch&#250;ng t&#244;i h&#7841;n ch&#7871; vi&#7879;c truy c&#7853;p qua m&#7897;t m&#225;y ch&#7911; trung gian. Xin vui l&#242;ng thi&#7871;t l&#7853;p k&#7871;t n&#7889;i tr&#7921;c ti&#7871;p',
		'attackevasive_4_subject' => 'H&#7879; th&#7889;ng t&#7843;i l&#7841;i trang &#273;&#227; &#273;&#432;&#7907;c b&#7853;t.',
		'attackevasive_4_message' => 'Ch&#224;o m&#7915;ng b&#7841;n &#273;&#7871;n v&#7899;i trang web c&#7911;a ch&#250;ng t&#244;i. Xin vui l&#242;ng ch&#7901; khi trang web &#273;&#432;&#7907;c t&#7843;i l&#7841;i.'
	);

	$subject = $scuritylang[$subject] ? $scuritylang[$subject] : $subject;
	$message = $scuritylang[$message] ? $scuritylang[$message] : $message;
	if($_GET['inajax']) {
		security_ajaxshowheader();
		echo '<div id="attackevasive_1" class="popupmenu_option"><b style="font-size: 16px">'.$subject.'</b><br /><br />'.$message.'</div>';
		security_ajaxshowfooter();
	} else {
		echo '<html>';
		echo '<head>';
		echo '<title>'.$subject.'</title>';
		echo '</head>';
		echo '<body bgcolor="#FFFFFF">';
		if($reload) {
			echo '<script language="JavaScript">';
			echo 'function reload() {';
			echo '	document.location.reload();';
			echo '}';
			echo 'setTimeout("reload()", 1001);';
			echo '</script>';
		}
		if($form) {
			echo '<form action="'.$G['PHP_SELF'].'" method="post" autocomplete="off">';
		}
		echo '<table cellpadding="0" cellspacing="0" border="0" width="700" align="center" height="85%">';
		echo '  <tr align="center" valign="middle">';
		echo '    <td>';
		echo '    <table cellpadding="10" cellspacing="0" border="0" width="80%" align="center" style="font-family: Verdana, Tahoma; color: #666666; font-size: 11px">';
		echo '    <tr>';
		echo '      <td valign="middle" align="center" bgcolor="#EBEBEB">';
		echo '     	<br /><br /> <b style="font-size: 16px">'.$subject.'</b> <br /><br />';
		echo $message;
		echo '        <br /><br />';
		echo '      </td>';
		echo '    </tr>';
		echo '    </table>';
		echo '    </td>';
		echo '  </tr>';
		echo '</table>';
		if($form) {
			echo '</form>';
		}
		echo '</body>';
		echo '</html>';
	}
	exit();
}


function security_ajaxshowheader() {
	$charset = getglobal('config/output/charset');
	ob_end_clean();
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
	@header("Pragma: no-cache");
	header("Content-type: application/xml");
	echo "<?xml version=\"1.0\" encoding=\"".$charset."\"?>\n<root><![CDATA[";
}

function security_ajaxshowfooter() {
	echo ']]></root>';
	exit();
}

?>