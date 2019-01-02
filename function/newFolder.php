<?php
  // 새폴더 생성 (Ajax)
  header('Content-Type: application/json');
  try {
      $dir = '../file/'.$_POST['folderName'];
      mkdir($dir, 0777, true);
      echo json_encode(["result"=>1, "folder"=>$_POST['folderName']]);
  } catch (\Exception $e) {
      echo json_encode(["result"=>0, "error"=>$e]);
  }
