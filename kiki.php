<?php
  require_once("auth.php");
  require_once('lib/getKiki.php');
  
  if ($_SESSION['timeout'] + 10 * 60 < time())
    session_destroy();

  $score = new Score($_SESSION['username'], $_SESSION['password']);

  $course_list = $score->getList();
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>Ekiki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="toy to parse kiki">
    <meta name="author" content="Jason Tsai">
    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/furatto.css" rel="stylesheet" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/nomoretable.css" rel="stylesheet" />
  </head>
  <body>
    <div class="navbar navbar-fixed-top navbar-alpha">
    <div class="navbar-inner">
     <div class="container">
      <a href="#menu" class="menu-trigger meteocon" data-meteocon="M"></a>
      <div class="nav-collapse collapse">
        <nav id="menu">
          <ul class="nav">
            <li><a class="brand" href="javascript:void(0)">Kiki</a></li>
          </ul>
          <ul class="nav pull-left">
            <li class="divider-vertical"></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cogwheel icon-white"></i> 學期選單<b class="caret bottom-up"></b></a>
              <ul class="dropdown-menu bottom-up pull-left">
<?php
  for($i = 0; $i < count($course_list); $i++) {
    echo "            <li><a href=\"#seminar".$i."\"><i class=\"icon-chevron-right\"></i> ".$course_list[$i][0]."</a></li>\n";
  }
?>
              </ul>
            </li>
          </ul>
          <ul class="nav pull-right">
            <li><a href="./logout.php">登出</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
    <div class="container">
      <div class="span12">
<?php
  for($i = 0; $i < count($course_list); $i++) {
    echo "
          <section id=\"seminar".$i."\">
            <div class=\"row\">
              <div class=\"span12\">
                <h3>".$course_list[$i][0]."</h3>
              </div>
              <div class=\"span2\">
                <div class=\"span2\"><strong>修習課堂數: </strong></br><p>".$course_list[$i][1]."</p></div>
                <div class=\"span2\"><strong>學分數: </strong></br><p>".$course_list[$i][2]."</p></div>
                <div class=\"span2\"><strong>平均: </strong></br><p>".$course_list[$i][3]."</p></div>
                <div class=\"span2\"><strong>總排名: </strong></br><p>".$course_list[$i][4]."</p></div>
              </div>
              <div class=\"span8\">";

    echo "
                <table class=\"table table-bordered table-striped nomoretable\">
                  <thead>
                    <tr class='tr-inverse'>
                      <th width=\"75x\">代碼</th>
                      <th width=\"40px\">班別</th>
                      <th>課程名稱</th>
                      <th width=\"40px\">屬性</th>
                      <th width=\"40px\">學分</th>
                      <th width=\"40px\">成績</th>
                    </tr>
                  </thead>
                  <tbody>";
    for($j = 0; $j < count($course_list[$i][5]); $j++) {
        # Light up failed subject
        # <tr"; if((float)$course_list[$i][5][$j][5] < 60.0) echo " class=\"tr-warning\""; echo ">
        echo "
                    <tr>
                      <td data-title='代碼'>".$course_list[$i][5][$j][0]."</td>
                      <td data-title='班別'>".$course_list[$i][5][$j][1]."</td>
                      <td data-title='課程名稱'>".$course_list[$i][5][$j][2]."</td>
                      <td data-title='屬性'>".$course_list[$i][5][$j][3]."</td>
                      <td data-title='學分'>".$course_list[$i][5][$j][4]."</td>
                      <td data-title='成績'>".$course_list[$i][5][$j][5]."</td>
                    </tr>";
    }
      echo "
                  </tbody>
                </table>
              </div>
            </div>
          </section>";
  }
  echo "\n";
?>
          <div class="row">
            <div class="alert span7 offset2">
              <button type="button" class="close">x</button>
              <h4 class="header">僅限資工系參考，其他系所會有錯誤</h4>
            </div>
            <div class="offset2 span3"><strong>總平均: </strong><p><?php echo round($score->getOverallAvg(), 2); ?></p></div>
            <div class="span3"><strong>系上平均: </strong><p><?php echo round($score->getRequiredAvg(), 2); ?></p></div>
            <div class="span3"><strong>通識平均: </strong><p><?php echo round($score->getLiberalAvg(), 2); ?></p></div>
          </div>
      </div>
    </div>

    <!-- script -->
    <script src="js/jquery.js"></script>
    <script src="js/jpanel.js"></script>
    <script src="js/jquery.dropkick-1.0.0.js"></script>
    <script src="js/rainbow-custom.min.js"></script>
    <script src="js/tooltip.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>
    <script src="js/picker.time.js"></script>
    <script src="js/legacy.js"></script>
    <script src="js/jquery.toolbar.js"></script>
    <script src="js/jquery.avgrund.js"></script>
    <script src="js/responsiveslides.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/jquery.icheck.js"></script>
    <script src="js/manifest.js"></script>
  </body>
</html>

