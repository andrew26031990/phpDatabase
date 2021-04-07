<?php


class Database
{
    public function makeDatabase($db_name){
        $path = '../database/';

        try{
            mkdir($path.$db_name, 0777, true);
        }catch (Exception $ex){
            if(str_contains($ex->getMessage(), 'File exists')){
                return 'База данных с таким именем уже существует';
            }
        }
    }

    public function getDatabases(){
        $path = "database";
        $databases = [];
        $dir = new DirectoryIterator($path);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                array_push($databases, $fileinfo->getFilename());
            }
        }
        return $databases;
    }

    public function removeDatabase($db){
        array_map('unlink', glob($_SERVER['DOCUMENT_ROOT']."/database/$db/*.*"));
        rmdir($_SERVER['DOCUMENT_ROOT']."/database/".$db);
        return 'База данных успешно удалена';
    }
}