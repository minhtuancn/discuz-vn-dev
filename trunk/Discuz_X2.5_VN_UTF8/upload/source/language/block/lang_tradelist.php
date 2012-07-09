<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: lang_tradelist.php 27449 2012-02-01 05:32:35Z zhangguosheng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$lang = array
(
	'tradelist_fids' => 'Diễn đàn',
	'tradelist_fids_comment' => 'Thiết lập hiện thị ở nhiều diễn đàn.Bạn hãy nhấm giữ phím CTRL để chọn các diễn đàn',//'设置允许参与新帖调用的版块，可以按住 CTRL 多选，全选或全不选均为不做限制',
	'tradelist_uids' => 'UID của thành viên',
	'tradelist_uids_comment' => 'Thiết lập người dùng mà bạn muốn hiển thị.Sử dụng ","  ngăn cách các UIDs',//'设置要指定显示的用户UID，多个 UID 请用半角逗号“,”隔开。',
	'tradelist_startrow' => 'Hàng đầu tiên',
	'tradelist_startrow_comment' => 'Điền số 0 nếu muốn là hàng đầu tiên.',//'如需设定起始的数据行数，请输入具体数值，0 为从第一行开始，以此类推',
	'tradelist_items' => 'Các hàng còn lại.',
	'tradelist_items_comment' => 'Thiết lập số lượng hàng mà bạn muốn hiển thị, nó phải số nguyên lớn hơn 0.',//'设置一次显示的主题条目数，请设置为大于 0 的整数',
	'tradelist_titlelength' => 'Tiêu đề',
	'tradelist_titlelength_comment' => 'Thiết lập độ dài tối đa của tiêu đề',//'设置当标题长度超过本设定时，是否将标题自动缩减到本设定中的字节数，0 为不自动缩减',
	'tradelist_fnamelength' => 'Tên tiêu đề diễn đàn',
	'tradelist_fnamelength_comment' => 'Thiết lập độ dài tối đa tiêu đề bao gồm cả tên diễn đàn',//'设置标题长度是否将所在版块名称的长度一同计算在内',
	'tradelist_summarylength' => 'Mô tả',//'主题简短内容文字数',
	'tradelist_summarylength_comment' => 'Thiết lập độ dài của bản mô tả, để 0 sẽ giá trị mặc ​​định (255 ký tự))',//'设置主题简短内容的文字数，0 为使用默认值 255',
	'tradelist_tids' => 'Chủ đề',
	'tradelist_tids_comment' => 'Thiết lập id chủ đề cụ thể mà bạn muốn hiển thị, sử dụng "," ngăn cách nhiều tids',//'设置要指定显示的主题 tid ，多个 tid 请用半角逗号“,”隔开。注意: 留空为不进行任何过滤',
	'tradelist_keyword' => 'Từ khóa',
	'tradelist_keyword_comment' => 'Thiết lập các từ khóa được sử dụng.<br />Bạn có thể sử dụng ký tự đại diện "*" trong từ khóa.<br />Nếu bạn muốn sử dụng một số từ khóa tại cùng một thời điểm, bạn có thể sử dụng "AND". Ví dụ: win32 AND Unix.<br />Nếu bạn muốn sử dụng chỉ cần một từ khóa, bạn có thể sử dụng "|" hoặc "OR". Ví dụ: win32 OR unix',//'设置标题包含的关键字。注意: 留空为不进行任何过滤<br />关键字中可使用通配符 "*"<br />匹配多个关键字全部，可用空格或 "AND" 连接。如 win32 AND unix<br />匹配多个关键字其中部分，可用 "|" 或 "OR" 连接。如 win32 OR unix',
	'tradelist_typeids' => 'Các loại chủ đề',
	'tradelist_typeids_comment' => 'Thiết lập các loại chủ đề. Lưu ý: nếu chọn không sẽ vô hiệu hóa tính năng này.',//'设置特定分类的主题。注意: 全选或全不选均为不进行任何过滤',
	'tradelist_typeids_all' => 'Tất cả các loại chủ đề',
	'tradelist_sortids' => 'Sắp xếp ID',
	'tradelist_sortids_comment' => 'Thiết lập các loại chủ đề. Lưu ý: nếu chọn không sẽ vô hiệu hóa tính năng này.',//'设置特定分类信息的主题。注意: 全选或全不选均为不进行任何过滤',
	'tradelist_sortids_all' => 'Tất cả danh mục',
	'tradelist_digest' => 'Lọc phân loại',
	'tradelist_digest_comment' => 'Chọn chủ đề: để có tính năng lọc chủ đề. Lưu ý: nếu chọn không sẽ vô hiệu hóa tính năng này.',//'设置特定的主题范围。注意: 全选或全不选均为不进行任何过滤',
	'tradelist_digest_0' => 'Tổng quát',
	'tradelist_digest_1' => 'Loại I',
	'tradelist_digest_2' => 'Loại II',
	'tradelist_digest_3' => 'Loại III',
	'tradelist_stick' => 'Bộ lọc',
	'tradelist_stick_comment' => 'Chọn chủ đề: để có tính năng lọc chủ đề. Lưu ý: nếu chọn không sẽ vô hiệu hóa tính năng này.',//'设置特定的主题范围。注意: 全选或全不选均为不进行任何过滤',
	'tradelist_stick_0' => 'Tổng quát',
	'tradelist_stick_1' => 'Loại I',
	'tradelist_stick_2' => 'Loại II',
	'tradelist_stick_3' => 'Loại III',
	'tradelist_special' => 'Loại đặc biệt',
	'tradelist_special_comment' => 'Chọn chủ đề cần lọc đặc biệt. Lưu ý: nếu chọn không sẽ vô hiệu hóa tính năng này.',//'设置特定的主题范围。注意: 全选或全不选均为不进行任何过滤',
	'tradelist_special_1' => 'Thăm dò',
	'tradelist_special_2' => 'Thị trường',
	'tradelist_special_3' => 'Giải thưởng',
	'tradelist_special_4' => 'Sự kiện',
	'tradelist_special_5' => 'Tranh luận',
	'tradelist_special_0' => 'Tổng quát',
	'tradelist_special_reward' => 'Phần thưởng',//'悬赏主题过滤',
	'tradelist_special_reward_comment' => 'Chọn loại khen thưởng',//'设置特定类型的悬赏主题',
	'tradelist_special_reward_0' => 'Tất cả',//'全部',
	'tradelist_special_reward_1' => 'Cuối cùng',//'已解决',
	'tradelist_special_reward_2' => 'Sôi nổi',//'未解决',
	'tradelist_recommend' => 'Đê xuât chủ đề',
	'tradelist_recommend_comment' => 'Hiển thị chỉ những chủ đề được đề nghị',//'设置是否只显示推荐的主题',
	'tradelist_orderby' => 'Sắp xếp',
	'tradelist_orderby_comment' => 'Thiết lập các chủ đề',//'设置以哪一字段或方式对主题进行排序',
	'tradelist_orderby_lastpost' => 'Bài mới nhất',//'按最后回复时间倒序排序',
	'tradelist_orderby_dateline' => 'Thời gian bắt đầu',//'按发布时间倒序排序',
	'tradelist_orderby_replies' => 'Trả lời',//'按回复数倒序排序',
	'tradelist_orderby_views' => 'Lượt xem',//'按浏览次数倒序排序',
	'tradelist_orderby_heats' => 'Hot',//'按热度倒序排序',
	'tradelist_orderby_recommends' => 'Khuyến cáo',//'按主题评价倒序排序',
	'tradelist_orderby_hourviews' => 'Số lần đọc trong thời gian quy định',//'按指定时间内浏览次数倒序排序',
	'tradelist_orderby_todayviews' => 'Xem trong ngày',//'按当天浏览次数倒序排序',
	'tradelist_orderby_weekviews' => 'Xem trong tuần',//'按本周浏览次数倒序排序',
	'tradelist_orderby_monthviews' => 'Xem trong tháng',//'按当月浏览次数倒序排序',
	'tradelist_orderby_hours' => 'Chọn giờ (hours)',
	'tradelist_orderby_hours_comment' => 'Thiết lập thời gian cụ thể để xem',//'指定时间内浏览次数倒序排序的时间值',
	'tradelist_orderby_todayhots' => 'Hots trong ngày',//'按当天累计售出数倒序排序',
	'tradelist_orderby_weekhots' => 'Hots trong tuần',//'按本周累计售出数倒序排序',
	'tradelist_orderby_monthhots' => 'Hots trong tháng',//'按当月累计售出数倒序排序',
	'tradelist_price_add' => 'Bổ sung',
	'tradelist_place' => 'Địa điểm',
	'tradelist_class' => 'Loại',
	'tradelist_gender' => 'Giới tính',
	'tradelist_gender_0' => 'Không rõ',
	'tradelist_gender_1' => 'Nam',
	'tradelist_gender_2' => 'Nữ',
	'tradelist_orderby_weekstart' => 'Bắt đầu trong tuần',//'按一周内活动开始时间排序',
	'tradelist_orderby_monthstart' => 'Bắt đầu trong tháng',//'按一月内活动开始时间排序',
	'tradelist_orderby_weekexp' => 'Tuần hết hạn',//'按一周内报名截止时间排序',
	'tradelist_orderby_monthexp' => 'Tháng hết hạn',//'按一月内报名截止时间排序',
	'tradelist_highlight' => 'Đánh dấu những từ được tìm thấy',
);

?>