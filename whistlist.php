<?php require_once('header.php'); ?>

<?php
$error_message = '';
if(isset($_POST['form1'])) {

    $i = 0;
    $statement = $pdo->prepare("SELECT * FROM tbl_product");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $i++;
        $table_product_id[$i] = $row['p_id'];
        $table_quantity[$i] = $row['p_qty'];
    }

    $i=0;
    foreach($_POST['product_id'] as $val) {
        $i++;
        $arr1[$i] = $val;
    }
    $i=0;
    foreach($_POST['quantity'] as $val) {
        $i++;
        $arr2[$i] = $val;
    }
    $i=0;
    foreach($_POST['product_name'] as $val) {
        $i++;
        $arr3[$i] = $val;
    }
    
    $allow_update = 1;
    for($i=1;$i<=count($arr1);$i++) {
        for($j=1;$j<=count($table_product_id);$j++) {
            if($arr1[$i] == $table_product_id[$j]) {
                $temp_index = $j;
                break;
            }
        }
        if($table_quantity[$temp_index] < $arr2[$i]) {
            $allow_update = 0;
            $error_message .= '"'.$arr2[$i].'" items are not available for "'.$arr3[$i].'"\n';
        } else {
            $_SESSION['wishlist_p_qty'][$i] = $arr2[$i];
        }
    }
    $error_message .= '\nOther items quantity are updated successfully!';
    ?>
    
    <?php if($allow_update == 0): ?>
        <script>alert('<?php echo $error_message; ?>');</script>
    <?php else: ?>
        <script>alert('All Items Quantity Update is Successful!');</script>
    <?php endif; ?>
    <?php

}
?>


<div class="page-banner" style="/<?php echo $banner_cart; ?>)">
    <div class="overlay"></div>
    <div class="page-banner-inner">
        <h1>your Wishlist</h1>
    </div>
