<?php
  // 다운로드 (Ajax)
  $dir = '../file/'.$_GET['fileName'];
  $check = file_exists($dir);
  $isFile = is_file($dir);
  if ($check && $isFile) {
      function mb_basename($path)
      {
          return end(explode('/', $path));
      }
      function utf2euc($str)
      {
          return iconv('UTF-8', 'cp949//IGNORE', $str);
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
          $filesize = filesize($dir);
          $filename = mb_basename($dir);
          if (is_ie()) {
              $filename = utf2euc($dir);
          }

          header('Pragma: public');
          header('Expires: 0');
          header('Content-Type: application/octet-stream');
          header('Content-Description: File Transfer');
          header("Content-Disposition: attachment; filename=\"$filename\"");
          header('Content-Transfer-Encoding: binary');
          header("Content-Length: $filesize");
          header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          readfile($dir);
          $fp = fopen($dir, "r");
          fpassthru($fp);
          fclose($fp);
      } catch (\Exception $e) {
          header('Content-Type: application/json');
          echo json_encode(['result'=>-1, 'error'=>$e]);
      }
  } else {
      header('Content-Type: application/json');
      echo json_encode(['result'=>0, 'error'=>'File Does Not Exist.', 'data'=>$_POST]);
  }
