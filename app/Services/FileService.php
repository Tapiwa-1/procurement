<?php

namespace App\Services;

use Image;


class FileService
{
    public function updateFile( $model, $request, $type){
        //use a package called image intervention
        if (!empty($model->file)){ //if file is empty
            $currentFile = public_path() . $model->file; //get the file
            if (file_exists($currentFile) && $currentFile != public_path() . '/user-placeholder.png') {
                unlink($currentFile); //delete the file
            }
        }
        $file = null;
        if ($type === "user") {
            //given its a user
            $file = Image::make($request->file('file'))->resize(400, 400);
        } else {
            $file = Image::make($request->file('file'));
    
        }
        $ext = $request->file('file'); //get file extension
        $extension = $ext->getClientOriginalExtension();
        $name = time() . '.' . $extension; //rename  with time
        $file->save(public_path() . '/file/' . $name);
        $model->file = '/file/' .$name;

        return $model;
    }
}