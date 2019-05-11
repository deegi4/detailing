<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkExamples extends Controller
{
    //
    public function show()
    {
        $images = [];


        $dirpath = 'img';
        $cdir = scandir($dirpath);
        foreach ($cdir as $value) {
            // если это "не точки" и не директория
            if (!in_array($value,array(".", ".."))
//                && !is_dir($dirpath . DIRECTORY_SEPARATOR . $value)
                && !is_dir($dirpath . DIRECTORY_SEPARATOR . $value)) {
                $info = getimagesize ( $dirpath . DIRECTORY_SEPARATOR . $value, $imageinfo );
                $image['src'] = $dirpath.'/'.$value;
                $image['width'] = $info[0];
                $image['height'] = $info[1];
//                $image['info'] = $info;
//                $image['imageinfo'] = $imageinfo;
                $images[] = $image;
            }
        }


        return view('work_examples')->with([
            'images' => $images,
        ]);
    }
}
