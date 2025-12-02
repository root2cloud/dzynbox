<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aeries_dbnew";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if tables exist
$check_tables = $conn->query("SHOW TABLES LIKE 'tbl_ravi_page'");
if (!$check_tables || $check_tables->num_rows == 0) {
    die('<div style="background: #f8d7da; color: #721c24; padding: 20px; margin: 20px; border-radius: 5px; font-family: Arial;">
        <h2>Database Error</h2>
        <p>The table <strong>tbl_ravi_page</strong> does not exist in the database <strong>aeries_dbnew</strong>.</p>
        <p>Please import the SQL files first.</p>
    </div>');
}

$message = '';
$error = '';

// Debug: Show POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Uncomment these lines to debug:
    // echo "<pre>POST Data: "; print_r($_POST); echo "</pre>";
    // echo "<pre>FILES Data: "; print_r($_FILES); echo "</pre>";
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Add/Edit Page
    if (isset($_POST['save_page'])) {
        try {
            $pageid = isset($_POST['pageid']) && !empty($_POST['pageid']) ? intval($_POST['pageid']) : 0;
            $pagetitle = $conn->real_escape_string($_POST['pagetitle']);
            $bannerdescription = isset($_POST['bannerdescription']) ? $conn->real_escape_string($_POST['bannerdescription']) : '';
            $longdescription = isset($_POST['longdescription']) ? $conn->real_escape_string($_POST['longdescription']) : '';
            $isactive = isset($_POST['isactive']) ? 1 : 0;
            
            // Handle banner image upload
            $bannerimage = '';
            if (isset($_FILES['bannerimage']) && $_FILES['bannerimage']['error'] === UPLOAD_ERR_OK) {
                $bannerimage = file_get_contents($_FILES['bannerimage']['tmp_name']);
            }
            
            if ($pageid > 0) {
                // Update existing page
                if (!empty($bannerimage)) {
                    $sql = "UPDATE tbl_ravi_page SET pagetitle=?, bannerimage=?, bannerdescription=?, longdescription=?, isactive=? WHERE pageid=?";
                    $stmt = $conn->prepare($sql);
                    if (!$stmt) {
                        throw new Exception("Prepare failed: " . $conn->error);
                    }
                    $stmt->bind_param("ssssii", $pagetitle, $bannerimage, $bannerdescription, $longdescription, $isactive, $pageid);
                } else {
                    $sql = "UPDATE tbl_ravi_page SET pagetitle=?, bannerdescription=?, longdescription=?, isactive=? WHERE pageid=?";
                    $stmt = $conn->prepare($sql);
                    if (!$stmt) {
                        throw new Exception("Prepare failed: " . $conn->error);
                    }
                    $stmt->bind_param("sssii", $pagetitle, $bannerdescription, $longdescription, $isactive, $pageid);
                }
                $message = "Page updated successfully!";
            } else {
                // Insert new page
                $sql = "INSERT INTO tbl_ravi_page (pagetitle, bannerimage, bannerdescription, longdescription, isactive) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    throw new Exception("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param("ssssi", $pagetitle, $bannerimage, $bannerdescription, $longdescription, $isactive);
                $message = "Page added successfully!";
            }
            
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }
            $stmt->close();
            
            // Redirect to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } catch (Exception $e) {
            $error = "Error saving page: " . $e->getMessage();
        }
    }
    
    // Add Gallery Images
    if (isset($_POST['add_gallery_images'])) {
        try {
            $pageid = intval($_POST['pageid']);
            
            if (isset($_FILES['gallery_images'])) {
                $total_files = count($_FILES['gallery_images']['name']);
                
                for ($i = 0; $i < $total_files; $i++) {
                    if ($_FILES['gallery_images']['error'][$i] === UPLOAD_ERR_OK) {
                        $image_data = file_get_contents($_FILES['gallery_images']['tmp_name'][$i]);
                        $image_title = isset($_POST['image_titles'][$i]) ? $conn->real_escape_string($_POST['image_titles'][$i]) : '';
                        $display_order = isset($_POST['display_orders'][$i]) ? intval($_POST['display_orders'][$i]) : 0;
                        
                        $stmt = $conn->prepare("INSERT INTO tbl_ravi_gallery (pageid, galleryimage, imagetitle, displayorder) VALUES (?, ?, ?, ?)");
                        if (!$stmt) {
                            throw new Exception("Prepare failed: " . $conn->error);
                        }
                        $stmt->bind_param("issi", $pageid, $image_data, $image_title, $display_order);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
                $message = "Gallery images uploaded successfully!";
            }
            
            header("Location: " . $_SERVER['PHP_SELF'] . "?edit_page=" . $pageid . "&success=1");
            exit();
        } catch (Exception $e) {
            $error = "Error uploading gallery images: " . $e->getMessage();
        }
    }
    
    // Delete Gallery Image
    if (isset($_POST['delete_gallery'])) {
        try {
            $galleryid = intval($_POST['galleryid']);
            $conn->query("DELETE FROM tbl_ravi_gallery WHERE galleryid = $galleryid");
            $message = "Gallery image deleted successfully!";
            
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } catch (Exception $e) {
            $error = "Error deleting gallery image: " . $e->getMessage();
        }
    }
    
    // Delete Page
    if (isset($_POST['delete_page'])) {
        try {
            $pageid = intval($_POST['pageid']);
            $conn->query("DELETE FROM tbl_ravi_gallery WHERE pageid = $pageid");
            $conn->query("DELETE FROM tbl_ravi_page WHERE pageid = $pageid");
            $message = "Page and associated gallery images deleted successfully!";
            
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } catch (Exception $e) {
            $error = "Error deleting page: " . $e->getMessage();
        }
    }
}

// Show success message from redirect
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $message = "Operation completed successfully!";
}