</div>
<!--<marquee behavior="alternate" direction="left" style="color: blue;" >-->
<!--    <h3><b>If you want to Add Product to Cart 2nd time click will on Add to Cart button.</b></h3>-->
<!--</marquee>-->
<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php if(!isset($_SESSION['wishlist_p_id'])): ?>
                    <?php echo '<h2 class="text-center">wishlist is Empty!!</h2></br>'; ?>
                    <?php echo '<h4 class="text-center">Add products to the wishlist in order to view it here.</h4>'; ?>
                <?php else: ?>
                <form action="" method="post">
                    <?php $csrf->echoInputField(); ?>
                <div class="wishlist">
                <div class="table-responsive">
                    <table class="table table-responsive table-hover table-bordered">
                    <tr>
                            <th><?php echo '#' ?></th>
                            <th><?php echo LANG_VALUE_8; ?></th>
                            <th><?php echo LANG_VALUE_47; ?></th>
                            <th><?php echo LANG_VALUE_157; ?></th>
                            <th><?php echo LANG_VALUE_158; ?></th>
                            <th><?php echo LANG_VALUE_159; ?></th>
                            <th><?php echo LANG_VALUE_55; ?></th>
                            <th class="text-right"><?php echo LANG_VALUE_82; ?></th>
                            <th class="text-center" style="width: 100px;"><?php echo LANG_VALUE_83; ?></th>
                        </tr>
                        <?php
                        $table_total_price = 0;

                        $i=0;
                        foreach($_SESSION['wishlist_p_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_p_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['wishlist_size_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_size_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['wishlist_size_name'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_size_name[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['wishlist_color_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_color_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['wishlist_color_name'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_color_name[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['wishlist_p_qty'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_p_qty[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['wishlist_p_current_price'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_p_current_price[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['wishlist_p_name'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_p_name[$i] = $value;
                        }
                   
                       
                      



                        $i=0;
                        foreach($_SESSION['wishlist_p_featured_photo'] as $key => $value) 
                        {
                            $i++;
                            $arr_wishlist_p_featured_photo[$i] = $value;
                        }

                       

                        if(isset($_POST['form_add_to_cart'])) {

                            // getting the currect stock of this product
                            $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
                            $statement->execute(array($_REQUEST['id']));
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
                            foreach ($result as $row) {
                                $current_p_qty = $row['p_qty'];
                            }
                            if($_POST['p_qty'] > $current_p_qty):
                                $temp_msg = 'Sorry! There are only '.$current_p_qty.' item(s) in stock';
                                ?>
                                <script type="text/javascript">alert('<?php echo $temp_msg; ?>');</script>
                                <?php
                            else:
                            if(isset($_SESSION['cart_p_id']))
                            {
                                $arr_cart_p_id = array();
                                $arr_cart_size_id = array();
                                $arr_cart_color_id = array();
                                $arr_cart_p_qty = array();
                                $arr_cart_p_current_price = array();
                        
                                $i=0;
                                foreach($_SESSION['cart_p_id'] as $key => $value) 
                                {
                                    $i++;
                                    $arr_cart_p_id[$i] = $value;
                                }
                        
                                $i=0;
                                foreach($_SESSION['cart_size_id'] as $key => $value) 
                                {
                                    $i++;
                                    $arr_cart_size_id[$i] = $value;
                                }
                        
                                $i=0;
                                foreach($_SESSION['cart_color_id'] as $key => $value) 
                                {
                                    $i++;
                                    $arr_cart_color_id[$i] = $value;
                                }
                        
                        
                                $added = 0;
                                if(!isset($_POST['size_id'])) {
                                    $size_id = 0;
                                } else {
                                    $size_id = $_POST['size_id'];
                                }
                                if(!isset($_POST['color_id'])) {
                                    $color_id = 0;
                                } else {
                                    $color_id = $_POST['color_id'];
                                }
                                for($i=1;$i<=count($arr_cart_p_id);$i++) {
                                    if( ($arr_cart_p_id[$i]==$_REQUEST['id']) && ($arr_cart_size_id[$i]==$size_id) && ($arr_cart_color_id[$i]==$color_id) ) {
                                        $added = 1;
                                        break;
                                    }
                                }
                                if($added == 1) {
                                   $error_message1 = 'This product is already added to the shopping cart.';
                                } else {
                        
                                    $i=0;
                                    foreach($_SESSION['cart_p_id'] as $key => $res) 
                                    {
                                        $i++;
                                    }
                                    $new_key = $i+1;
                        
                                    if(isset($_POST['size_id'])) {
                        
                                        $size_id = $_POST['size_id'];
                        
                                        $statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
                                        $statement->execute(array($size_id));
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                                        foreach ($result as $row) {
                                            $size_name = $row['size_name'];
                                        }
                                    } else {
                                        $size_id = 0;
                                        $size_name = '';
                                    }
                                    
                                    if(isset($_POST['color_id'])) {
                                        $color_id = $_POST['color_id'];
                                        $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
                                        $statement->execute(array($color_id));
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                                        foreach ($result as $row) {
                                            $color_name = $row['color_name'];
                                        }
                                    } else {
                                        $color_id = 0;
                                        $color_name = '';
                                    }
                                  
                        
                                    $_SESSION['cart_p_id'][$new_key] = $_REQUEST['id'];
                                    $_SESSION['cart_size_id'][$new_key] = $size_id;
                                    $_SESSION['cart_size_name'][$new_key] = $size_name;
                                    $_SESSION['cart_color_id'][$new_key] = $color_id;
                                    $_SESSION['cart_color_name'][$new_key] = $color_name;
                                    $_SESSION['cart_p_qty'][$new_key] = $_POST['p_qty'];
                                    $_SESSION['cart_p_current_price'][$new_key] = $_POST['p_current_price'];
                                    $_SESSION['cart_p_name'][$new_key] = $_POST['p_name'];
                                    $_SESSION['cart_p_featured_photo'][$new_key] = $_POST['p_featured_photo'];

                                    $success_message1 = 'Product is added to the cart successfully!';
                                }
                                
                            }
                            else
                            {
                        
                                if(isset($_POST['size_id'])) {
                        
                                    $size_id = $_POST['size_id'];
                        
                                    $statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
                                    $statement->execute(array($size_id));
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                                    foreach ($result as $row) {
                                        $size_name = $row['size_name'];
                                    }
                                } else {
                                    $size_id = 0;
                                    $size_name = '';
                                }
                                
                                if(isset($_POST['color_id'])) {
                                    $color_id = $_POST['color_id'];
                                    $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
                                    $statement->execute(array($color_id));
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                                    foreach ($result as $row) {
                                        $color_name = $row['color_name'];
                                    }
                                } else {
                                    $color_id = 0;
                                    $color_name = '';
                                }
                                
                        
                                $_SESSION['cart_p_id'][1] = $_REQUEST['id'];
                                $_SESSION['cart_size_id'][1] = $size_id;
                                $_SESSION['cart_size_name'][1] = $size_name;
                                $_SESSION['cart_color_id'][1] = $color_id;
                                $_SESSION['cart_color_name'][1] = $color_name;
                                $_SESSION['cart_p_qty'][1] = $_POST['p_qty'];
                                $_SESSION['cart_p_current_price'][1] = $_POST['p_current_price'];
                                $_SESSION['cart_p_name'][1] = $_POST['p_name'];
                                $_SESSION['cart_p_featured_photo'][1] = $_POST['p_featured_photo'];
                                // $_SESSION['cart_zipmachine'][1] = $_POST['zipmachine'];
                        
                                $success_message1 = 'Product is added to the cart successfully!';
                            }
                            endif;
                        }
                        ?>


<?php for($i=1; $i<=count($arr_wishlist_p_id); $i++): ?>
<tr>
    <td><?php echo $i; ?></td>
    <td>
        <img src="assets/uploads/<?php echo $arr_wishlist_p_featured_photo[$i]; ?>" alt="" style="max-width: 100%; height: auto;">
    </td>
    <td><?php echo $arr_wishlist_p_name[$i]; ?></td>
                            <td><?php echo $arr_wishlist_size_name[$i]; ?></td>
                            <td><?php echo $arr_wishlist_color_name[$i]; ?></td>
                            <td>₹<?php echo $arr_wishlist_p_current_price[$i]; ?></td>
                            <td>
                                <input type="hidden" name="product_id[]" value="<?php echo $arr_wishlist_p_id[$i]; ?>">
                                <input type="hidden" name="product_name[]" value="<?php echo $arr_wishlist_p_name[$i]; ?>">
                                <input type="number" class="input-text qty text" step="1" min="1" max="" name="quantity[]" value="<?php echo $arr_wishlist_p_qty[$i]; ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                            </td>
                            <td class="text-right">
                                <?php
                                $row_total_price = $arr_wishlist_p_current_price[$i]*$arr_wishlist_p_qty[$i];
                                $table_total_price = $table_total_price + $row_total_price;
                                ?>
                               ₹<?php echo $row_total_price; ?>
                            </td>
                            <td class="text-center">
                                <a onclick="return confirmDelete();" href="wishlist-item-delete.php?id=<?php echo $arr_wishlist_p_id[$i]; ?>&size=<?php echo $arr_wishlist_size_id[$i]; ?>&color=<?php echo $arr_wishlist_color_id[$i]; ?>" class="trash"><i class="fa fa-trash" style="color:red;"></i></a>
                            </td>
                            
        <!-- Add to Cart Button -->
        
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $arr_wishlist_p_id[$i]; ?>">
            <input type="hidden" name="p_qty" value="<?php echo $arr_wishlist_p_qty[$i]; ?>">
            <input type="hidden" name="p_current_price" value="<?php echo $arr_wishlist_p_current_price[$i]; ?>">
            <input type="hidden" name="p_name" value="<?php echo $arr_wishlist_p_name[$i]; ?>">
            <input type="hidden" name="p_featured_photo" value="<?php echo $arr_wishlist_p_featured_photo[$i]; ?>">

          


            <!-- <button type="submit" name="form_add_to_cart" class="add-to-cart-btn"><i class="fa fa-cart-plus"></i> Add to Cart</button>
        </form> --> 
        <!-- End Add to Cart Button -->

    </td>
    <td>
        <input type="hidden" name="product_id[]" value="<?php echo $arr_wishlist_p_id[$i]; ?>">
        <input type="hidden" name="product_name[]" value="<?php echo $arr_wishlist_p_name[$i]; ?>">
        <input type="hidden" type="number" class="input-text qty text" step="1" min="1" max="" name="quantity[]" value="<?php echo $arr_wishlist_p_qty[$i]; ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
    </td> 
   
   
</tr>
<?php endfor; ?>

                        <tr>
                            <th colspan="7" class="total-text">Total</th>
                            <th class="total-amount">(₹)<?php echo $table_total_price; ?></th>
                            <th></th>
                        </tr>
                    </table>
                </div>
                </div>
                </form>
                <?php endif; ?>

                

            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
