<?php
	
	session_start();
	$course_list = array();
	# Regular Expression
	$pattern_course_name = '/target=\"_top\">(.+?)<\/a>/';
	$pattern_course_number = '/<a href=\"..\/login_s.php\?courseid=(.*)\" target=\"_top\">/';

	# cURL 設置
	$ch = curl_init();

	$options = array(
		CURLOPT_URL 			=> "http://ecourse.elearning.ccu.edu.tw/php/index_login.php",
	 	CURLOPT_HEADER 			=> false,
	  	CURLOPT_POST 			=> true,
	  	CURLOPT_POSTFIELDS 		=> "id=".$_SESSION['username']."&pass=".$_SESSION['password']."&ver=C",
	  	CURLOPT_USERAGENT		=> "Mozilla",
	  	CURLOPT_FOLLOWLOCATION 	=> true,
	  	CURLOPT_RETURNTRANSFER 	=> true,
	  	CURLOPT_COOKIEJAR 		=> $_SESSION['cookie'],
	  	CURLOPT_COOKIEFILE 		=> $_SESSION['cookie']);
	curl_setopt_array($ch, $options);

	# 登入 Ecourse.
	$login_result = curl_exec($ch);
	$login_result = iconv("big5", "UTF-8", $login_result);

	# 抓取課程列表頁面 ==============================================================
	$url = "http://ecourse.elearning.ccu.edu.tw/php/Courses_Admin/take_course.php?PHPSESSID=".$_SESSION['PHPSESSID']."&frame=1";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, false);
	$output = curl_exec($ch);

	# 轉換 Big5 至 UTF-8
	$output = iconv("big5","UTF-8",$output);
	# 取得 HTML DOM
	$html = str_get_html($output);

	# 取得課程列表表單
	$table = $html->find('table[cellspacing=1]',0);

	# 取得課程編號及名稱
	foreach ($table->find('tr[bgcolor!=#000066]') as $course_data) {
		$course_info = array();

		# 分析出課程編號及名稱
		preg_match($pattern_course_number, $course_data ,$course_number);
		preg_match($pattern_course_name, $course_data ,$course_name);

		array_push($course_info, $course_number[1], $course_name[1]);
		array_push($course_list, $course_info);
	}

?>