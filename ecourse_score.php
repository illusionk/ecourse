<!DOCTYPE html>
<?php
  require_once('lib/getEcourseScore.php');
?>
<html lang="zh-tw">
<head>
  <meta charset="utf-8">
  <title>Escourse</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="toy to parse ecourse">
  <meta name="author" content="Jason Tsai">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/normalize.css" rel="stylesheet" />
  <link href="css/furatto.css" rel="stylesheet" />
  <link href="css/bootstrap-responsive.css" rel="stylesheet" />
  <link href="css/nomoretable.css" rel="stylesheet" />
</head>
<body>
<?php include_once("./navbar.php"); ?>
<div class="container">
  <div class="span12">
    <?php
    for($i = 0; $i < count($scoreList); $i++) {
      echo "

      <section id=\"course".$i."\">
        <div class=\"furatto-block\">
          <div class=\"furatto-large-header\">
            <div class=\"furatto-large-container\">
              <h2 class=\"large-header\">".$scoreList[$i][1]."</h2>
              <p class=\"motto\">
              ".$scoreList[$i][0]."
              </p>
              <hr>
            </div>
          </div>

          <div class=\"row-fluid\">
            <div class=\"span2\">
              <h4>總成績: </h4><p>".$scoreList[$i][3]."</p>
              <h4>總排名: </h4><p>".$scoreList[$i][2]."</p>
            </div>
            <div class=\"span8\">";
          if (count($scoreList[$i][4]) == 0) {
            echo "
            <div class=\"alert\">
              <h4 class=\"header\">本科目並無輸入成績</h4>
            </div>";
          }
          else {
            echo "
            <table class=\"table table-bordered table-striped\">
              <thead>
                <tr class='tr-inverse'>
                  <th>項目</th>
                  <th width=\"50px\">比重</th>
                  <th width=\"40px\">分數</th>
                  <th width=\"100px\">排名</th>
                </tr>
              </thead>
              <tbody>";
            for($j = 0; $j < count($scoreList[$i][4]); $j++) {
            # Light up failed subject
            #<tr"; if((float)$scoreList[$i][4][$j][2] < 60.0) echo " class=\"tr-warning\""; echo ">
            echo "
                <tr>
                  <td data-title=\"項目\">".$scoreList[$i][4][$j][0]."</td>
                  <td data-title=\"比重\">".$scoreList[$i][4][$j][1]."</td>
                  <td data-title=\"分數\">".$scoreList[$i][4][$j][2]."</td>
                  <td data-title=\"排名\">".$scoreList[$i][4][$j][3]."</td>
                </tr>";
            }
            echo "
              </tbody>
            </table>";
          }
          echo "
          </div>
        </div>
      </section>";
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

