<?php require_once('header.php'); ?>

<style>
/* Banner Section with Text Overlay */
.ravi-banner {
    position: relative;
    width: 100%;
    height: 600px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.ravi-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    z-index: 1;
}

.banner-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;
    text-align: center;
    color: #ffffff;
    width: 90%;
    max-width: 800px;
}

.banner-content h1 {
    font-size: 100px;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 0 4px 15px rgba(0,0,0,0.9);
}

.banner-content p {
    font-size: 20px;
    line-height: 1.6;
    text-shadow: 0 2px 10px rgba(0,0,0,0.8);
}

/* Long Description Section */
.long-description-section {
    padding: 50px 0;
    background: #f9f9f9;
}

.description-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.description-box {
    background: #ffffff;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
}

.description-box h2 {
    font-size: 36px;
    font-weight: 700;
    color: #333;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
}

.description-box h2::after {
    content: '';
    display: block;
    width: 80px;
    height: 3px;
    background: linear-gradient(135deg, #1f071eff, #4707dcff);
    margin: 20px auto 0;
}

.description-box p {
    font-size: 17px;
    line-height: 1.9;
    color: #555;
    text-align: justify;
}

/* Gallery Section */
.gallery-section {
    padding: 80px 0;
    background: #ffffff;
}

.gallery-section h2 {
    text-align: center;
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 60px;
    color: #333;
    position: relative;
}

.gallery-section h2::after {
    content: '';
    display: block;
    width: 100px;
    height: 3px;
    background: linear-gradient(135deg, #1f071eff, #4707dcff);
    margin: 20px auto 0;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    transition: all 0.4s ease;
    background: #f5f5f5;
}

.gallery-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}

.gallery-item img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
    padding: 25px;
    transform: translateY(100%);
    transition: transform 0.4s ease;
}

.gallery-item:hover .gallery-overlay {
    transform: translateY(0);
}

.gallery-overlay h3 {
    color: #ffffff;
    font-size: 20px;
    font-weight: 600;
    margin: 0;
}

/* No Content Message */
.no-content {
    text-align: center;
    padding: 100px 20px;
    color: #999;
    font-size: 18px;
}

/* Responsive */
@media (max-width: 768px) {
    .ravi-banner {
        height: 400px;
    }
    
    .banner-content h1 {
        font-size: 32px;
    }
    
    .banner-content p {
        font-size: 16px;
    }
    
    .description-box {
        padding: 30px 20px;
    }
    
    .description-box h2 {
        font-size: 28px;
    }
    
    .description-box p {
        font-size: 15px;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
    
    .gallery-item img {
        height: 280px;
    }
}
</style>

<?php
// Fetch page data (only active page)
try {
    $stmt = $pdo->prepare("SELECT * FROM tbl_ravi_page WHERE is_active = 1 LIMIT 1");
    $stmt->execute();
    $page_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$page_data) {
        echo '<div class="no-content">Page content not found.</div>';
        require_once('footer.php');
        exit;
    }
    
    // Convert banner image to base64
    $banner_url = '';
    if (!empty($page_data['banner_image'])) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->buffer($page_data['banner_image']);
        $base64 = base64_encode($page_data['banner_image']);
        $banner_url = "data:{$mime_type};base64,{$base64}";
    }
    
    // Fetch gallery images (up to 15)
    $stmt_gallery = $pdo->prepare("SELECT * FROM tbl_ravi_gallery 
                                   WHERE page_id = ? 
                                   ORDER BY display_order ASC, gallery_id ASC 
                                   LIMIT 15");
    $stmt_gallery->execute([$page_data['page_id']]);
    $gallery_images = $stmt_gallery->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    error_log("Ravi page error: " . $e->getMessage());
    echo '<div class="no-content">Error loading page content.</div>';
    require_once('footer.php');
    exit;
}
?>

<!-- Banner Section with Description -->
<div class="ravi-banner" style="background-image: url('<?php echo $banner_url; ?>');">
    <div class="banner-content">
        <h1><?php echo htmlspecialchars($page_data['page_title']); ?></h1>
        <?php if (!empty($page_data['banner_description'])): ?>
            <p><?php echo htmlspecialchars($page_data['banner_description']); ?></p>
        <?php endif; ?>
    </div>
</div>

<!-- Long Description Section -->
<?php if (!empty($page_data['long_description'])): ?>
<div class="long-description-section">
    <div class="description-container">
        <div class="description-box">
            <h2>About <?php echo htmlspecialchars($page_data['page_title']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($page_data['long_description'])); ?></p>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Gallery Section -->
<?php if (!empty($gallery_images)): ?>
<div class="gallery-section">
    <div class="container">
        <h2>Inspired Spaces</h2>
        <div class="gallery-grid">
            <?php 
            foreach ($gallery_images as $img): 
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime_type = $finfo->buffer($img['gallery_image']);
                $base64 = base64_encode($img['gallery_image']);
                $img_url = "data:{$mime_type};base64,{$base64}";
            ?>
                <div class="gallery-item">
                    <img src="<?php echo $img_url; ?>" 
                         alt="<?php echo !empty($img['image_title']) ? htmlspecialchars($img['image_title']) : 'Gallery Image'; ?>">
                    
                    <?php if (!empty($img['image_title'])): ?>
                    <div class="gallery-overlay">
                        <h3><?php echo htmlspecialchars($img['image_title']); ?></h3>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php require_once('footer.php'); ?>
