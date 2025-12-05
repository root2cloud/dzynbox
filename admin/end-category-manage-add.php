<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add End Level Category</h1>
    </div>
    <div class="content-header-right">
        <a href="end-category-manage.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if(isset($error_message)): ?>
            <div class="callout callout-danger">
                <p><?php echo $error_message; ?></p>
            </div>
            <?php endif; ?>

            <?php if(isset($success_message)): ?>
            <div class="callout callout-success">
                <p><?php echo $success_message; ?></p>
            </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="box box-info">
                    <div class="box-body">
                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">End Category Name <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="ecat_name" required>
                            </div>
                        </div>

                        <!-- Mid Category Selection -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Select Mid Level Category <span>*</span></label>
                            <div class="col-sm-6">
                                <select name="mcat_id" class="form-control" required>
                                    <option value="">Select Mid Category</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_mid_category ORDER BY mcat_name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        ?>
                                        <option value="<?php echo $row['mcat_id']; ?>"><?php echo $row['mcat_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Banner Image -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Banner Image</label>
                            <div class="col-sm-6">
                                <input type="file" name="ecat_image" accept="image/*">
                                <div style="font-size:11px; color:#999;">Displayed as page banner background</div>
                            </div>
                        </div>

                        <!-- Short Description (Banner Text) -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Short Description <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="ecat_des" placeholder="e.g., hello" required>
                                <div style="font-size:11px; color:#999;">Displayed on banner image</div>
                            </div>
                        </div>

                        <!-- Long Description -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Long Description</label>
                            <div class="col-sm-6">
                                <textarea name="ecat_long_des" class="form-control" rows="6" placeholder="Detailed category description"></textarea>
                                <div style="font-size:11px; color:#999;">Displayed below banner</div>
                            </div>
                        </div>

                        <hr style="margin: 30px 0; border-top: 2px solid #ddd;">
                        <h4 style="margin-left: 15px; color: #333;">Additional Image Sections (Up to 4)</h4>

                        <?php for($i = 1; $i <= 4; $i++): ?>
                        <div style="background: #f9f9f9; padding: 20px; margin: 15px 0; border-radius: 5px;">
                            <h5 style="color: #555; margin-bottom: 15px;">Section <?php echo $i; ?></h5>
                            
                            <!-- Image -->
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Image <?php echo $i; ?></label>
                                <div class="col-sm-6">
                                    <input type="file" name="ecat_image<?php echo $i; ?>" accept="image/*">
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Title <?php echo $i; ?></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="ecat_image<?php echo $i; ?>_title" placeholder="Section title">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Description <?php echo $i; ?></label>
                                <div class="col-sm-6">
                                    <textarea name="ecat_image<?php echo $i; ?>_desc" class="form-control" rows="4" placeholder="Section description"></textarea>
                                </div>
                            </div>

                            <!-- Redirect URL -->
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Redirect URL <?php echo $i; ?></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="ecat_redirect<?php echo $i; ?>_url" placeholder="e.g., product-details.php" value="#">
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;

    if(empty($_POST['ecat_name']) || empty($_POST['mcat_id']) || empty($_POST['ecat_des'])) {
        $valid = 0;
        $error_message = "Required fields cannot be empty!";
    }

    if($valid == 1) {
        // Handle banner image
        $ecat_image = null;
        if(isset($_FILES['ecat_image']) && $_FILES['ecat_image']['error'] == 0) {
            $ecat_image = file_get_contents($_FILES['ecat_image']['tmp_name']);
        }

        // Handle additional images
        $additional_images = array();
        for($i = 1; $i <= 4; $i++) {
            if(isset($_FILES["ecat_image$i"]) && $_FILES["ecat_image$i"]['error'] == 0) {
                $additional_images[$i] = file_get_contents($_FILES["ecat_image$i"]['tmp_name']);
            } else {
                $additional_images[$i] = null;
            }
        }

        try {
            $statement = $pdo->prepare("INSERT INTO tbl_end_category (
                ecat_name, 
                ecat_image, 
                ecat_des, 
                ecat_long_des, 
                mcat_id,
                ecat_image1, 
                ecat_image2, 
                ecat_image3, 
                ecat_image4,
                ecat_image1_title, 
                ecat_image2_title, 
                ecat_image3_title, 
                ecat_image4_title,
                ecat_image1_desc, 
                ecat_image2_desc, 
                ecat_image3_desc, 
                ecat_image4_desc,
                ecat_redirect1_url, 
                ecat_redirect2_url, 
                ecat_redirect3_url, 
                ecat_redirect4_url
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $statement->execute(array(
                $_POST['ecat_name'],
                $ecat_image,
                $_POST['ecat_des'],
                $_POST['ecat_long_des'],
                $_POST['mcat_id'],
                $additional_images[1],
                $additional_images[2],
                $additional_images[3],
                $additional_images[4],
                $_POST['ecat_image1_title'],
                $_POST['ecat_image2_title'],
                $_POST['ecat_image3_title'],
                $_POST['ecat_image4_title'],
                $_POST['ecat_image1_desc'],
                $_POST['ecat_image2_desc'],
                $_POST['ecat_image3_desc'],
                $_POST['ecat_image4_desc'],
                $_POST['ecat_redirect1_url'],
                $_POST['ecat_redirect2_url'],
                $_POST['ecat_redirect3_url'],
                $_POST['ecat_redirect4_url']
            ));

            $success_message = 'End Category is added successfully!';
        } catch(Exception $e) {
            $error_message = $e->getMessage();
        }
    }
}
?>

<?php require_once('footer.php'); ?>
