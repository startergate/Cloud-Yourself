<?php
  // 설정
  $uploads_dir = $_POST['dir'];

  // 변수 정리
  $error = $_FILES['file']['error'];
  $name = $_FILES['file']['name'];
  $ext = array_pop(explode('.', $name));

  // 오류 확인
  if ($error != UPLOAD_ERR_OK) {
      switch ($error) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            echo json_encode(['result'=>0, 'error'=>'File is Too Big']);
            break;
        case UPLOAD_ERR_NO_FILE:
            echo json_encode(['result'=>0, 'error'=>'No File Detected']);
            break;
        default:
            echo json_encode(['result'=>0, 'error'=>'File is NOT Uploaded properly']);
    }
      exit;
  }

  // 파일 이동
  move_uploaded_file($_FILES['file']['tmp_name'], "$uploads_dir/$name");

  echo json_encode(['result'=>1, 'file'=>"$uploads_dir/$name"]);
