<?php 
	session_start();
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['cookie'] = tempnam('~/.tmp','cookie');

	if($_POST['options'] == "ecourse"){
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

		if (preg_match("/PHPSESSID/", $login_result)) {

			# 取得 PHPSESSID =====================================================
			preg_match("/PHPSESSID=(.+?)&/", $login_result, $PHPSESSID_unslice);
			$_SESSION['PHPSESSID'] = $PHPSESSID_unslice[1];
			$_SESSION['timeout'] = time();
			$_SESSION['idy'] = true;
			header('Location: ecourse_score.php');
		}
		else {
			curl_close($ch);
			session_unset();
		    session_destroy();
		    header('Location: index.php?code=1');
		}
	}
	else {

		$ch = curl_init();
		$options = array(
					CURLOPT_URL 			=> "http://kiki.ccu.edu.tw/~ccmisp06/cgi-bin/Query/Query_grade.php",
				 	CURLOPT_HEADER 			=> false,
				  	CURLOPT_POST 			=> true,
				  	CURLOPT_POSTFIELDS 		=> "id=".$_SESSION['username']."&password=".$_SESSION['password'],
				  	CURLOPT_USERAGENT		=> "Mozilla",
				  	CURLOPT_FOLLOWLOCATION 	=> true,
				  	CURLOPT_RETURNTRANSFER 	=> true);
		curl_setopt_array($ch, $options);

		$output = curl_exec($ch);

		if (preg_match("/HTTP-EQUIV=\"expires\"/", $output)) {
			curl_close($ch);
			session_unset();
		    session_destroy();
		    header('Location: index.php?code=1');
		}
		else {
			$_SESSION['timeout'] = time();
			$_SESSION['idy'] = true;
			header('Location: kiki.php');
		}
	}
?>