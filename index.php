<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <title>Escourse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="toy to parse ecourse">
    <meta name="author" content="Jason Tsai">
    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/furatto.min.css" rel="stylesheet" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet" />
  </head>
  <body>      
    <div class="container">      
      <div class="span12">
        <form id="loginForm"class="login-form centered-form" method="post" action="login.php">
          <div class="furatto-login-icon">
             <img src="img/icons/customize-icon150.png" alt="">
             <h1 class="login-header">成績查詢</h1>
          </div>
          <?php
    if ($_GET['code'] == "1") {
      echo "
        <div class=\"alert alert-danger\">
          <button type=\"button\" class=\"close\">x</button>
          <h4 class=\"header\">帳號或密碼錯誤</h4>
        </div>\n";
    }
    if ($_GET['code'] == "2") {
      echo "
        <div class=\"alert alert-info\">
          <button type=\"button\" class=\"close\">x</button>
          <h4 class=\"header\">已經登出系統</h4>
        </div>\n";
    }
?>  
          <input type="text" id="inputUsername" placeholder="學號" name="username">
          <input type="password" id="inputPassword" placeholder="密碼" name="password">
          <input type="submit" class="btn btn-primary btn-block" value="Sign in">

          <!--data-furatto='radio'-->
          <input type="radio" name="options" id="radios1" value="ecourse" data-furatto='radio' data-color="orange" checked>
          <label for="radios1" class="checkbox inline">ecourse</label>
          <input type="radio" name="options" id="radios2" value="kiki" data-furatto='radio' data-color="orange">
          <label for="radios2" class="checkbox inline">kiki</label>
        </form>
      </div>

    </div>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
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
    <script type="text/javascript">
      function ecourse() {
        document.getElementById('loginForm').action='ecourse.php';
      }
      function kiki() {
        document.getElementById('loginForm').action='kiki.php';
      }
    </script>
  </body>
</html>