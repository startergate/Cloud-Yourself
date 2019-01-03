<?php
  // 다운로드 (Ajax)
  $dir = "../file/".$_POST['fileName'];
  $check = file_exists($dir);
  if ($check) {
      function mb_basename($path)
      {
          return end(explode('/', $path));
      }
      function utf2euc($str)
      {
          return iconv("UTF-8", "cp949//IGNORE", $str);
      }
      function is_ie()
      {
          if (!isset($_SERVER['HTTP_USER_AGENT'])) {
              return false;
          }
          if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
              return true;
          } // IE8
          if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.1') !== false) {
              return true;
          } // IE11
          return false;
      }
      try {
          $filepath = $dir;
          $filesize = filesize($filepath);
          $filename = mb_basename($filepath);
          if (is_ie()) {
              $filename = utf2euc($filename);
          }

          header("Pragma: public");
          header("Expires: 0");
          header("Content-Type: application/octet-stream");
          header("Content-Disposition: attachment; filename=\"$filename\"");
          header("Content-Transfer-Encoding: binary");
          header("Content-Length: $filesize");

          readfile($filepath);
      } catch (\Exception $e) {
          echo json_encode(['result'=>0, 'error'=>'File Does Not Exist.']);
      }
  } else {
      echo json_encode(['result'=>0, 'error'=>'File Does Not Exist.']);
  }
