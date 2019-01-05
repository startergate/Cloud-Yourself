<?php
  header('Content-Type: application/json');
  $dir = '../file/'.$_POST['folderName'];

  try {
      (is_dir($dir)) ? delTree($dir) : unlink($dir);
      echo json_encode(['result'=>1, 'target'=>$_POST['folderName']]);
  } catch (\Exception $e) {
      echo json_encode(['result'=>0, 'error'=>$e]);
  }

  function delTree($dir)
  {
      $files = array_diff(scandir($dir), ['.', '..']);
      foreach ($files as $file) {
          (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
      }
      rmdir($dir);
  }
