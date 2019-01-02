<?php
  header('Content-Type: application/json');
  $dir = '../file/'.$_POST['folderName'];
  try {
      $files = array_diff(scandir($dir), array('.','..'));
      foreach ($files as $file) {
          (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
      }
      rmdir($dir);
      echo json_encode(["result"=>1, "folder"=>$_POST['folderName']]);
  } catch (\Exception $e) {
      echo json_encode(["result"=>0, "error"=>$e]);
  }
