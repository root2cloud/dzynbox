<?php require_once('header.php'); ?>

<?php

// Check if the product is valid or not
if( !isset($_REQUEST['id']) || !isset($_REQUEST['size']) || !isset($_REQUEST['color'])  ) {
    header('location: wishlist.php');
    exit;
}

$i=0;
foreach($_SESSION['wishlist_p_id'] as $key => $value) {
    $i++;
    $arr_wishlist_p_id[$i] = $value;
}

$i=0;
foreach($_SESSION['wishlist_size_id'] as $key => $value) {
    $i++;
    $arr_wishlist_size_id[$i] = $value;
}

$i=0;
foreach($_SESSION['wishlist_size_name'] as $key => $value) {
    $i++;
    $arr_wishlist_size_name[$i] = $value;
}

$i=0;
foreach($_SESSION['wishlist_color_id'] as $key => $value) {
    $i++;
    $arr_wishlist_color_id[$i] = $value;
}

$i=0;
foreach($_SESSION['wishlist_color_name'] as $key => $value) {
    $i++;
    $arr_wishlist_color_name[$i] = $value;
}

$i=0;
foreach($_SESSION['wishlist_p_qty'] as $key => $value) {
    $i++;
    $arr_wishlist_p_qty[$i] = $value;
}

$i=0;
foreach($_SESSION['wishlist_p_current_price'] as $key => $value) {
    $i++;
    $arr_wishlist_p_current_price[$i] = $value;
}

$i=0;
foreach($_SESSION['wishlist_p_name'] as $key => $value) {
    $i++;
    $arr_wishlist_p_name[$i] = $value;
}

$i=0;
foreach($_SESSION['wishlist_p_featured_photo'] as $key => $value) {
    $i++;
    $arr_wishlist_p_featured_photo[$i] = $value;
}



// $i=0;
// foreach($_SESSION['wishlist_zipmachine'] as $key => $value) {
//     $i++;
//     $arr_wishlist_zipmachine[$i] = $value;
// }

unset($_SESSION['wishlist_p_id']);
unset($_SESSION['wishlist_size_id']);
unset($_SESSION['wishlist_size_name']);
unset($_SESSION['wishlist_color_id']);
unset($_SESSION['wishlist_color_name']);
unset($_SESSION['wishlist_p_qty']);
unset($_SESSION['wishlist_p_current_price']);
unset($_SESSION['wishlist_p_name']);
unset($_SESSION['wishlist_p_featured_photo']);
// unset($_SESSION['wishlist_zipmachine']);

$k=1;
for($i=1;$i<=count($arr_wishlist_p_id);$i++) {
    if( ($arr_wishlist_p_id[$i] == $_REQUEST['id']) && ($arr_wishlist_size_id[$i] == $_REQUEST['size']) && ($arr_wishlist_color_id[$i] == $_REQUEST['color']) ) {
        continue;
    } else {
        $_SESSION['wishlist_p_id'][$k] = $arr_wishlist_p_id[$i];
        $_SESSION['wishlist_size_id'][$k] = $arr_wishlist_size_id[$i];
        $_SESSION['wishlist_size_name'][$k] = $arr_wishlist_size_name[$i];
        $_SESSION['wishlist_color_id'][$k] = $arr_wishlist_color_id[$i];
        $_SESSION['wishlist_color_name'][$k] = $arr_wishlist_color_name[$i];
        $_SESSION['wishlist_p_qty'][$k] = $arr_wishlist_p_qty[$i];
        $_SESSION['wishlist_p_current_price'][$k] = $arr_wishlist_p_current_price[$i];
        $_SESSION['wishlist_p_name'][$k] = $arr_wishlist_p_name[$i];
        $_SESSION['wishlist_p_featured_photo'][$k] = $arr_wishlist_p_featured_photo[$i];
        // $_SESSION['wishlist_zipmachine'][$k] = $arr_wishlist_zipmachine[$i];
        $k++;
    }
}
header('location: whistlist.php');
?>