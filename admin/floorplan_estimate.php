<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;
    $error_message = '';

    // Validation for all fields
    if (empty($_POST['BHK'])) {
        $valid = 0;
        $error_message .= 'BHK cannot be empty<br>';
    }

    if (empty($_POST['rooms'])) {
        $valid = 0;
        $error_message .= 'Rooms cannot be empty<br>';
    }

    if (empty($_POST['roome_size'])) {
        $valid = 0;
        $error_message .= 'Room size cannot be empty<br>';
    }

    if (empty($_POST['material'])) {
        $valid = 0;
        $error_message .= 'Material cannot be empty<br>';
    }

    if (empty($_POST['price'])) {
        $valid = 0;
        $error_message .= 'Price cannot be empty<br>';
    }

    if (isset($_FILES['floorplan']['name']) && $_FILES['floorplan']['name'] != '') {
        $imageFileType = pathinfo($_FILES['floorplan']['name'], PATHINFO_EXTENSION);
        $allowed_types = ['jpg', 'png', 'jpeg', 'gif'];

        if (!in_array(strtolower($imageFileType), $allowed_types)) {
            $valid = 0;
            $error_message .= 'Only JPG, JPEG, PNG, and GIF files are allowed for floorplan<br>';
        } else {
            $floorplan_data = file_get_contents($_FILES['floorplan']['tmp_name']);
        }
    } else {
        $valid = 0;
        $error_message .= 'Floorplan image is required<br>';
    }

    if ($valid == 1) {
        // Insert the new data into the table
        $statement = $pdo->prepare("INSERT INTO tbl_estimate (floorplan, BHK, rooms, roome_size, material, price) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->execute(array(
            $floorplan_data,
            $_POST['BHK'],
            $_POST['rooms'],
            $_POST['roome_size'],
            $_POST['material'],
            $_POST['price']
        ));

        $success_message = 'Room details added successfully!';

        // Clear form values
        unset($_POST['BHK']);
        unset($_POST['rooms']);
        unset($_POST['roome_size']);
        unset($_POST['material']);
        unset($_POST['price']);
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Room Details</h1>
    </div>
    <div class="content-header-right">
        <a href="rooms.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($error_message)): ?>
                <div class="callout callout-danger">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="callout callout-success">
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Floorplan <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" name="floorplan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">BHK <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="BHK" value="<?php if (isset($_POST['BHK'])) { echo $_POST['BHK']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Rooms <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="rooms" value="<?php if (isset($_POST['rooms'])) { echo $_POST['rooms']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Room Size <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="roome_size" value="<?php if (isset($_POST['room_size'])) { echo $_POST['room_size']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Material <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="material" value="<?php if (isset($_POST['material'])) { echo $_POST['material']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Price <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="price" value="<?php if (isset($_POST['price'])) { echo $_POST['price']; } ?>">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-sm-offset-2 col-sm-6">
                            <input type="submit" name="form1" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
