<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Добавить таблицу</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php if(isset($_GET['db'])){ ?>
<section class="content">
    <div class="container-fluid">
        <form id="tableCreation">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Название таблицы</label>
                                <input type="text" class="form-control" name="table_name" required>
                            </div>
                            <input type="hidden" value="<?php echo $_GET['db']; ?>" name="db">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body columns">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="id" readonly value="ID">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="submit_add_table">Создать таблицу</button>
                                <button type="button" class="btn btn-success clone">Добавить колонку</button>
                            </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
        </form>
        <div class="input-group mb-3 tobecloned" style="display: none">
            <input type="text" class="form-control column" required placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-danger delete_column" type="button" id="button-addon2">Удалить колонку</button>
        </div>
    </div>
</section>
<?php }else{
    echo 'Не выбрана база данных';
} ?>