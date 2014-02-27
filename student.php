<!DOCTYPE html>
<?php
  require_once("auth.php");
  $_SESSION['id'] = $_GET['id'];
  require_once('lib/getStudentList.php');
?>
<html lang="zh-tw">
<head>
<meta charset="utf-8">
<title>Escourse</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="toy to parse ecourse" name="description">
<meta content="Jason Tsai" name="author">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
<link href="css/normalize.css" rel="stylesheet">
<link href="css/furatto.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/nomoretable.css" rel="stylesheet">
<link href="css/modern.css" rel="stylesheet">
<link href="css/modern-responsive.css" rel="stylesheet">
</head>
<body>
<?php include_once("./navbar.php"); ?>
<div class="container metrouicss">
  <div class="span12 offset2 row-fluid" style="padding-top:20px;">
    <?php
      for($i = 0; $i < count($studentList[0]); $i++) {
          echo "
          <div class=\"tile"; 
          if($studentList[5][$i] == "男") 
            echo " bg-color-blueDark"; 
          else
            echo " bg-color-red";
          echo "\">
            <div class=\"tile-content\">
              <h1>".$studentList[3][$i]."</h1><br/>
              <h1>".$studentList[2][$i]."</h1><br/>
              <h2>".$studentList[1][$i]."</h2>
            </div>
            <div class=\"brand\">
              <div class=\"name\">".$studentList[0][$i]."</div>
            </div>
          </div>
          "; 
      } 
      echo "\n"; 
?>
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