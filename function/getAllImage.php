<?php
    // 폴더명 지정
    $dir = "../file";

    $files = [];
    $files = getImages($dir, $files);
    function getImages($dir, $files)
    {
        // 핸들 획득
        $handle  = opendir($dir);

        // 디렉터리에 포함된 파일을 저장한다.
        while (false !== ($filename = readdir($handle))) {
            if ($filename == "." || $filename == "..") {
                continue;
            }

            // 파일인 경우만 목록에 추가한다.
            if (is_file($dir . "/" . $filename)) {
                $temp = ['name'=>$filename, 'type'=>explode('.', $filename)[count(explode('.', $filename))-1], 'root'=>"/".$filename];
                if ($temp['type'] === 'png' || $temp['type'] === 'PNG' || $temp['type'] === 'jpg' || $temp['type'] === 'JPG' || $temp['type'] === 'gif' || $temp['type'] === 'GIF' || $temp['type'] === 'jpeg' || $temp['type'] === 'bmp') {
                    $files[] = $temp;
                }
            } else {
                $files = getImages($dir."/".$filename, $files);
            }
        }
        return $files;
    }

    // 핸들 해제
    closedir($handle);

    sort($files);
    // 파일명을 출력한다.
    echo json_encode(['result'=>1, 'data'=>$files]);
