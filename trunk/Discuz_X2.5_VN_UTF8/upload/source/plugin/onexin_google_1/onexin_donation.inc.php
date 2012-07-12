<?php
/**
 * Onexin Donation For Discuz!X 2.0+
 * ============================================================================
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * @package    onexin_donation
 * @module	   donation 
 * @date	   2012-02-19+
 * @author	   King
 * @copyright  Copyright (c) 2011 Onexin Platform Inc. (http://www.onexin.com)
 */

/*
//--------------Tall us what you think!----------------------------------
*/
?>
<table class="tb tb2 nobdb">
  <tr>
    <td class="vtop tips2"><a href='http://me.alipay.com/onexin' target="_blank" style="text-decoration:none;"> <img src='https://img.alipay.com/sys/personalprod/style/mc/btn-index.png' border="0" > </a></td>
  </tr>
</table>
<?php
$url = 'http://www.onexin.com/donation.php?charset='.CHARSET;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$contents = curl_exec($ch);
curl_close($ch);
echo $contents;
?>