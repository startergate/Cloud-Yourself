<?php
    // 폴더명 지정
    $dir = '../file';

    $files = [];
    $typelist = ['png', 'PNG', 'jpg', 'JPG', 'gif', 'GIF','jpeg', 'JPEG', 'bmp', 'BMP'];
    $files = getImages($dir, $files);
    function getImages($dir, $files)
    {
        // 핸들 획득
        $handle = opendir($dir);

        // 디렉터리에 포함된 파일을 저장한다.
        while (false !== ($filename = readdir($handle))) {
            if ($filename == '.' || $filename == '..') {
                continue;
            }

            if (is_file($dir.'/'.$filename)) {
                $temp = ['name'=>$filename, 'type'=>explode('.', $filename)[count(explode('.', $filename)) - 1], 'root'=>'/'.$filename];
                if (in_array($temp['type'], $typelist)) {
                    $files[] = $temp;
                }
            } else {
                $files = getImages($dir.'/'.$filename, $files);
            }
        }

        return $files;
    }

    closedir($handle);

    sort($files);
    echo json_encode(['result'=>1, 'data'=>$files]);
