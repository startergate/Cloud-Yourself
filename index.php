<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <!-- 호환성 관련 구문 -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <!-- 보안 -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline'  ; script-src 'self' https://www.google.com https://www.gstatic.com https://www.google-analytics.com 'unsafe-inline' 'unsafe-eval'; style-src 'self' http://fonts.googleapis.com 'unsafe-inline'; img-src *; font-src 'self' https://fonts.gstatic.com ;frame-src 'self' https://www.google.com">
    <meta name="Cache-Control" content="public, max-age=60">
    <!-- CSS 관련 구문 -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style2.css">
  	<link rel="stylesheet" type="text/css" href="./css/bg_style.css">
  	<link rel="stylesheet" type="text/css" href="./css/master.css">
  	<link rel="stylesheet" type="text/css" href="./css/Normalize.css">
    <style media="screen">
      .indexTitle{
        font-size: 6.2vw;
      }
      .imgLocation{
        position: fixed;
        font-size: 10px;
        background-color:rgba(255,255,255,0.5);
        width:100px;
        padding: 5px;
        top: 10px;
        left: 10px;
      }
    </style>

    <!-- JS 관련 구문 -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src='./lib/reCaptchaEnabler.js'></script>

    <!-- 페이지 설명 구문 -->
    <meta name="description" content="Index Page of DoNote - DoNote">
    <title>DoNote Beta</title>
  </head>
  <body class='bg bge bgImg'>
    <!--[if IE]>
      <script type="text/javascript">
        alert("Internet Explorer is NOT Supported.")
      </script>
    <![endif]-->
    <p class="imgLocation">Image by Unsplash</p>
    <div id="index" class="cover full-window">
      <div class="col-sm-12 larger">
        <p class='text-center'>
          <strong class="indexTitle domi">Cloud Yourself</strong>
        </p>
        <div class="control">
          <p class='text-center'>
            <?php
              require './lib/sidUnified.php';
              session_start();
              if (!empty($_COOKIE['sidAutorizeRikka'])) {
                  $SID = new SID('donote');
                  $SID->authCheck();
              }
              if (!empty($_SESSION['pid'])) {
                  echo "<div class='white'>".$_SESSION['nickname'].'님, 돌아오셨군요!</div>';
                  echo "<script type=\"text/javascript\">setTimeout(\"location.href = './cloud.php'\", 5000);</script>";
                  echo "<div style='color:white'>곧 리다이렉트됩니다.</div>";
              } else {
                  echo "<button class='btn btn-light btn-lg' id='loginBtn1'>SID로 로그인</button>";
              }
            ?>
          </p>
        </div>
      </div>
    </div>
    <div id="login_form" class="covra covraLogin text-center" style="display:none">
      <div class="center">
        <div id="login">로그인</div>
        <div id="lotext" class="text-center">
          <br />
          <form class="center form" action="./function/login.php" method="post">
            <input type="text" class="form-control form"name="id" placeholder="아이디" required>
            <input type="password" class="form-control form"name="pw" placeholder="비밀번호" required>
            <div class="checkbox">
              <input type="checkbox" name="auto"> 자동 로그인<br>자동 로그인 기능은 쿠키를 사용합니다.
            </div>
            <div class="g-recaptcha" data-callback="saveEnable" data-expired-callback="saveDisable" data-sitekey="6LdYE2UUAAAAAH75nPeL2j1kYBpjaECBXs-TwYTA"></div>
            <br />
            <input type="submit" name="confirm_login" disabled="disabled" id="saveBtnTop" class="btn btn-light" value="로그인">
            <button class='btn btn-light' id="registerBtn">회원가입</button>
          </form>
        </div>
      </div>
    </div>
    <div id="register" class="covra covraRegister text-center" style="display:none">
      <div class="center">
        <div id="login">회원가입</div>
        <div id="lotext">
          <br />
          <form class="center form" action="./function/register.php" method="post">
            <input type="text" class="form-control form" name="id" placeholder="아이디" required>
            <input type="password" class="form-control form" autocomplete="password" name="pw" placeholder="비밀번호" required>
            <input type="password" class="form-control form" autocomplete="password" name="pwr" placeholder="비밀번호 확인" required>
            <input type="text" class="form-control form" name="nickname" placeholder="닉네임">
            <br />
            <div class="g-recaptcha" data-callback="saveEnable" data-expired-callback="saveDisable" data-sitekey="6LdYE2UUAAAAAH75nPeL2j1kYBpjaECBXs-TwYTA"></div>
            <br />
            <input type="submit" name="confirm_register" disabled="disabled" id="saveBtnBottom" class="btn btn-light" value="회원가입">
            <button class='btn btn-light' id="loginBtn2">로그인</button>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      var logTarget1 = document.getElementById('loginBtn1');
      logTarget1.addEventListener('click', function(event) {
        $("#login_form").css('display', 'block');
        $("#register").css('display', 'none');
        $("#index").css('display', 'none');
      });
      var logTarget2 = document.getElementById('loginBtn2');
      logTarget2.addEventListener('click', function(event) {
        event.preventDefault()
        $("#login_form").css('display', 'block');
        $("#register").css('display', 'none');
        $("#index").css('display', 'none');
      });
      var regTarget = document.getElementById('registerBtn');
      regTarget.addEventListener('click', function(event) {
        event.preventDefault()
        $("#register").css('display', 'block');
        $("#index").css('display', 'none');
        $("#login_form").css('display', 'none');
      });
    </script>
		<script src="./lib/jquery-3.3.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
