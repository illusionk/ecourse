<!DOCTYPE html>
<?php
  
  session_start();
  $_SESSION['id'] = $_GET['id'];
  require_once('lib/bullit.php');
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
</head>
<body>
<?php include_once("./navbar.php"); ?>
<div class="container">
  <div class="span12">
    <?php
        for($i = 0; $i < count($newsList); $i++) {
          echo "
          <div class=\"furatto-block\">
          <section id=\"news".$i."\">
            <div class='\"span 10 row\"'>
              <div class='\"span10\"'>
                <h3>".$newsList[$i][0]."</h3>
                <h4>".$newsList[$i][1]."</h4>
              </div>
              <div class=\"row\" style=\"padding-left:60px;padding-right:' 0px;\">
                <div class=\"span10\">
                  <table class=\"table\">
                    <tbody>
                    <tr>
                      <td>
                        <p>".$newsList[$i][2]."</p>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
          </div>"; } echo "\n"; 
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