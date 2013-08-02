<?php
	require_once('simple_html_dom.php');
	require_once('courseList.php');

	# Regular Expression
	$pattern_news_id = '/a_id=([0-9]+)&/';

	# 進入課程頁面
	$url = "http://ecourse.elearning.ccu.edu.tw/php/login_s.php?courseid=".$_SESSION['id'];
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_exec($ch);

	#佈告欄
	$url = "http://ecourse.elearning.ccu.edu.tw/php/news/news.php";
	curl_setopt($ch, CURLOPT_URL, $url);
	$output = iconv("big5", "UTF-8", curl_exec($ch));
	preg_match_all($pattern_news_id, $output, $news_id);

	$newsList = array();
	for($j = 0; $j < count($news_id[1]); $j++) {
		$url = "http://ecourse.elearning.ccu.edu.tw/php/news/content.php?a_id=".$news_id[1][$j]."&system=0&PHPSESSID=".$_SESSION['PHPSESSID'];
		curl_setopt($ch, CURLOPT_URL, $url);
		$output = iconv("big5", "UTF-8", curl_exec($ch));

		$news_content = str_get_html($output);

		$newsDetail = array();
		foreach($news_content->find('td[bgcolor=#E8E8E8]') as $item) {
			array_push($newsDetail, $item->plaintext);
		}
		array_push($newsList, $newsDetail);
	}

	curl_close($ch);
?>
