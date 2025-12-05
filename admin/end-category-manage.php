<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View End Level Categories</h1>
    </div>
    <div class="content-header-right">
        <a href="end-category-manage-add.php" class="btn btn-primary btn-sm">Add New</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="30">#</th>
                                <th>Banner</th>
                                <th width="180">End Category</th>
                                <th width="150">Mid Category</th>
                                <th>Short Desc</th>
                                <th>Images</th>
                                <th width="140">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT 
                                t1.ecat_id,
                                t1.ecat_name,
                                t1.ecat_image,
                                t1.ecat_des,
                                t1.ecat_image1,
                                t1.ecat_image2,
                                t1.ecat_image3,
                                t1.ecat_image4,
                                t2.mcat_name
                                FROM tbl_end_category t1
                                JOIN tbl_mid_category t2
                                ON t1.mcat_id = t2.mcat_id
                                ORDER BY t1.ecat_id DESC
                            ");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <?php if(!empty($row['ecat_image'])): ?>
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['ecat_image']); ?>" style="width:80px; height:50px; object-fit:cover; border-radius:3px;">
                                        <?php else: ?>
                                            <span style="color:#999;">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row['ecat_name']; ?></td>
                                    <td><?php echo $row['mcat_name']; ?></td>
                                    <td><?php echo substr($row['ecat_des'], 0, 50); ?></td>
                                    <td>
                                        <?php
                                        $img_count = 0;
                                        for($j=1; $j<=4; $j++) {
                                            if(!empty($row["ecat_image$j"])) $img_count++;
                                        }
                                        echo $img_count . " section(s)";
                                        ?>
                                    </td>
                                    <td>
                                        <a href="end-category-manage-edit.php?id=<?php echo $row['ecat_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="#" class="btn btn-danger btn-xs" data-href="end-category-manage-delete.php?id=<?php echo $row['ecat_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>

<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
