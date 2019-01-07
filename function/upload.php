<?php
  // 설정
  $uploads_dir = '../file'.$_POST['dir'];

  // 변수 정리
  $error = $_FILES['tfile']['error'];
  $name = $_FILES['tfile']['name'];
  $ext = array_pop(explode('.', $name));

  // 오류 확인
  if ($error != UPLOAD_ERR_OK) {
      switch ($error) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            echo "파일이 너무 큽니다. ($error)";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "파일이 첨부되지 않았습니다. ($error)";
            break;
        default:
            echo "파일이 제대로 업로드되지 않았습니다. ($error)";
      }
      exit;
  }

  // 파일 이동
  move_uploaded_file($_FILES['tfile']['tmp_name'], $uploads_dir.$name);

  echo "<script>window.alert('업로드가 완료되었습니다.');</script>";
  echo "<script>window.location=('../cloud.php?dir=".$_POST['dir']."');</script>";
