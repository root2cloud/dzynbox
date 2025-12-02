<?php
require_once('header.php');

$conn = new mysqli('localhost', 'root', '', 'aeries_dbnew');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$message = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    try {
        switch ($action) {
            // PACKAGE ACTIONS
            case 'add_package':
                $stmt = $conn->prepare("INSERT INTO packages (package_name, bhk_type, original_price, discount_price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('ssss', $_POST['package_name'], $_POST['bhk_type'], $_POST['original_price'], $_POST['discount_price']);
                $stmt->execute();
                $message = "✅ Package added successfully!";
                break;
                
            case 'update_package':
                $stmt = $conn->prepare("UPDATE packages SET package_name=?, bhk_type=?, original_price=?, discount_price=? WHERE id=?");
                $stmt->bind_param('ssssi', $_POST['package_name'], $_POST['bhk_type'], $_POST['original_price'], $_POST['discount_price'], $_POST['package_id']);
                $stmt->execute();
                $message = "✅ Package updated successfully!";
                break;
                
            case 'delete_package':
                $stmt = $conn->prepare("DELETE FROM packages WHERE id=?");
                $stmt->bind_param('i', $_POST['package_id']);
                $stmt->execute();
                $message = "✅ Package deleted successfully!";
                break;
            
            // SECTION ACTIONS
            case 'add_section':
                $stmt = $conn->prepare("INSERT INTO package_sections (package_id, section_title) VALUES (?, ?)");
                $stmt->bind_param('is', $_POST['package_id'], $_POST['section_title']);
                $stmt->execute();
                $message = "✅ Section added successfully!";
                break;
                
            case 'update_section':
                $stmt = $conn->prepare("UPDATE package_sections SET section_title=? WHERE id=?");
                $stmt->bind_param('si', $_POST['section_title'], $_POST['section_id']);
                $stmt->execute();
                $message = "✅ Section updated successfully!";
                break;
                
            case 'delete_section':
                $stmt = $conn->prepare("DELETE FROM package_sections WHERE id=?");
                $stmt->bind_param('i', $_POST['section_id']);
                $stmt->execute();
                $message = "✅ Section deleted successfully!";
                break;
            
            // ITEM ACTIONS
            case 'add_item':
                $stmt = $conn->prepare("INSERT INTO section_items (section_id, item_name) VALUES (?, ?)");
                $stmt->bind_param('is', $_POST['section_id'], $_POST['item_name']);
                $stmt->execute();
                $message = "✅ Item added successfully!";
                break;
                
            case 'update_item':
                $stmt = $conn->prepare("UPDATE section_items SET item_name=? WHERE id=?");
                $stmt->bind_param('si', $_POST['item_name'], $_POST['item_id']);
                $stmt->execute();
                $message = "✅ Item updated successfully!";
                break;
                
            case 'delete_item':
                $stmt = $conn->prepare("DELETE FROM section_items WHERE id=?");
                $stmt->bind_param('i', $_POST['item_id']);
                $stmt->execute();
                $message = "✅ Item deleted successfully!";
                break;
        }
    } catch (Exception $e) {
        $error = "❌ Error: " . $e->getMessage();
    }
}

