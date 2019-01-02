<?php
  require '../lib/sidUnified.php';
  session_start();
  if ($_POST['confirm_register'] === '회원가입') {
      if (!empty($_POST['id'])) {
          if (!empty($_POST['pw'])) {
              $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);
              $SID = new SID('donote');
              if ($_POST['pw'] === $_POST['pwr']) {
                  $_SESSION['temp'] = $_POST['id'];
                  $pid = $SID->register($_POST['id'], $_POST['pw'], $_POST['nickname']);
                  switch ($pid) {
                    case 0:
                      echo "<script>window.alert('오류가 발생했습니다.');</script>";
                      break;
                    case -1:
                      echo "<script>window.alert('이미 있는 아이디입니다.');</script>";
                      break;
                    default:
                      echo "<script>window.alert('회원가입이 완료되었습니다. 로그인 해주세요.');</script>";
                      echo "<script>window.location=('../');</script>";
                      break;
                  }
              } else {
                  echo "<script>window.alert('비밀번호를 정확히 재입력해주세요.');</script>";
              }
          } else {
              echo "<script>window.alert('비밀번호가 입력되지 않았습니다.');</script>";
          }
      } else {
          echo "<script>window.alert('아이디가 입력되지 않았습니다.');</script>";
      }
      echo "<script>window.location=('../');</script>";
      exit;
  } else {
      header('Location: ./error_confirm.php');
      exit;
  }
