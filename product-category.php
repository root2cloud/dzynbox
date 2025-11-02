<?php require_once('header.php'); ?>

<style>
    .kk .kl .ph {
        width: 100%;
        height: 200px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }

    
    
    .kk .text h3 a {
        color: rgba(15, 15, 15, 1.00);
        font-weight: 400;
        font-size: 14px;
        line-height: 1.5;
    }
    
    .kk .text h4 {
        color: rgb(15, 15, 15);
        text-align: center;
        font-size: 15px;
    }
    
    /* Banner Styling */
    .page-banner {
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
    }

    .page-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
        z-index: 1;
    }
    
    .page-banner .inner {
        position: relative;
        z-index: 10;
        text-align: center;
    }

    .page-banner h1 {
        color: #ffffff;
        font-size: 150px;
        font-weight: 700;
        margin: 0;
        padding: 20px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.9);
    }

    .page-banner.no-image h1 {
        color: rgba(15, 15, 15, 1.00);
        text-shadow: none;
    }
    
    .page-banner.no-image::before {
        display: none;
    }

    /* Category Description Section */
    .category-description-section {
        padding: 0;
        background: #ffffff;
        margin-bottom: 40px;
    }

    .description-header {
        /* background: linear-gradient(135deg, #ffffff, #1d1005ff); */
        padding: 25px 40px;
        margin: 0;
        text-align: center;
    }

    .description-header h2 {
        color: #120101ff;
        font-size: 30px;
        font-weight: 800;
        margin: 40px;
        text-transform: capitalize;
    }

    .description-content {
        background: ;
        padding: 2px 50px;
        line-height: 1.8;
    }

    .description-content p {
        color: #333;
        font-size: 16px;
        line-height: 2;
        text-align: justify;
        margin: -35px;
    }
   

/* Additional Sections Styling */
.additional-sections {
    padding: 40px 0;
    background: #ffffff;
}

.image-description-section {
    margin-bottom: 60px;
    background: ;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.image-description-section .row {
    margin: 0;
}

/* Image Section (LEFT) */
.section-image {
    height: 100%;
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: ;
    padding: 0;
    border-radius: 12px;  /* ROUNDED CORNERS FOR CONTAINER */
    overflow: hidden;     /* ENSURES IMAGE RESPECTS BORDER-RADIUS */
}

.section-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 12px;  /* ROUNDED CORNERS FOR IMAGE */
}

/* Description Section (RIGHT) */
.section-description {
    padding: 40px;
    display: flex;
    flex-direction: column;  /* STACK VERTICALLY */
    align-items: flex-start;
    justify-content: flex-start;
    min-height: 400px;
    background: #ffffff;
    padding-left: 50px;  /* SPACE FOR LINE */
}

/* Light gray vertical line on LEFT - doesn't touch top/bottom */
.section-description::before {
    content: '';
    position: absolute;
    left: 0;
    top: 20px;
    bottom: 20px;
    width: 2px;
    background-color: #d0d0d0;  /* LIGHT GRAY - LEFT LINE */
}

.section-title {
    color: #120101ff;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 20px 0;  /* SPACE BELOW TITLE */
    padding: 0;
    width: 100%;
    display: block;
    text-align: center;  /* CENTER THE TITLE */
}

.section-description p {
    color: #333;
    font-size: 16px;
    line-height: 1.9;
    text-align: justify;
    margin: 0;
}


/* View More Button (BELOW) */
.section-button {
    padding: 30px;
    text-align: right;
    background: #ffffff;
    border-top: 1px solid #e0e0e0;
}

