<?php
  header('Content-Type: application/json');
  $dir = '../file/'.$_POST['folderName'];
  try {
      $fs = opendir($dir);
      $filelist = scandir($dir);
      $fileElements = [];
      foreach ($filelist as $file) {
          if ($file === '.' || $file === '..') {
              continue;
          }
          if (is_dir("$dir/$file")) {
              $fileElements[] = ["type"=>"dir","name"=>$file];
          } else {
              $filetype = explode('.', $file);
              $fileElements[] = ["type"=>$filetype[count($filetype)-1],"name"=>$file];
          }
      }

      echo json_encode(['result'=>1, 'data'=>$fileElements]);
  } catch (\Exception $e) {
      echo json_encode(["result"=>0, "error"=>$e]);
  }
