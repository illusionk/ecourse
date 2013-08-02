<?php

	require_once('simple_html_dom.php');
	require_once('courseList.php');

	$scoreList = $course_list;
	$pattern_grade_item = '/2>(.*?)<\/td><td>(.*?)<\/td><td>(.*?)<\/td><td>(.*?)<\/td>/';
	$pattern_grade_total = '/<th colspan=3>(.*?)<\/th><th colspan=2>(.*?)<\/th>/';
			
	# 抓取所有課程成績 ================================================================
	for($i = 0; $i < count($scoreList); $i++) {

		# 進入課程頁面
		$url = "http://ecourse.elearning.ccu.edu.tw/php/login_s.php?courseid=".$scoreList[$i][0];
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_exec($ch);

		# 進入成績頁面
		$url = "http://ecourse.elearning.ccu.edu.tw/php/Trackin/SGQueryFrame1.php";
		curl_setopt($ch, CURLOPT_URL, $url);
		$output = iconv("big5", "UTF-8", curl_exec($ch));

		$html = str_get_html($output);
		$table = $html->find('table[cellpadding=3]',0);

		$course_grade = array();

		foreach ($table->find('tr') as $item) {

			$ary_item = array();

			# 考試 & 作業成績
			if($item->bgcolor == '#F0FFEE' || $item->bgcolor == '#E6FFFC') {
				preg_match($pattern_grade_item, $item ,$grade_item);
				$grade_item[3] = preg_replace("/<font color=#FF0000>(.*?)<\/font>/", "$1", $grade_item[3]);
				array_push($ary_item, $grade_item[1], $grade_item[2], $grade_item[3], $grade_item[4]);
				array_push($course_grade, $ary_item);
			}
			# 總成績 & 總排名
			else if($item->bgcolor == '#B0BFC3') {
				preg_match($pattern_grade_total, $item ,$grade_item);
				$grade_item[2] = preg_replace("/<font color=#FF0000>(.*?)<\/font>/", "$1", $grade_item[2]);
				array_push($scoreList[$i], $grade_item[2]);
			}
		}

		array_push($scoreList[$i], $course_grade);
	}

	curl_close($ch);

?>
