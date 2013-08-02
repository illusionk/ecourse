<?php
	require_once('simple_html_dom.php');
	require_once('courseList.php');

	# Regular Expression
	$pattern_student_table = '/(#F0FFEE|#E6FFFC)><td nowrap>([0-9]+)<\/td><td nowrap>(.+?)<\/td><td nowrap>([0-9]+)<\/td><td nowrap>(.+?)<\/td><td nowrap>(.+?)<\/td><td nowrap>(.+?)<\/td>/';

	# 進入課程頁面
	$url = "http://ecourse.elearning.ccu.edu.tw/php/login_s.php?courseid=".$_SESSION['id'];
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_exec($ch);

	# 學生名單
	$url = "http://ecourse.elearning.ccu.edu.tw/php/Learner_Profile/SSQueryFrame1.php";
	curl_setopt($ch, CURLOPT_URL, $url);
	$output = iconv("big5", "UTF-8", curl_exec($ch));
	
	preg_match_all($pattern_student_table, $output, $studentList);
	array_splice($studentList, 0, 2);

	curl_close($ch);
?>