.btn-section-view-more {
    display: inline-block;
    background: linear-gradient(135deg, #bb7f5cff, #6a3568);
    color: #ffffff;
    padding: 14px 40px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(139, 71, 137, 0.3);
}
    

.btn-section-view-more:hover {
    background: linear-gradient(135deg, #bb7f5cff, #8b4789);
    transform: translateX(10px);
    box-shadow: 0 6px 20px rgba(139, 71, 137, 0.4);
    color: #100202ff;
    text-decoration: none;
}

.btn-section-view-more i {
    margin-left: 8px;
    transition: margin-left 0.3s ease;
}

.btn-section-view-more:hover i {
    margin-left: 15px;
}



/* Responsive - MOBILE IMPROVEMENTS */
@media (max-width: 768px) {
    .page-banner {
        min-height: 300px;
    }
    
    .page-banner h1 {
        font-size: 32px;
    }
    
    .description-header {
        padding: 10px 20px;
    }
    
    .description-header h2 {
        font-size: 22px;
    }
    
    .description-content {
        padding: 10px 50px;
    }
    
    .description-content p {
        font-size: 14px;
    }
}


/* Responsive - Mobile Improvements (MAIN SECTION) */
@media (max-width: 768px) {
    /* Banner Responsive */
    .page-banner {
        min-height: 250px;
    }
    
    .page-banner h1 {
        font-size: 24px;
        padding: 15px;
    }
    
    /* Image and Description Stack */
    .image-description-section {
        margin-bottom: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .section-image {
        min-height: 250px;
        border-radius: 8px;
    }
    
    .section-image img {
        border-radius: 8px;
    }
    
    /* Description Section Mobile */
    .section-description {
        min-height: auto;
        padding: 20px 15px;
        padding-left: 15px;  /* Remove extra left padding */
        background: #ffffff;
    }
    
    /* Hide vertical line on mobile */
    .section-description::before {
        display: none;  /* HIDE LEFT LINE ON MOBILE */
    }
    
    /* Title Styling Mobile */
    .section-title {
        font-size: 20px;
        margin: 0 0 15px 0;
        text-align: center;  /* CENTER ALIGN ON MOBILE */
    }
    
    /* Description Text Mobile */
    .section-description p {
        color: #333;
        font-size: 13px;
        line-height: 1.7;
        text-align: justify; 
        margin: 0 0 15px 0;
    }
    
    /* Button Section Mobile */
    .section-button {
        padding: 15px;
        text-align: center;
        background: #ffffff;
        border-top: 1px solid #f0f0f0;
    }
    
    /* Button Styling Mobile */
    .btn-section-view-more {
        display: inline-block;
        width: 50%;
        padding: 8px 8px;
        font-size: 14px;
        text-align: center;
        margin: 0 auto;
        background: linear-gradient(135deg, #bb7f5cff, #6a3568);
        border-radius: 50px;
    }
    
    
    .btn-section-view-more:hover {
        transform: none;  /* DISABLE TRANSFORM ON MOBILE */
    }
    
    /* Additional Sections Mobile */
    .additional-sections {
        padding: 20px 0;
    }
    
    /* Alternate Layout - Stack on Mobile (MISSING SECTION #2) */
    .image-description-section:nth-child(even) .col-md-6:first-child,
    .image-description-section:nth-child(even) .col-md-6:last-child {
        order: 0;  /* STACK VERTICALLY */
    }
}


/* Extra Small Devices (below 480px) */
@media (max-width: 480px) {
    .page-banner {
        min-height: 200px;
    }
    
    .page-banner h1 {
        font-size: 18px;
        padding: 10px;
    }
    
    .section-image {
        min-height: 200px;
    }
    
    .section-description {
        padding: 15px 12px;
    }
    
    .section-title {
        font-size: 18px;
        margin: 0 0 10px 0;
    }
    
    .section-description p {
        font-size: 12px;
        line-height: 1.5;
    }
    
    .section-button {
        padding: 12px;
    }
    
    .btn-section-view-more {
        display: inline-block;
        padding: 8px 8px;
        font-size: 13px;
        width: 45%;
    }
}

/* Alternate Layout (Image RIGHT for even sections) - DESKTOP (MISSING SECTION #3) */
.image-description-section:nth-child(even) .col-md-6:first-child {
    order: 2;
}

.image-description-section:nth-child(even) .col-md-6:last-child {
    order: 1;
}

</style>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_product_category = $row['banner_product_category'];
}
?>

<?php
if (!isset($_REQUEST['id']) || !isset($_REQUEST['type'])) {
    header('location: index.php');
    exit;
} else {
    if (($_REQUEST['type'] != 'top-category') && ($_REQUEST['type'] != 'mid-category') && ($_REQUEST['type'] != 'end-category')) {
        header('location: index.php');
        exit;
    } else {
        $statement = $pdo->prepare("SELECT * FROM tbl_top_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $top[] = $row['tcat_id'];
            $top1[] = $row['tcat_name'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_mid_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $mid[] = $row['mcat_id'];
            $mid1[] = $row['mcat_name'];
            $mid2[] = $row['tcat_id'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_end_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $end[] = $row['ecat_id'];
            $end1[] = $row['ecat_name'];
            $end2[] = $row['mcat_id'];
        }

        if ($_REQUEST['type'] == 'top-category') {
            if (!in_array($_REQUEST['id'], $top)) {
                header('location: index.php');
                exit;
            } else {
                for ($i = 0; $i < count($top); $i++) { 
                    if ($top[$i] == $_REQUEST['id']) {
                        $title = $top1[$i];
                        break;
                    }
                }
                $arr1 = array();
                $arr2 = array();
                for ($i = 0; $i < count($mid); $i++) { 
                    if ($mid2[$i] == $_REQUEST['id']) {
                        $arr1[] = $mid[$i];
                    }
                }
                for ($j = 0; $j < count($arr1); $j++) {
                    for ($i = 0; $i < count($end); $i++) { 
                        if ($end2[$i] == $arr1[$j]) {
                            $arr2[] = $end[$i];
                        }
                    }   
                }
                $final_ecat_ids = $arr2;
            }   
        }

        if ($_REQUEST['type'] == 'mid-category') {
            if (!in_array($_REQUEST['id'], $mid)) {
                header('location: index.php');
                exit;
            } else {
                for ($i = 0; $i < count($mid); $i++) { 
                    if ($mid[$i] == $_REQUEST['id']) {
                        $title = $mid1[$i];
                        break;
                    }
                }
                $arr2 = array();        
                for ($i = 0; $i < count($end); $i++) { 
                    if ($end2[$i] == $_REQUEST['id']) {
                        $arr2[] = $end[$i];
                    }
                }
                $final_ecat_ids = $arr2;
            }
        }

        if ($_REQUEST['type'] == 'end-category') {
            if (!in_array($_REQUEST['id'], $end)) {
                header('location: index.php');
                exit;
            } else {
                for ($i = 0; $i < count($end); $i++) { 
                    if ($end[$i] == $_REQUEST['id']) {
                        $title = $end1[$i];
                        break;
                    }
                }
                $final_ecat_ids = array($_REQUEST['id']);
            }
        }
    }   
}
?>

<?php
// ============================================
// FETCH BLOB IMAGE AND DESCRIPTIONS
// ============================================
$banner_style = "";
$banner_class = "no-image";
$category_description = '';
$category_long_description = '';

if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'end-category' && is_numeric($_REQUEST['id'])) {
    try {
        // Fetch image and both descriptions
        $stmt = $pdo->prepare("SELECT ecat_image, ecat_des, ecat_long_des FROM tbl_end_category WHERE ecat_id = ?");
        $stmt->execute([$_REQUEST['id']]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            // Handle banner image
            if (!empty($data['ecat_image'])) {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime_type = $finfo->buffer($data['ecat_image']);
                $base64 = base64_encode($data['ecat_image']);
                $data_url = "data:{$mime_type};base64,{$base64}";
                $banner_style = "background-image: url('{$data_url}');";
                $banner_class = "has-image";
            }
            
            // Get short description (for banner text)
            if (!empty($data['ecat_des'])) {
                $category_description = $data['ecat_des'];
            }
            
            // Get long description (for content below banner)
            if (!empty($data['ecat_long_des'])) {
                $category_long_description = $data['ecat_long_des'];
            }
        }
    } catch (Exception $e) {
        error_log("Banner error: " . $e->getMessage());
    }
}
?>

<!-- Page Banner -->
<div class="page-banner <?php echo $banner_class; ?>" style="<?php echo $banner_style; ?>">
    <div class="inner">
        <h1>
            <?php 
            // Display ecat_des on the image (short text like "hello")
            echo !empty($category_description) 
                ? htmlspecialchars($category_description) 
                : htmlspecialchars($title); 
            ?>
        </h1>
    </div>
</div>

<!-- Category Long Description Section (Below Banner) -->
<?php if (!empty($category_long_description)): ?>
<div class="category-description-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="description-header">
                    <h2>Modular Kitchen <?php echo htmlspecialchars($title); ?></h2>
                </div>
                <div class="description-content">
                    <p><?php echo nl2br(htmlspecialchars($category_long_description)); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
// ============================================
// FETCH ADDITIONAL IMAGES WITH TITLES & DESCRIPTIONS
// ============================================
$additional_sections = array();

if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'end-category' && is_numeric($_REQUEST['id'])) {
    try {
        $stmt = $pdo->prepare("SELECT 
            ecat_image1, ecat_image1_title, ecat_image1_desc, ecat_redirect1_url,
            ecat_image2, ecat_image2_title, ecat_image2_desc, ecat_redirect2_url,
            ecat_image3, ecat_image3_title, ecat_image3_desc, ecat_redirect3_url,
            ecat_image4, ecat_image4_title, ecat_image4_desc, ecat_redirect4_url
            FROM tbl_end_category WHERE ecat_id = ?");
        $stmt->execute([$_REQUEST['id']]);
        $sections_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sections_data) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            
            // Process each image section
            for ($i = 1; $i <= 4; $i++) {
                $img_col = "ecat_image{$i}";
                $title_col = "ecat_image{$i}_title";
                $desc_col = "ecat_image{$i}_desc";
                $url_col = "ecat_redirect{$i}_url";
                
                if (!empty($sections_data[$img_col])) {
                    $mime_type = $finfo->buffer($sections_data[$img_col]);
                    $base64 = base64_encode($sections_data[$img_col]);
                    
                    $additional_sections[] = array(
                        'image' => "data:{$mime_type};base64,{$base64}",
                        'title' => !empty($sections_data[$title_col]) ? $sections_data[$title_col] : '',
                        'description' => !empty($sections_data[$desc_col]) ? $sections_data[$desc_col] : '',
                        'url' => !empty($sections_data[$url_col]) ? $sections_data[$url_col] : '#'
                    );
                }
            }
        }
    } catch (Exception $e) {
        error_log("Additional sections error: " . $e->getMessage());
    }
}
?>


<!-- Additional Image Sections -->
<?php if (!empty($additional_sections)): ?>
<div class="additional-sections">
    <div class="container">
        <?php foreach ($additional_sections as $index => $section): ?>
            <div class="image-description-section">
                <div class="row">
                    <!-- Image on LEFT -->
                    <div class="col-md-6">
                        <div class="section-image">
                            <img src="<?php echo $section['image']; ?>" alt="<?php echo htmlspecialchars($section['title']); ?>" class="img-responsive">
                        </div>
                    </div>
                    
                    <!-- Title & Description on RIGHT -->
                    <div class="col-md-6">
                        <div class="section-description">
                            <?php if (!empty($section['title'])): ?>
                                <h3 class="section-title"><?php echo htmlspecialchars($section['title']); ?></h3>
                            <?php endif; ?>
                            <p><?php echo nl2br(htmlspecialchars($section['description'])); ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- View More Button BELOW (Full Width) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-button">
                            <a href="<?php echo htmlspecialchars($section['url']); ?>?id=<?php echo $_REQUEST['id']; ?>&type=<?php echo $_REQUEST['type']; ?>" class="btn-section-view-more">
                                View More <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- Products Section -->
<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- <?php require_once('sidebar-category.php'); ?> -->
            </div>
            <div class="col-md-9">
                <h3><?php echo LANG_VALUE_51; ?> "<?php echo htmlspecialchars($title); ?>"</h3>
                <div class="productt kk product-cat">
                    <div class="row">
                        <?php
                        $prod_count = 0;
                        $prod_table_ecat_ids = array();
                        
                        $statement = $pdo->prepare("SELECT * FROM tbl_product");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $prod_table_ecat_ids[] = $row['ecat_id'];
                        }

                        for ($ii = 0; $ii < count($final_ecat_ids); $ii++) {
                            if (in_array($final_ecat_ids[$ii], $prod_table_ecat_ids)) {
                                $prod_count++;
                            }
                        }

                        if ($prod_count == 0) {
                            echo '<div class="pl_15">'.LANG_VALUE_153.'</div>';
                        } else {
                            for ($ii = 0; $ii < count($final_ecat_ids); $ii++) {
                                $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_is_active=?");
                                $statement->execute(array($final_ecat_ids[$ii], 1));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <div class="col-md-4 itemm kl item-product-cat">
                                        <div class="inner">
                                            <div class="thumb lk">
                                                <div class="photo ph" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="text">
                                                <center>
                                                    <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo htmlspecialchars($row['p_name']); ?></a></h3>
                                                </center>
                                                <h4>
                                                    ₹<?php echo number_format($row['p_current_price'], 2); ?> 
                                                    <a href="product.php?id=<?php echo $row['p_id']; ?>" style="display: inline-flex; align-items: center; text-decoration: none; margin-left: 10px;">
                                                        <i class="fa fa-plus" style="color: white; background-color: black; padding: 5px; border-radius: 50%;"></i>
                                                    </a>
                                                </h4>
                                                <div class="rating">
                                                    <?php
                                                    $t_rating = 0;
                                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                                    $statement1->execute(array($row['p_id']));
                                                    $tot_rating = $statement1->rowCount();
                                                    if ($tot_rating == 0) {
                                                        $avg_rating = 0;
                                                    } else {
                                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($result1 as $row1) {
                                                            $t_rating += $row1['rating'];
                                                        }
                                                        $avg_rating = $t_rating / $tot_rating;
                                                    }
                                                    
                                                    if ($avg_rating == 0) {
                                                        echo '';
                                                    } elseif ($avg_rating == 1.5) {
                                                        echo '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                                                    } elseif ($avg_rating == 2.5) {
                                                        echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                                                    } elseif ($avg_rating == 3.5) {
                                                        echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
                                                    } elseif ($avg_rating == 4.5) {
                                                        echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
                                                    } else {
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            echo $i > $avg_rating ? '<i class="fa fa-star-o"></i>' : '<i class="fa fa-star"></i>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <?php if ($row['p_qty'] == 0): ?>
                                                    <div class="out-of-stock">
                                                        <div class="inner">Out Of Stock</div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
