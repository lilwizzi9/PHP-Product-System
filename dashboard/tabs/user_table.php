<?php

// include_once __DIR__."/../../lib/products/procucts.php";
include_once __DIR__ . "/../../lib/users/users.php";

$page = 0;
if(isset($_GET["page"])){
    if(is_numeric($_GET["page"])&$_GET["page"]>0){
        $page =$_GET["page"];
    }
}

$users = Users::All(["id", "username", "email"],$page);

?>



<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable with minimal features &amp; hover style</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6"></div>
                <div class="col-sm-12 col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Index</th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">User Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                            foreach ($users as $key => $user) {
                                # code...
                            
                            ?>
                            <tr class="odd">
                                
                                    <td class="dtr-control sorting_1" tabindex="0"><?php echo $key?></td>
                                    <td><?php echo $user["username"]?></td>
                                    <td><?php echo $user["email"]?></td>
                                    <td>
                                        <a type="button" class="btn btn-block btn-success">Update</a>
                                        <a type="button" class="btn btn-block btn-danger">Delete</a>
                                    </td>
                                
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Index</th>
                                <th rowspan="1" colspan="1">User Name</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                        <ul class="pagination">
                            <li class="paginate_button page-item previous <?php
                                if($page<1){
                                    echo "disabled"; 
                                }
                            ?>" id="example2_previous"><a href="?section=Users&page=<?php echo $page-1;?>" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                            <li class="paginate_button page-item next" id="example2_next"><a href="?section=Users&page=<?php echo $page+1;?>" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>