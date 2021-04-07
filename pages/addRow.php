<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Add Row</h3>
    </div>
    <div class="card-body">
        <form id="add-row-to-table">
            <div class="row">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <?php
                        foreach (Table::getColumns($_GET['db'],$_GET['table']) as $key => $table){
                            if($key > 0){
                            ?>

                            <th><?php echo $table ?></th>

                        <?php }} ?>
                    </tr>
                    </thead>
                    <tr>
                        <?php for($i=1;$i<$_GET['data'];$i++) { ?>
                            <td><input name="fields[]"></td>
                        <?php } ?>
                    </tr>

                </table>
            </div>
            <input type="hidden" value="<?php echo $_GET['db'] ?>" name="database-name">
            <input type="hidden" value="<?php echo $_GET['table'] ?>" name="table-name">
            <button type="submit">Добавить</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>