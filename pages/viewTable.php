<?php $db = $_GET['db']; $table_name =  $_GET['table']; $data = count(Table::readCSV($db,$table_name)[0]);?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Данные в таблице <?php echo $table_name ?></h1>
            </div>
            <div class="col-sm-6">
                <h1><a class="btn btn-success" href="/index.php?param=addRow&table=<?php echo $table_name ?>&db=<?php echo $db ?>&data=<?php echo $data ?>">Добавить запись</a></h1>
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
                            <?php
                            foreach (Table::getColumns($db,$table_name) as $table){
                                ?>

                                    <th><?php echo $table ?></th>

                            <?php } ?>
                            <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $count = count(Table::readCSV($db,$table_name));
                            for ($c=1; $c < $count; $c++){
                                ?>
                            <tr>
                                <?php
                                $count_col = count(Table::readCSV($db,$table_name)[$c]);
                                for ($d=0; $d < $count_col; $d++){
                                ?>
                                    <td><?php echo Table::readCSV($db,$table_name)[$c][$d] ?></td>
                                <?php } ?>
                                <td><a rowId="<?php echo $c ?>" db="<?php echo $db ?>" table="<?php echo $table_name ?>" class="btn btn-danger deleteRow">Удалить запись</a> </td>
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