// Get all data
$packages = $conn->query("SELECT * FROM packages ORDER BY id DESC");
$sections = $conn->query("SELECT ps.*, p.package_name, p.bhk_type 
                         FROM package_sections ps 
                         JOIN packages p ON ps.package_id = p.id 
                         ORDER BY ps.package_id, ps.id");
$items = $conn->query("SELECT si.*, ps.section_title, p.package_name 
                      FROM section_items si 
                      JOIN package_sections ps ON si.section_id = ps.id 
                      JOIN packages p ON ps.package_id = p.id 
                      ORDER BY si.section_id, si.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Package Management</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; }
        .container { max-width: 1400px; margin: 0 auto; }
        .header { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); margin-bottom: 30px; text-align: center; }
        .header h1 { color: #333; font-size: 36px; margin-bottom: 10px; }
        .header p { color: #666; font-size: 16px; }
        .alert { padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 600; animation: slideIn 0.3s; }
        .alert-success { background: #4CAF50; color: white; }
        .alert-error { background: #f44336; color: white; }
        @keyframes slideIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        
        .tabs { display: flex; gap: 10px; margin-bottom: 30px; flex-wrap: wrap; }
        .tab-btn { background: white; color: #667eea; padding: 15px 30px; border: none; border-radius: 10px; cursor: pointer; font-size: 16px; font-weight: 600; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .tab-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
        .tab-btn.active { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        
        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeIn 0.3s; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .card h2 { color: #333; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 3px solid #667eea; font-size: 24px; }
        
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px; }
        .form-group { margin-bottom: 0; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; font-size: 14px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: 0.3s; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        
        .btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 15px; font-weight: 600; transition: 0.3s; display: inline-block; text-decoration: none; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4); }
        .btn-sm { padding: 8px 16px; font-size: 13px; }
        .btn-danger { background: linear-gradient(135deg, #f44336 0%, #e91e63 100%); }
        .btn-danger:hover { box-shadow: 0 6px 20px rgba(244, 67, 54, 0.4); }
        .btn-warning { background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%); }
        .btn-warning:hover { box-shadow: 0 6px 20px rgba(255, 152, 0, 0.4); }
        
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px; text-align: left; font-size: 14px; font-weight: 600; }
        td { padding: 15px; border-bottom: 1px solid #e0e0e0; font-size: 14px; }
        tr:hover { background: #f8f9ff; }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; }
        
        .badge { display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-primary { background: #667eea; color: white; }
        .badge-success { background: #4CAF50; color: white; }
        .badge-info { background: #2196F3; color: white; }
        
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 1000; align-items: center; justify-content: center; }
        .modal.active { display: flex; }
        .modal-content { background: white; padding: 30px; border-radius: 15px; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto; animation: modalSlide 0.3s; }
        @keyframes modalSlide { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .modal-close { background: none; border: none; font-size: 30px; cursor: pointer; color: #999; }
        
        @media (max-width: 768px) {
            .tabs { flex-direction: column; }
            .tab-btn { width: 100%; }
            .form-grid { grid-template-columns: 1fr; }
            .actions { flex-direction: column; }
            .btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Admin Control Panel</h1>
            <p>Manage Packages, Sections & Items</p>
        </div>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        
        <!-- TABS -->
        <div class="tabs">
            <button class="tab-btn active" onclick="openTab('packages')">📦 Packages</button>
            <button class="tab-btn" onclick="openTab('sections')">📋 Sections</button>
            <button class="tab-btn" onclick="openTab('items')">🔧 Items</button>
        </div>
        
        <!-- TAB 1: PACKAGES -->
        <div id="packages" class="tab-content active">
            <div class="card">
                <h2>➕ Add New Package</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="add_package">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Package Name *</label>
                            <input type="text" name="package_name" required placeholder="e.g., Smart Series">
                        </div>
                        <div class="form-group">
                            <label>BHK Type *</label>
                            <select name="bhk_type" required>
                                <option value="">Select BHK</option>
                                <option value="1 BHK">1 BHK</option>
                                <option value="2 BHK">2 BHK</option>
                                <option value="3 BHK">3 BHK</option>
                                <option value="4 BHK">4 BHK</option>
                                <option value="5 BHK">5 BHK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Original Price *</label>
                            <input type="text" name="original_price" required placeholder="e.g., 9.95 LAC">
                        </div>
                        <div class="form-group">
                            <label>Discount Price *</label>
                            <input type="text" name="discount_price" required placeholder="e.g., 7.92 LAC">
                        </div>
                    </div>
                    <button type="submit" class="btn">Add Package</button>
                </form>
            </div>
            
            <div class="card">
                <h2>📦 All Packages</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>BHK Type</th>
                                <th>Original Price</th>
                                <th>Discount Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($pkg = $packages->fetch_assoc()): ?>
                                <tr>
                                    <td><span class="badge badge-primary">#<?= $pkg['id'] ?></span></td>
                                    <td><strong><?= htmlspecialchars($pkg['package_name']) ?></strong></td>
                                    <td><span class="badge badge-info"><?= htmlspecialchars($pkg['bhk_type']) ?></span></td>
                                    <td>₹ <?= htmlspecialchars($pkg['original_price']) ?></td>
                                    <td><strong>₹ <?= htmlspecialchars($pkg['discount_price']) ?></strong></td>
                                    <td class="actions">
                                        <button onclick="editPackage(<?= $pkg['id'] ?>, '<?= addslashes($pkg['package_name']) ?>', '<?= $pkg['bhk_type'] ?>', '<?= $pkg['original_price'] ?>', '<?= $pkg['discount_price'] ?>')" class="btn btn-sm btn-warning">Edit</button>
                                        <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this package and all its sections/items?');">
                                            <input type="hidden" name="action" value="delete_package">
                                            <input type="hidden" name="package_id" value="<?= $pkg['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- TAB 2: SECTIONS -->
        <div id="sections" class="tab-content">
            <div class="card">
                <h2>➕ Add New Section</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="add_section">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Select Package *</label>
                            <select name="package_id" required>
                                <option value="">Choose Package</option>
                                <?php 
                                $pkgs = $conn->query("SELECT * FROM packages");
                                while ($p = $pkgs->fetch_assoc()): 
                                ?>
                                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['package_name']) ?> - <?= $p['bhk_type'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Section Title *</label>
                            <input type="text" name="section_title" required placeholder="e.g., LIVING ROOM">
                        </div>
                    </div>
                    <button type="submit" class="btn">Add Section</button>
                </form>
            </div>
            
            <div class="card">
                <h2>📋 All Sections</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Section Title</th>
                                <th>Package</th>
                                <th>BHK Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($sec = $sections->fetch_assoc()): ?>
                                <tr>
                                    <td><span class="badge badge-success">#<?= $sec['id'] ?></span></td>
                                    <td><strong><?= htmlspecialchars($sec['section_title']) ?></strong></td>
                                    <td><?= htmlspecialchars($sec['package_name']) ?></td>
                                    <td><span class="badge badge-info"><?= $sec['bhk_type'] ?></span></td>
                                    <td class="actions">
                                        <button onclick="editSection(<?= $sec['id'] ?>, '<?= addslashes($sec['section_title']) ?>')" class="btn btn-sm btn-warning">Edit</button>
                                        <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this section and all its items?');">
                                            <input type="hidden" name="action" value="delete_section">
                                            <input type="hidden" name="section_id" value="<?= $sec['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- TAB 3: ITEMS -->
        <div id="items" class="tab-content">
            <div class="card">
                <h2>➕ Add New Item</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="add_item">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Select Section *</label>
                            <select name="section_id" required>
                                <option value="">Choose Section</option>
                                <?php 
                                $secs = $conn->query("SELECT ps.id, ps.section_title, p.package_name 
                                                     FROM package_sections ps 
                                                     JOIN packages p ON ps.package_id = p.id");
                                while ($s = $secs->fetch_assoc()): 
                                ?>
                                    <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['package_name']) ?> - <?= htmlspecialchars($s['section_title']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item Name *</label>
                            <input type="text" name="item_name" required placeholder="e.g., Shoe rack - Cabinet And Shutters">
                        </div>
                    </div>
                    <button type="submit" class="btn">Add Item</button>
                </form>
            </div>
            
            <div class="card">
                <h2>🔧 All Items</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>Section</th>
                                <th>Package</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($itm = $items->fetch_assoc()): ?>
                                <tr>
                                    <td><span class="badge badge-info">#<?= $itm['id'] ?></span></td>
                                    <td><?= htmlspecialchars($itm['item_name']) ?></td>
                                    <td><strong><?= htmlspecialchars($itm['section_title']) ?></strong></td>
                                    <td><?= htmlspecialchars($itm['package_name']) ?></td>
                                    <td class="actions">
                                        <button onclick="editItem(<?= $itm['id'] ?>, '<?= addslashes($itm['item_name']) ?>')" class="btn btn-sm btn-warning">Edit</button>
                                        <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this item?');">
                                            <input type="hidden" name="action" value="delete_item">
                                            <input type="hidden" name="item_id" value="<?= $itm['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- EDIT MODALS -->
    <div id="editPackageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>✏️ Edit Package</h2>
                <button class="modal-close" onclick="closeModal('editPackageModal')">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="update_package">
                <input type="hidden" name="package_id" id="edit_pkg_id">
                <div class="form-group">
                    <label>Package Name</label>
                    <input type="text" name="package_name" id="edit_pkg_name" required>
                </div>
                <div class="form-group">
                    <label>BHK Type</label>
                    <select name="bhk_type" id="edit_pkg_bhk" required>
                        <option value="1 BHK">1 BHK</option>
                        <option value="2 BHK">2 BHK</option>
                        <option value="3 BHK">3 BHK</option>
                        <option value="4 BHK">4 BHK</option>
                        <option value="5 BHK">5 BHK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Original Price</label>
                    <input type="text" name="original_price" id="edit_pkg_orig" required>
                </div>
                <div class="form-group">
                    <label>Discount Price</label>
                    <input type="text" name="discount_price" id="edit_pkg_disc" required>
                </div>
                <button type="submit" class="btn">Update Package</button>
            </form>
        </div>
    </div>
    
    <div id="editSectionModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>✏️ Edit Section</h2>
                <button class="modal-close" onclick="closeModal('editSectionModal')">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="update_section">
                <input type="hidden" name="section_id" id="edit_sec_id">
                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" name="section_title" id="edit_sec_title" required>
                </div>
                <button type="submit" class="btn">Update Section</button>
            </form>
        </div>
    </div>
    
    <div id="editItemModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>✏️ Edit Item</h2>
                <button class="modal-close" onclick="closeModal('editItemModal')">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="update_item">
                <input type="hidden" name="item_id" id="edit_itm_id">
                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="item_name" id="edit_itm_name" required>
                </div>
                <button type="submit" class="btn">Update Item</button>
            </form>
        </div>
    </div>
    
    <script>
        function openTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }
        
        function editPackage(id, name, bhk, orig, disc) {
            document.getElementById('edit_pkg_id').value = id;
            document.getElementById('edit_pkg_name').value = name;
            document.getElementById('edit_pkg_bhk').value = bhk;
            document.getElementById('edit_pkg_orig').value = orig;
            document.getElementById('edit_pkg_disc').value = disc;
            document.getElementById('editPackageModal').classList.add('active');
        }
        
        function editSection(id, title) {
            document.getElementById('edit_sec_id').value = id;
            document.getElementById('edit_sec_title').value = title;
            document.getElementById('editSectionModal').classList.add('active');
        }
        
        function editItem(id, name) {
            document.getElementById('edit_itm_id').value = id;
            document.getElementById('edit_itm_name').value = name;
            document.getElementById('editItemModal').classList.add('active');
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
        
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
require_once('footer.php');
?>
