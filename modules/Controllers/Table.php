<?php


class Table
{
    public function getTables($db_name){
        $path = "database/".$db_name;
        $databases = [];
        $dir = new DirectoryIterator($path);
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDir() && !$fileinfo->isDot()) {
                array_push($databases, substr($fileinfo->getFilename(), 0, -4));
            }
        }
        return $databases;
    }

    public function addTable(){
        $table_name = $_POST['table_name'];
        $db_name = $_POST['db'];
        try{
            if($table_name != ""){
                if($this->tableExist($db_name,$table_name)){
                    return 'Таблица с таким именем существует базе данных '.$db_name;
                }else{
                    return $this->createTable($db_name,$table_name);
                }
            }else{
                return 'Имя таблицы не может быть пустым';
            }
        }catch (Exception $ex){
            return $ex->getMessage();
        }
    }

    private function tableExist($db_name, $table_name){
        return file_exists($_SERVER["DOCUMENT_ROOT"]."/database/".$db_name."/".$table_name.".csv");
    }

    private function createTable($db_name,$table_name){
        $row = [];
        foreach ($_POST as $key=>$value){
            if($key != 'table_name' && $key != 'db'){
                array_push($row, $value);
            }
        }

        $csv[0] = $row;

        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/database/'.$db_name.'/'.$table_name.'.csv', 'w+');
        foreach ($csv as $line) {
            fputcsv($fp, $line, ',');
        }
        fclose($fp);
        return 'Таблица '.$table_name.' была успешно создана';
    }

    public function deleteTable($db_name, $table_name){
        if(unlink($_SERVER['DOCUMENT_ROOT'].'/database/'.$db_name.'/'.$table_name.'.csv')){
            return "Таблица была успешно удалена";
        }else{
            return "Ошибка удаления таблицы";
        }
    }

    public static function getColumns($db_name, $table_name){
        $csv = array();
        if(($handle = fopen($_SERVER['DOCUMENT_ROOT'].'/database/'.$db_name.'/'.$table_name.'.csv', "r")) !== FALSE)
        {
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $csv[] = $data;
            }
        }
        fclose($handle);
        return $csv[0];
    }

    public  static  function readCSV($db_name, $table_name) {
        $csv = array_map('str_getcsv', file($_SERVER['DOCUMENT_ROOT'].'/database/'.$db_name.'/'.$table_name.'.csv'));
        return $csv; //remove headers
    }

    public function addRow($db_name, $table_name, $fields){
        $last_id = $this->getLastId($db_name, $table_name);
        if($last_id == "ID"){
            $handle = fopen($_SERVER['DOCUMENT_ROOT'].'/database/'.$db_name.'/'.$table_name.'.csv', "a");
            array_unshift($fields, "1");
            fputcsv($handle, $fields);
            fclose($handle);
        }else{
            $handle = fopen($_SERVER['DOCUMENT_ROOT'].'/database/'.$db_name.'/'.$table_name.'.csv', "a");
            array_unshift($fields, intval($last_id)+1);
            fputcsv($handle, $fields);
            fclose($handle);
        }
        return $this->getLastId($db_name, $table_name);
    }

    public function deleteRow($db_name, $table_name, $rowId){
        $handle = fopen($_SERVER['DOCUMENT_ROOT'].'/database/'.$db_name.'/'.$table_name.'.csv', "w+");
        if($handle !== FALSE)
        {
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                if($rowId != $data[0]){
                    fputcsv($handle, $data);
                }
            }
        }
        fclose($handle);
        return 'Запись была успешно удалена';
    }

    private function getLastId($db_name, $table_name){
        $rows = file($_SERVER['DOCUMENT_ROOT'].'/database/'.$db_name.'/'.$table_name.'.csv');
        $last_row = array_pop($rows);
        $data = str_getcsv($last_row);
        return $data[0];
    }
}