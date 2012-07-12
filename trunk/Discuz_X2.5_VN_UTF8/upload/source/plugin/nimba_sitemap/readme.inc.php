<?php
$readme=<<<EOF
<br>
<table border=0 cellspacing=1 cellpadding=5 width=72%>
<tr height=27>
<td align="center" class=p11t bgcolor="eeeecc"><b>网站地图 Sitemap For X2.0/X2.5使用说明</b></td>
</tr>
</table><br>
<table border="0" cellpadding="2" cellspacing="2" width="72%">
<tr><td><span class="p11blk"><ol>
<li>本插件由土著人宁巴开发,<a href="http://www.ailab.org/" target="_blank">人工智能实验室</a>技术团队出品（Made By Nimba, Team From AiLab.org ） <br><br>
<li>开发者主页<a href="http://addon.discuz.com/?@1552.developer" target="_blank">http://addon.discuz.com/?@1552.developer</a><br><br>
<li>本插件部分数据由<a href="http://www.bbs369.com/" target="_blank">BBS369论坛导航</a>提供网络数据接口<br><br>
<li>本插件用于将论坛10000条帖子生成xml格式网站地图，关于xml地图如何使用请自行查阅相关资料<br><br>
<li>本插件将根据站长您的设置自动生成名为sitemap.xml(后台修改除外)的文件置于网站根目录之下，请确保网站本目录有文件写入权限<br><br>
<li>本插件根目录下有名为time.txt的文件，用以记录地图更新之间，如对程序不熟悉这，请勿动此文件。<br><br>
<li>后台参数设置请务必阅读设置项后面的说明。<br><br>
<li>特别提示：如果您对.xml格式地图不了解或不知道怎么用，请参考：<a href="http://www.baidu.com/search/sitemap_help.html" target="_blank">http://www.baidu.com/search/sitemap_help.html</a><br><br>
<li>由于各种难以预料的原因，插件在设计和使用上难免会有些细节问题，敬请见谅，商业版用户请加QQ：594941227，以便获得我们插件的最新动态和技术支持！免费用户请至本插件讨论专区<a href="http://club.bbs369.com/club-54-1.html" target="_blank">http://club.bbs369.com/club-54-1.html</a>发帖咨询，内有专人解答！<br><br>
<li>欢迎各位站长将优秀的插件创意提供给我们，一旦实现将优先提供给您使用，同时可获得本团队技术支持！<br><br>
<li>购买商业版的用户将具有免费或打折升级的优惠！<br><br>
</ol></span></td></tr></table>
EOF;
if(strtolower(CHARSET) == 'utf-8') $readme=iconv('GB2312', 'UTF-8',$readme);//utf-8
echo $readme;
?>
