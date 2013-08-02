<?php

	require_once('simple_html_dom.php');
	session_start();

	class Score {

		private $courseList;
		private $success;
		private $overallAvg;
		private $requiredAvg;
		private $liberalAvg;

		public function Score($username, $password) {

			// Init
			$this->success = false;

			$ch = curl_init();
			$options = array(
						CURLOPT_URL 			=> "http://kiki.ccu.edu.tw/~ccmisp06/cgi-bin/Query/Query_grade.php",
					 	CURLOPT_HEADER 			=> false,
					  	CURLOPT_POST 			=> true,
					  	CURLOPT_POSTFIELDS 		=> "id=".$username."&password=".$password,
					  	CURLOPT_USERAGENT		=> "Mozilla",
					  	CURLOPT_FOLLOWLOCATION 	=> true,
					  	CURLOPT_RETURNTRANSFER 	=> true);
			curl_setopt_array($ch, $options);

			$output = curl_exec($ch);
			//var_dump($output);
			if (preg_match("/HTTP-EQUIV=\"expires\"/", $output)) {
				$this->success = false;
				echo "wrong password";
			}
			else {
				$this->success = true;

				// 分開把每學期的資料存入一個陣列
				preg_match_all("/(<H3>.+?)<P>&nbsp;/s", $output, $seminarData);

				// 將每學期要的資訊 Parse 出來儲存
				$seminarList = array();

				$totalScoreSum		= 0;
				$totalCreditSum		= 0;
				$requiredScoreSum	= 0;
				$requiredCreditSum	= 0;
				$liberalScoreSum	= 0;
				$liberalCreditSum	= 0;

				for($i = 0; $i < count($seminarData[1]); $i++){
					$seminarSingle = array();
					
					// 取得學期名
					preg_match("/<H3>(.+?)<\/H3>/", $seminarData[1][$i], $seminarName);
					array_push($seminarSingle, $seminarName[1]);

					// 取得學期修習課堂數、學分數、平均、排名
					if (preg_match("/\([^0-9]*([0-9]+)[^0-9]*\)/", $seminarData[1][$i])) {
						preg_match("/<\/TABLE>[^0-9]*([0-9]+)[^0-9]*([0-9]+)[^0-9]*([0-9.]*).*\([^0-9]*([0-9]+)[^0-9]*\)/", $seminarData[1][$i], $total);
						array_push($seminarSingle, $total[1], $total[2], $total[3], $total[4]);
					}
					else {
						preg_match("/<\/TABLE>[^0-9]*([0-9]+)[^0-9]*([0-9]+)[^0-9]*([0-9.]*).*/", $seminarData[1][$i], $total);
						array_push($seminarSingle, $total[1], $total[2], $total[3], "NaN");
					}

					// 取得該學期科目細項
					$courseScoreList = array();
					
					preg_match_all("/<TR><TD>([0-9]+)<\/TD><TD>([0-9]+)<\/TD><TD>(.+?)<\/TD><TD>(.+?)<\/TD><TD>([0-9]+)<\/TD><TD>([0-9]+)<\/TD>/", $seminarData[1][$i], $courseDetail);
					for($j = 0; $j < count($courseDetail[0]); $j++) {
						$courseScore = array();

						// Overall
						$totalCreditSum += (int)$courseDetail[5][$j];
						$totalScoreSum	+= (int)$courseDetail[6][$j] * (int)$courseDetail[5][$j];
						// Required
						if (preg_match("/^(410|210)[0-9]{4}$/", $courseDetail[1][$j])){
							//var_dump($courseDetail);
							$requiredCreditSum += (int)$courseDetail[5][$j];
							$requiredScoreSum += (int)$courseDetail[6][$j] * (int)$courseDetail[5][$j];
						}
						// Liberal
						if (preg_match("/\x{901a}\x{8b58}/u", $courseDetail[4][$j])){
							$liberalCreditSum += (int)$courseDetail[5][$j];
							$liberalScoreSum += (int)$courseDetail[6][$j] * (int)$courseDetail[5][$j];
						}
						array_push($courseScore, $courseDetail[1][$j], $courseDetail[2][$j], $courseDetail[3][$j], $courseDetail[4][$j], $courseDetail[5][$j], $courseDetail[6][$j]);
						array_push($courseScoreList, $courseScore);
					}
					array_push($seminarSingle, $courseScoreList);

					array_push($seminarList, $seminarSingle);
				}
				$this->overallAvg = (float)$totalScoreSum / (float)$totalCreditSum;
				$this->requiredAvg = (float)$requiredScoreSum / (float)$requiredCreditSum;
				$this->liberalAvg = (float)$liberalScoreSum / (float)$liberalCreditSum;
				$this->courseList = $seminarList;
			}

			curl_close($ch);
		}

		public function getSuccess(){
			return $this->success;
		}
		public function getList() {
			return $this->courseList;
		}
		public function getOverallAvg() {
			return $this->overallAvg;
		}
		public function getRequiredAvg() {
			return $this->requiredAvg;
		}
		public function getLiberalAvg() {
			return $this->liberalAvg;
		}
	}
?>