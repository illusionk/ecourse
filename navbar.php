<?php

  if ($_SESSION['timeout'] + 10 * 60 < time())
    session_destroy();
  require_once('lib/courseList.php');

?>
  <div class="navbar navbar-fixed-top navbar-alpha">
    <div class="navbar-inner">
     <div class="container">
      <a href="#menu" class="menu-trigger meteocon" data-meteocon="M"></a>
      <div class="nav-collapse collapse">
        <nav id="menu">
          <ul class="nav">
            <li><a class="brand" href="javascript:void(0)">Ecourse</a></li>
          </ul>
          <ul class="nav pull-left">
            <li class="divider-vertical"></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cogwheel icon-white"></i> 成績<b class="caret bottom-up"></b></a>
              <ul class="dropdown-menu bottom-up pull-left">
<?php
            for($i = 0; $i < count($course_list); $i++) {
              echo "
                <li><a href=\"./ecourse_score.php#course".$i."\"><i class=\"icon-chevron-right\"></i> ".$course_list[$i][1]."</a></li>\n";
            }
?>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cogwheel icon-white"></i> 公告<b class="caret bottom-up"></b></a>
              <ul class="dropdown-menu bottom-up pull-left">
<?php
            for($i = 0; $i < count($course_list); $i++) {
              echo "
                <li><a href=\"./bull.php?id=".$course_list[$i][0]."\"><i class=\"icon-chevron-right\"></i> ".$course_list[$i][1]."</a></li>\n";
            }
?>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cogwheel icon-white"></i> 學生名單<b class="caret bottom-up"></b></a>
              <ul class="dropdown-menu bottom-up pull-left">
<?php
            for($i = 0; $i < count($course_list); $i++) {
              echo "
                <li><a href=\"./student.php?id=".$course_list[$i][0]."\"><i class=\"icon-chevron-right\"></i> ".$course_list[$i][1]."</a></li>\n";
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