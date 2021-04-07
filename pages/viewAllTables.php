<?php $db = $_GET['db']; ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Список таблиц в базе данных <?php echo $db?></h1>
            </div>
            <div class="col-sm-6">
                <h1><a class="btn btn-danger deleteDatabase" db="<?php echo $db?>">Удалить базу данных</a></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Название таблицы</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $tables = new Table();
                                if(count($tables->getTables($db)) == 0){
                            ?>
                                    <tr>
                                        <td>Нет таблиц в базе</td>
                                        <td><a class="btn btn-primary" href="index.php?param=addTable&db=<?php echo $db?>">Добавить таблицу</a></td>
                                    </tr>
                            <?php } ?>
                            <?php
                                $tables = new Table();
                                foreach ($tables->getTables($db) as $table){
                            ?>
                                    <tr>
                                        <td><?php echo $table ?></td>
                                        <td><a class="btn btn-primary" href="index.php?param=viewTable&table=<?php echo $table ?>&db=<?php echo $db ?>">Просмотр таблицы</a>&nbsp;<a class="btn btn-danger deleteTable" table="<?php echo $table ?>" db="<?php echo $db ?>">Удаление таблицы</a></td>
                                    </tr>
                            <?php } ?>
                            <?php
                            $tables = new Table();
                            if(count($tables->getTables($db)) > 0){
                                ?>
                                <tr>
                                    <td></td>
                                    <td><a class="btn btn-success" href="index.php?param=addTable&db=<?php echo $db?>">Добавить таблицу</a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

