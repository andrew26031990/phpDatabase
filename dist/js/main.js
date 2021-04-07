$(document).ready(function () {
    //window.location.reload();
    $('#add_database').click(function (e) {
        e.preventDefault();
        var db_name = prompt("Ввведите имя базы данных");

        if (db_name != null && checkDBName(db_name)) {
            $.ajax({
                type: "POST",
                data: {
                    db_name:db_name
                },
                url: "../../modules/Handler.php",
                dataType: "html",
                async: false,
                success: function(data) {
                    if(data !== "success" && data !== ""){
                        alert(data);
                    }
                    window.location.reload();
                }
            });
        }else{
            alert("Неверное имя базы данных");
        }
    });

    $(".clone").click(function (e) {
        e.preventDefault();
        $( ".tobecloned" ).clone().removeClass("tobecloned").removeAttr("style").appendTo( ".columns" );
    });

    $(document).on("click", ".delete_column", function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    $(document).on("keyup", ".column", function (e) {
        e.preventDefault();
        let id = $(this).val();
        $(this).prop("name", id);
    });

    $('.deleteDatabase').click(function (e) {
        e.preventDefault();
        let db = $(this).attr('db');
        let confirmDelete = confirm("Вы действительно хотите удалить базу данных " + db + "? Все таблицы будут также удалены");
        if (confirmDelete === true) {
            $.ajax({
                type: "POST",
                data: {
                    database: db
                },
                url: "../../modules/Handler.php",
                dataType: "html",
                async: false,
                success: function (data) {
                    window.location.href = "/";
                }
            });
        }
    });

    $('.deleteTable').click(function (e) {
        e.preventDefault();
        let table = $(this).attr('table');
        let db = $(this).attr('db');
        let confirmDelete = confirm("Вы действительно хотите удалить таблицу " + table);
        if (confirmDelete === true) {
            $.ajax({
                type: "POST",
                data: {
                    table:table,
                    db:db,
                },
                url: "../../modules/Handler.php",
                dataType: "html",
                async: false,
                success: function(data) {
                    window.location.reload();
                }
            });
        }
    });

    $("#submit_add_table").click( function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            data: $("#tableCreation").serialize(),
            url: "../../modules/Handler.php",
            dataType: "html",
            async: false,
            success: function(data) {
                alert(data);
                window.history.back();
            }
        });
    });

    $("form#add-row-to-table").submit( function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '../../modules/Handler.php',
            data: $("form#add-row-to-table").serialize(),
            success: function(data) {
                window.history.back();
            }
        });
    });

    $(".deleteRow").click( function(e) {
        e.preventDefault();
        let rowId = $(this).attr('rowId');
        let table = $(this).attr('table');
        let db = $(this).attr('db');
        let confirmDelete = confirm("Вы действительно хотите удалить эту запись");
        if (confirmDelete === true) {
            $.ajax({
                type: "POST",
                data: {
                    row:rowId,
                    tableR:table,
                    dbR:db,
                },
                url: "../../modules/Handler.php",
                dataType: "html",
                async: false,
                success: function(data) {
                    alert(data);
                    window.location.reload();
                }
            });
        }
    });

    $(".command").click( function(e) {
        e.preventDefault();
        let command = $("input[name='command']").val();
        if(command === ""){
            alert('Напишите команду');
        }else{
            $.ajax({
                type: 'POST',
                url: '../../modules/Handler.php',
                data: {
                    com:command,
                },
                success: function() {
                    window.location.reload();
                }
            });
        }

    });


})

function checkDBName(key){
    var regex = new RegExp("^[0-9a-zA-Z$_]+$");
    if (!regex.test(key)) {
        return false;
    }else{
        return true;
    }
}

function checkTableName(key){
    var regex = new RegExp("^[0-9a-zA-Z]+$");
    if (!regex.test(key)) {
        return false;
    }else{
        return true;
    }
}