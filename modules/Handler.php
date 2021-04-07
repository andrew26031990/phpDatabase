<?php
include_once 'Classes.php';
$db = new Database();
$table = new Table();

if(isset( $_POST['db_name'] )) {
    $result = $db->makeDatabase($_POST['db_name']);
    echo $result;
}

if(isset( $_POST['table_name'] )) {
    $result = $table->addTable();
    echo $result;
}

if( isset( $_POST['table'] ) && isset( $_POST['db'] )) {
    $table_name = $_POST['table'];
    $db_name = $_POST['db'];
    $result = $table->deleteTable($db_name, $table_name);
    echo $result;
}

if( isset( $_POST['database'] )) {
    $db = $_POST['database'];
    $result = $db->removeDatabase($db);
    echo $result;
}

if( isset( $_POST['fields'] ) && isset( $_POST['database-name'] ) && isset( $_POST['table-name'] )) {
    $fields = filter_input(INPUT_POST, 'fields', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $db = $_POST['database-name'];
    $tbl = $_POST['table-name'];
    $result = $table->addRow($db, $tbl, $fields);
    echo $result;
}

if( isset( $_POST['row'] ) && isset( $_POST['dbR'] ) && isset( $_POST['tableR'] )) {
    $result = $db->deleteRow($_POST['dbR'], $_POST['tableR'], $_POST['row']);
    echo $result;
}

if( isset( $_POST['com'] ) ) {
    if($_POST['com'] != ""){
        $command = explode(" ", $_POST['com']);
        switch (strtolower($command[0])) {
            case "create":
                $result = $db->makeDatabase($command[2]);
                echo $result;
                break;
            case "drop":
                if(strtolower($command[1]) == "database"){
                    $result = $db->removeDatabase($command[2]);
                    echo $result;
                }elseif (strtolower($command[1]) == "table"){
                    $result = $table->deleteTable($command[3], $command[2]);
                    echo $result;
                }
                break;
        }
    }else{
        echo "Вы ввели неверную команду";
    }

}