// Get page for editing
$edit_page = null;
if (isset($_GET['edit_page'])) {
    $pageid = intval($_GET['edit_page']);
    $result = $conn->query("SELECT * FROM tbl_ravi_page WHERE pageid = $pageid");
    if ($result && $result->num_rows > 0) {
        $edit_page = $result->fetch_assoc();
    }
}

// Get all pages
$pages = $conn->query("SELECT * FROM tbl_ravi_page ORDER BY pageid DESC");
if (!$pages) {
    $error = "Error fetching pages: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Pages and Gallery</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1, h2, h3 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0056b3;
        }
        
        .btn-success {
            background: #28a745;
            color: white;
        }
        
        .btn-success:hover {
            background: #218838;
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .pages-list {
            margin-top: 30px;
        }
        
        .page-item {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        
        .page-item h3 {
            margin-bottom: 10px;
        }
        
        .page-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .gallery-item {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .gallery-item .gallery-info {
            padding: 10px;
            background: white;
        }
        
        .gallery-item .gallery-info p {
            margin: 5px 0;
            font-size: 12px;
        }
        
        .gallery-item form {
            padding: 10px;
        }
        
        .gallery-input-group {
            display: grid;
            grid-template-columns: 2fr 1fr 2fr auto;
            gap: 10px;
            margin-bottom: 15px;
            align-items: end;
        }
        
        .banner-preview {
            max-width: 300px;
            margin-top: 10px;
            border-radius: 5px;
        }
        
        .section-divider {
            border-top: 2px solid #dee2e6;
            margin: 40px 0;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel - Pages & Gallery Management</h1>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <!-- Page Form -->
        <div class="page-form">
            <h2><?php echo $edit_page ? 'Edit Page' : 'Add New Page'; ?></h2>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <input type="hidden" name="pageid" value="<?php echo $edit_page ? $edit_page['pageid'] : ''; ?>">
                
                <div class="form-group">
                    <label for="pagetitle">Page Title *</label>
                    <input type="text" id="pagetitle" name="pagetitle" 
                           value="<?php echo $edit_page ? htmlspecialchars($edit_page['pagetitle']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="bannerimage">Banner Image</label>
                    <input type="file" id="bannerimage" name="bannerimage" accept="image/*">
                    <?php if ($edit_page && !empty($edit_page['bannerimage'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($edit_page['bannerimage']); ?>" 
                             class="banner-preview" alt="Current Banner">
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="bannerdescription">Banner Description</label>
                    <textarea id="bannerdescription" name="bannerdescription"><?php echo $edit_page ? htmlspecialchars($edit_page['bannerdescription']) : ''; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="longdescription">Long Description</label>
                    <textarea id="longdescription" name="longdescription"><?php echo $edit_page ? htmlspecialchars($edit_page['longdescription']) : ''; ?></textarea>
                </div>
                
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="isactive" name="isactive" value="1"
                           <?php echo ($edit_page && $edit_page['isactive']) || !$edit_page ? 'checked' : ''; ?>>
                    <label for="isactive" style="margin-bottom: 0;">Active</label>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="save_page" class="btn btn-primary">
                        <?php echo $edit_page ? 'Update Page' : 'Add Page'; ?>
                    </button>
                    <?php if ($edit_page): ?>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <?php if ($edit_page): ?>
        <!-- Gallery Management for Current Page -->
        <div class="section-divider"></div>
        
        <div class="gallery-management">
            <h2>Gallery Images for: <?php echo htmlspecialchars($edit_page['pagetitle']); ?></h2>
            
            <!-- Add Gallery Images Form -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" id="galleryForm">
                <input type="hidden" name="pageid" value="<?php echo $edit_page['pageid']; ?>">
                
                <div id="galleryInputsContainer">
                    <div class="gallery-input-group">
                        <div class="form-group">
                            <label>Image Title</label>
                            <input type="text" name="image_titles[]" placeholder="Image Title">
                        </div>
                        <div class="form-group">
                            <label>Display Order</label>
                            <input type="number" name="display_orders[]" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <label>Image File</label>
                            <input type="file" name="gallery_images[]" accept="image/*" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="button" onclick="addGalleryInput()" class="btn btn-secondary">+ Add More Images</button>
                    <button type="submit" name="add_gallery_images" class="btn btn-success">Upload Gallery Images</button>
                </div>
            </form>
            
            <!-- Display Existing Gallery Images -->
            <h3>Current Gallery Images</h3>
            <div class="gallery-grid">
                <?php
                $gallery_query = "SELECT * FROM tbl_ravi_gallery WHERE pageid = {$edit_page['pageid']} ORDER BY displayorder, galleryid";
                $gallery_result = $conn->query($gallery_query);
                
                if ($gallery_result && $gallery_result->num_rows > 0):
                    while ($gallery = $gallery_result->fetch_assoc()):
                ?>
                    <div class="gallery-item">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($gallery['galleryimage']); ?>" 
                             alt="<?php echo htmlspecialchars($gallery['imagetitle']); ?>">
                        <div class="gallery-info">
                            <p><strong>Title:</strong> <?php echo htmlspecialchars($gallery['imagetitle']); ?></p>
                            <p><strong>Order:</strong> <?php echo $gallery['displayorder']; ?></p>
                        </div>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="padding: 10px;">
                            <input type="hidden" name="galleryid" value="<?php echo $gallery['galleryid']; ?>">
                            <button type="submit" name="delete_gallery" class="btn btn-danger" 
                                    onclick="return confirm('Delete this image?')">Delete</button>
                        </form>
                    </div>
                <?php
                    endwhile;
                else:
                ?>
                    <p class="alert alert-info">No gallery images yet. Add some above!</p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- List All Pages -->
        <div class="section-divider"></div>
        
        <div class="pages-list">
            <h2>All Pages</h2>
            
            <?php if ($pages && $pages->num_rows > 0): ?>
                <?php while ($page = $pages->fetch_assoc()): ?>
                    <div class="page-item">
                        <h3><?php echo htmlspecialchars($page['pagetitle']); ?></h3>
                        <p><strong>Status:</strong> <?php echo $page['isactive'] ? 'Active' : 'Inactive'; ?></p>
                        <p><strong>Page ID:</strong> <?php echo $page['pageid']; ?></p>
                        
                        <?php
                        $gallery_count_result = $conn->query("SELECT COUNT(*) as count FROM tbl_ravi_gallery WHERE pageid = {$page['pageid']}");
                        $gallery_count = $gallery_count_result ? $gallery_count_result->fetch_assoc() : ['count' => 0];
                        ?>
                        <p><strong>Gallery Images:</strong> <?php echo $gallery_count['count']; ?></p>
                        
                        <div class="page-actions">
                            <a href="?edit_page=<?php echo $page['pageid']; ?>" class="btn btn-primary">Edit</a>
                            
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="display: inline;">
                                <input type="hidden" name="pageid" value="<?php echo $page['pageid']; ?>">
                                <button type="submit" name="delete_page" class="btn btn-danger" 
                                        onclick="return confirm('Delete this page and all its gallery images?')">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="alert alert-info">No pages found. Add your first page above!</p>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        function addGalleryInput() {
            const container = document.getElementById('galleryInputsContainer');
            const newGroup = document.createElement('div');
            newGroup.className = 'gallery-input-group';
            newGroup.innerHTML = `
                <div class="form-group">
                    <label>Image Title</label>
                    <input type="text" name="image_titles[]" placeholder="Image Title">
                </div>
                <div class="form-group">
                    <label>Display Order</label>
                    <input type="number" name="display_orders[]" value="0" min="0">
                </div>
                <div class="form-group">
                    <label>Image File</label>
                    <input type="file" name="gallery_images[]" accept="image/*" required>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger">Remove</button>
            `;
            container.appendChild(newGroup);
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
