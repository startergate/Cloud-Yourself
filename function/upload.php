<?php
  // 설정
  $uploads_dir = '../file'.$_POST['dir'];

  $count = 0;
  foreach ($_FILES['tfile']['name'] as $filename) {
      // 변수 정리
      $error = $_FILES['tfile']['error'][$count];
      $name = $_FILES['tfile']['name'][$count];
      $nameArray = explode('.', $name);
      $ext = array_pop($nameArray);

      // 오류 확인
      if ($error != UPLOAD_ERR_OK) {
          echo "<script>window.alert('에러가 발생했습니다 ($error)');</script>";
          echo "<script>window.location=('../cloud.php?dir=".$_POST['dir']."');</script>";
          exit;
      }

      // 파일 이동
      move_uploaded_file($_FILES['tfile']['tmp_name'][$count], $uploads_dir.$name);
      chmod($uploads_dir.$name, 0777);
      $count++;
  }

  echo "<script>window.alert('업로드가 완료되었습니다.');</script>";
  echo "<script>window.location=('../cloud.php?dir=".$_POST['dir']."');</script>";
