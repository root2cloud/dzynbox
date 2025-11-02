<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;
    $error_message = '';

    // Validation for all fields
    if (empty($_POST['room_name'])) {
        $valid = 0;
        $error_message .= 'Room name cannot be empty<br>';
    }

    if (empty($_POST['room_price'])) {
        $valid = 0;
        $error_message .= 'Price cannot be empty<br>';
    }

    if (empty($_POST['economy_price'])) {
        $valid = 0;
        $error_message .= 'Economy price cannot be empty<br>';
    }

    if (empty($_POST['premium_price'])) {
        $valid = 0;
        $error_message .= 'Premium price cannot be empty<br>';
    }

    if (empty($_POST['luxury_price'])) {
        $valid = 0;
        $error_message .= 'Luxury price cannot be empty<br>';
    }

    if (empty($_POST['room_description'])) {
        $valid = 0;
        $error_message .= 'Description cannot be empty<br>';
    }

    // Additional fields validation
    if (empty($_POST['furniture'])) {
        $valid = 0;
        $error_message .= 'Furniture cannot be empty<br>';
    }

    if (empty($_POST['accessories'])) {
        $valid = 0;
        $error_message .= 'Accessories cannot be empty<br>';
    }

    if (empty($_POST['economy_furniture'])) {
        $valid = 0;
        $error_message .= 'Economy furniture cannot be empty<br>';
    }

    if (empty($_POST['economy_accessories'])) {
        $valid = 0;
        $error_message .= 'Economy accessories cannot be empty<br>';
    }

    if (empty($_POST['premium_furniture'])) {
        $valid = 0;
        $error_message .= 'Premium furniture cannot be empty<br>';
    }

    if (empty($_POST['premium_accessories'])) {
        $valid = 0;
        $error_message .= 'Premium accessories cannot be empty<br>';
    }

    if (empty($_POST['luxury_furniture'])) {
        $valid = 0;
        $error_message .= 'Luxury furniture cannot be empty<br>';
    }

    if (empty($_POST['luxury_accessories'])) {
        $valid = 0;
        $error_message .= 'Luxury accessories cannot be empty<br>';
    }

    if ($valid == 1) {
        // Insert the new room into the table
        $statement = $pdo->prepare("INSERT INTO tbl_rooms (room_name, room_price, furniture, accessories, economy_price, economy_furniture, economy_accessories, premium_price, premium_furniture, premium_accessories, luxury_price, luxury_furniture, luxury_accessories, room_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array(
            $_POST['room_name'],
            $_POST['room_price'],
            $_POST['furniture'],
            $_POST['accessories'],
            $_POST['economy_price'],
            $_POST['economy_furniture'],
            $_POST['economy_accessories'],
            $_POST['premium_price'],
            $_POST['premium_furniture'],
            $_POST['premium_accessories'],
            $_POST['luxury_price'],
            $_POST['luxury_furniture'],
            $_POST['luxury_accessories'],
            $_POST['room_description']
        ));

        $success_message = 'Room is added successfully!';

        // Clear form values
        unset($_POST['room_name']);
        unset($_POST['room_price']);
        unset($_POST['furniture']);
        unset($_POST['accessories']);
        unset($_POST['economy_price']);
        unset($_POST['economy_furniture']);
        unset($_POST['economy_accessories']);
        unset($_POST['premium_price']);
        unset($_POST['premium_furniture']);
        unset($_POST['premium_accessories']);
        unset($_POST['luxury_price']);
        unset($_POST['luxury_furniture']);
        unset($_POST['luxury_accessories']);
        unset($_POST['room_description']);
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Rooms</h1>
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

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Room Name <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="room_name" value="<?php if (isset($_POST['room_name'])) { echo $_POST['room_name']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Price <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="room_price" value="<?php if (isset($_POST['room_price'])) { echo $_POST['room_price']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Furniture <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="furniture" value="<?php if (isset($_POST['furniture'])) { echo $_POST['furniture']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Accessories <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="accessories" value="<?php if (isset($_POST['accessories'])) { echo $_POST['accessories']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Economy Price <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="economy_price" value="<?php if (isset($_POST['economy_price'])) { echo $_POST['economy_price']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Economy Furniture <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="economy_furniture" value="<?php if (isset($_POST['economy_furniture'])) { echo $_POST['economy_furniture']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Economy Accessories <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="economy_accessories" value="<?php if (isset($_POST['economy_accessories'])) { echo $_POST['economy_accessories']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Premium Price <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="premium_price" value="<?php if (isset($_POST['premium_price'])) { echo $_POST['premium_price']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Premium Furniture <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="premium_furniture" value="<?php if (isset($_POST['premium_furniture'])) { echo $_POST['premium_furniture']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Premium Accessories <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="premium_accessories" value="<?php if (isset($_POST['premium_accessories'])) { echo $_POST['premium_accessories']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Luxury Price <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="luxury_price" value="<?php if (isset($_POST['luxury_price'])) { echo $_POST['luxury_price']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Luxury Furniture <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="luxury_furniture" value="<?php if (isset($_POST['luxury_furniture'])) { echo $_POST['luxury_furniture']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Luxury Accessories <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="luxury_accessories" value="<?php if (isset($_POST['luxury_accessories'])) { echo $_POST['luxury_accessories']; } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Description <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="room_description"><?php if (isset($_POST['room_description'])) { echo $_POST['room_description']; } ?></textarea>
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
