<?php
// Dynamically calculate or retrieve the $totalEconomyPrice value
$totalEconomyPrice = 0.000; 
$totalPremiumPrice = 0.000; 
$totalLuxuryPrice = 0.000; 

// Replace this line with your actual calculation logic
?>

<?php
require_once('header.php');

// Define the getRoomDetails() function
function getRoomDetails($roomName) {
    // Replace with your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aeries_dbnew";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

   // Check for a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch room details by name, including additional fields
    $stmt = $conn->prepare("SELECT room_price, economy_price, premium_price, luxury_price, 
                            economy_furniture, economy_accessories, 
                            premium_furniture, premium_accessories, 
                            luxury_furniture, luxury_accessories 
                            FROM tbl_rooms WHERE room_name = ?");
    $stmt->bind_param("s", $roomName);
    $stmt->execute();
    $result = $stmt->get_result();
    $roomDetails = $result->fetch_assoc();

    // Close the connection
    $stmt->close();
    $conn->close();

    return $roomDetails;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize cumulative totals for prices
    $cumulativeEconomyPrice = 0;
    $cumulativePremiumPrice = 0;
    $cumulativeLuxuryPrice = 0;

    // Initialize cumulative strings for furniture and accessories
    $cumulativeEconomyFurniture = "";
    $cumulativeEconomyAccessories = "";
    $cumulativePremiumFurniture = "";
    $cumulativePremiumAccessories = "";
    $cumulativeLuxuryFurniture = "";
    $cumulativeLuxuryAccessories = "";
    $cumulativequantity = "";

    // Initialize cumulative room names
    $cumulativeRoomNames = "";

    // Loop through the selected rooms
    if (isset($_POST['select_room'])) {
        foreach ($_POST['select_room'] as $selectedRoom) {
            // Append room name to cumulative list
            $cumulativeRoomNames = implode(", ", $_POST['select_room']);

            // Extract quantity using the room name as key
            $quantity = isset($_POST['quantities'][$selectedRoom]) ? intval($_POST['quantities'][$selectedRoom]) : 0;

            // Fetch room details from the database
            $roomDetails = getRoomDetails($selectedRoom);

            // Assuming $roomDetails returns an associative array with the room data
            if ($roomDetails) {
                // Room prices
                $roomPrice = $roomDetails['room_price'];
                $economyPrice = $roomDetails['economy_price'];
                $premiumPrice = $roomDetails['premium_price'];
                $luxuryPrice = $roomDetails['luxury_price'];

                // Additional details
                $economyFurniture = $roomDetails['economy_furniture'];
                $economyAccessories = $roomDetails['economy_accessories'];
                $premiumFurniture = $roomDetails['premium_furniture'];
                $premiumAccessories = $roomDetails['premium_accessories'];
                $luxuryFurniture = $roomDetails['luxury_furniture'];
                $luxuryAccessories = $roomDetails['luxury_accessories'];

                // Calculate total prices for each type
                $totalRoomPrice = $roomPrice * $quantity;
                $totalEconomyPrice = $economyPrice * $quantity;
                $totalPremiumPrice = $premiumPrice * $quantity;
                $totalLuxuryPrice = $luxuryPrice * $quantity;

                // Add to cumulative totals
                $cumulativeEconomyPrice += $totalEconomyPrice;
                $cumulativePremiumPrice += $totalPremiumPrice;
                $cumulativeLuxuryPrice += $totalLuxuryPrice;

                // Concatenate furniture and accessories for cumulative output
               // Append each furniture item with a newline character
               $cumulativeEconomyFurniture .= $economyFurniture . " ,\n";

                $cumulativeEconomyAccessories .= $economyAccessories . " ,\n";
                $cumulativePremiumFurniture .= $premiumFurniture . " ,\n";
                $cumulativePremiumAccessories .= $premiumAccessories . " ,\n";
                $cumulativeLuxuryFurniture .= $luxuryFurniture . " ,\n";
                $cumulativeLuxuryAccessories .= $luxuryAccessories . " ,\n";
                $cumulativequantity .= $quantity . ",";
            }
        }
    } else {
        echo "No rooms selected.";
    }
}
?>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 15px;
}

h1 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 10px;
}

/* Page Banner - GREY BACKGROUND (Same on Desktop & Mobile) */
.page-banner {
    background-color: rgba(245, 245, 245, 1);
    padding: 40px 20px;
    text-align: center;
}

.page-banner .inner {
    max-width: 1200px;
    margin: 0 auto;
}

.page-banner h1 {
    font-size: 2.2rem;
    color: rgba(15, 15, 15, 1);
    margin: 0;
    padding: 0;
}

/* Packages Container */
.packages {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px 10px;
}

/* Package Cards */
.package {
    flex: 1 1 calc(25% - 20px);
    min-width: 250px;
    max-width: 300px;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.package:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.package h3 {
    font-size: 22px;
    margin-bottom: 15px;
    font-weight: 700;
}

.package ul {
    list-style: none;
    padding: 0;
    margin: 0 0 20px;
    flex-grow: 1;
}

.package ul li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 1.4;
}

.package ul li::before {
    content: "✔";
    color: #4CAF50;
    margin-right: 10px;
    flex-shrink: 0;
    font-weight: bold;
}

.package.economy { 
    background: linear-gradient(135deg, #a8d5a1, #6bbf59);
    color: white;
}

.package.premium { 
    background: linear-gradient(135deg, #a1c4fd, #70a1ff);
    color: white;
}

.package.luxury { 
    background: linear-gradient(135deg, #fbc2eb, #a18cd1);
    color: white;
}

.package.custom { 
    background-color: #333;
    color: #fff;
}

/* Select Button */
.select-button {
    display: inline-block;
    padding: 12px 24px;
    background-color: rgba(255, 255, 255, 0.9);
    color: #333;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    font-size: 15px;
    border-radius: 6px;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
}

.select-button:hover {
    background-color: #333;
    color: #fff;
    border-color: #fff;
}

.package.custom .select-button {
    background-color: #4CAF50;
    color: #fff;
}

.package.custom .select-button:hover {
    background-color: #45a049;
}

/* Modal Styles - FIXED CLOSE BUTTON */
.modal-background {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    z-index: 1000;
    padding: 20px;
}

.modal-box {
    background: white;
    border-radius: 12px;
    padding: 60px 30px 30px 30px;
    width: 100%;
    max-width: 900px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.modal-box h3 {
    margin-top: 0;
    padding-top: 0;
}

/* Close Button - FIXED POSITIONING */
.close-button {
    position: absolute;
    top: 10px;
    right: 15px;
    z-index: 100;
    line-height: 1;
}

.close-button button {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid #ddd;
    font-size: 32px;
    cursor: pointer;
    color: #333;
    transition: all 0.3s ease;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    line-height: 1;
    font-weight: bold;
}

.close-button button:hover {
    background: #ff0000;
    color: #fff;
    border-color: #ff0000;
    transform: rotate(90deg);
}

.header {
    padding: 10px 50px 10px 10px;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.sub-header {
    text-align: center;
    padding: 10px 0 20px;
    font-size: 16px;
    color: #666;
}

.price {
    font-size: 36px;
    color: #333;
    margin: 20px 0;
    font-weight: bold;
}

/* Download Button */
.download-button {
    background-color: #fff;
    color: #333;
    border: 2px solid #333;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.download-button:hover {
    background-color: #333;
    color: #fff;
}

.download-button img {
    width: 18px;
    height: 18px;
    vertical-align: middle;
    margin-left: 8px;
}

/* Compare Packages Section - WHITE BACKGROUND, NO BORDER */
.compare-section {
    padding: 40px 0;
    margin-bottom: 0;
    background-color: #fff;
}

.show-more {
    font-size: 0.9rem;
    color: #555;
    cursor: pointer;
    text-decoration: underline;
}

/* Icons - DARKER */
.icon {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 2.5rem;
    opacity: 0.5;
    filter: brightness(0.7);
}

.description {
    font-size: 0.9rem;
    margin-top: 10px;
    opacity: 0.9;
}

/* Page Container - WHITE BACKGROUND */
.page {
    width: 100%;
    padding: 40px 0 0 0;
    background-color: #fff;
}

/* MOBILE RESPONSIVE STYLES */
@media (max-width: 991px) {
    .package {
        flex: 1 1 calc(50% - 20px);
        max-width: none;
    }
}

@media (max-width: 768px) {
    /* Page Banner - LARGER TEXT SIZE */
    .page-banner {
        padding: 25px 15px;
        background-color: rgba(245, 245, 245, 1);
    }
    
    .page-banner .inner {
        background: transparent;
        padding: 0;
        border-radius: 0;
        box-shadow: none;
    }
    
    .page-banner h1 {
        font-size: 1.75rem;
        line-height: 1.4;
        color: rgba(15, 15, 15, 1);
        font-weight: 700;
        word-spacing: 2px;
    }
    
    h1 {
        font-size: 1.6rem;
    }
    
    /* Page Container - WHITE BACKGROUND */
    .page {
        background-color: #fff;
    }
    
    .packages {
        gap: 15px;
        padding: 15px 10px;
    }
    
    .package {
        flex: 1 1 100%;
        max-width: none;
        padding: 20px;
    }
    
    .package h3 {
        font-size: 20px;
    }
    
    .package ul li {
        font-size: 13px;
    }
    
    .select-button {
        padding: 10px 20px;
        font-size: 14px;
    }
    
    /* Compare Section - WHITE BACKGROUND, NO BORDER */
    .compare-section {
        padding: 30px 0;
        margin-bottom: 0;
        background-color: #fff;
    }
    
    /* Modal - Mobile */
    .modal-box {
        padding: 55px 20px 20px 20px;
        max-width: 95%;
    }
    
    .close-button {
        top: 8px;
        right: 8px;
    }
    
    .close-button button {
        width: 36px;
        height: 36px;
        font-size: 28px;
        border-width: 1px;
    }
    
    .header {
        font-size: 18px;
        padding: 10px 40px 10px 10px;
    }
    
    .sub-header {
        font-size: 14px;
    }
    
    .price {
        font-size: 28px;
    }
    
    .download-button {
        padding: 10px 20px;
        font-size: 14px;
    }
    
    /* Icons - Darker on mobile */
    .icon {
        font-size: 2rem;
        top: 15px;
        right: 15px;
        opacity: 0.6;
        filter: brightness(0.6);
    }
}

@media (max-width: 600px) {
    /* Banner - EVEN LARGER TEXT for small phones */
    .page-banner {
        padding: 20px 12px;
    }
    
    .page-banner h1 {
        font-size: 1.6rem;
        line-height: 1.35;
        font-weight: 700;
        letter-spacing: 0.3px;
    }
}

@media (max-width: 480px) {
    /* Page Banner - OPTIMIZED FOR SMALL SCREENS */
    .page-banner {
        padding: 18px 10px;
        background-color: rgba(245, 245, 245, 1);
    }
    
    .page-banner .inner {
        background: transparent;
        padding: 0;
        border-radius: 0;
        box-shadow: none;
    }
    
    .page-banner h1 {
        font-size: 1.45rem;
        line-height: 1.35;
        color: rgba(15, 15, 15, 1);
        font-weight: 700;
        letter-spacing: 0.2px;
        word-spacing: 1px;
    }
    
    h1 {
        font-size: 1.4rem;
    }
    
    .packages {
        gap: 12px;
        padding: 10px 8px;
    }
    
    .package {
        padding: 18px;
        min-width: 100%;
    }
    
    .package h3 {
        font-size: 18px;
        margin-bottom: 12px;
    }
    
    .package ul {
        margin-bottom: 15px;
    }
    
    .package ul li {
        font-size: 12px;
        margin-bottom: 8px;
    }
    
    .select-button {
        padding: 10px 18px;
        font-size: 13px;
    }
    
    /* Compare Section - WHITE BACKGROUND, NO BORDER */
    .compare-section {
        padding: 25px 0;
        background-color: #fff;
    }
    
    /* Modal - Small Screen */
    .modal-box {
        padding: 50px 15px 15px 15px;
        max-width: 100%;
        border-radius: 8px;
    }
    
    .close-button {
        top: 5px;
        right: 5px;
    }
    
    .close-button button {
        width: 32px;
        height: 32px;
        font-size: 24px;
    }
    
    .header {
        font-size: 16px;
        padding: 8px 35px 8px 8px;
        line-height: 1.3;
    }
    
    .sub-header {
        font-size: 12px;
        padding: 5px 0 12px;
    }
    
    .price {
        font-size: 24px;
        margin: 15px 0;
    }
    
    .download-button {
        padding: 10px 16px;
        font-size: 13px;
        width: 100%;
        text-align: center;
    }
    
    /* Icons - Even darker on small screens */
    .icon {
        font-size: 1.8rem;
        opacity: 0.7;
        filter: brightness(0.5);
    }
}

/* Extra small devices */
@media (max-width: 360px) {
    .page-banner {
        padding: 15px 8px;
    }
    
    .page-banner h1 {
        font-size: 1.25rem;
        line-height: 1.3;
        font-weight: 700;
        letter-spacing: 0.1px;
    }
    
    .package {
        padding: 15px;
    }
    
    .package h3 {
        font-size: 16px;
    }
    
    .package ul li {
        font-size: 11px;
    }
    
    .select-button {
        padding: 8px 15px;
        font-size: 12px;
    }
    
    .compare-section {
        padding: 20px 0;
    }
    
    .modal-box {
        padding: 45px 12px 12px 12px;
    }
    
    .close-button button {
        width: 28px;
        height: 28px;
        font-size: 22px;
    }
}
</style>

<div class="page-banner">
    <div class="inner">
       <h1>Pick the package that suits you the best</h1>
    </div>
</div>

<div class="page">
    <div class="container">
    <div class="packages">
<!-- Economy Package -->
<div class="package economy">
    <h3>Economy</h3>
    <ul>
        <li>Core material - HDF-HMR</li>
        <li>Finish - Laminate</li>
        <li>Functional designs</li>
        <li>Necessary furnishings</li>
        <li>Premium Emulsion paint</li>
    </ul>
    <div class="select-button" onclick="showEconomyDetails()">Details</div>
</div>

<!-- Premium Package -->
<div class="package premium">
    <h3>Premium</h3>
    <ul>
        <li>Core material - HDF-HMR/BWR</li>
        <li>Finish - PU/Laminate/Acrylic</li>
        <li>Functional and stylish designs</li>
        <li>Wide range of furnishings</li>
        <li>Royale Shyne/Royale Emulsion paint</li>
    </ul>
    <div class="select-button" onclick="showPremiumDetails()">Details</div>
</div>

<!-- Luxury Package -->
<div class="package luxury">
    <h3>Luxury</h3>
    <ul>
        <li>Core material - HDF-HMR/BWP/BWR</li>
        <li>Finish - Designer PU/Glass/Fabric/Leatherette</li>
        <li>High-end designs</li>
        <li>Extensive array of furnishings</li>
        <li>Royale Glitz/Royale Shyne paint</li>
    </ul>
    <div class="select-button" onclick="showLuxuryDetails()">Details</div>
</div>

<div class="package custom">
    <h3>Design a package that fits you best</h3>
    <p>Our designers will get in touch to customize your package.</p>
    <div class="select-button" onclick="window.location.href='selectpackage.php'">Package</div>
</div>

<!-- Economy Modal Popup -->
<div class="modal-background" id="economyModal">
    <div class="modal-box">
        <div class="close-button">
            <button onclick="closeModal('economyModal')">×</button>
        </div>
        <div class="header">Your estimate is ready - The first step towards your dream home!</div>
        <div class="sub-header">We're excited to be part of your dream home journey!</div>
        <h3>Economy</h3>
        <p class="price">
            <?php echo " ₹" . number_format($cumulativeEconomyPrice, 2); ?>
        </p>
        <p><?php echo "Room Name: " . htmlspecialchars($cumulativeRoomNames).  " (" . htmlspecialchars($cumulativequantity) . ")"; ?></p><hr>
        <p><?php echo "Furniture: " . nl2br(htmlspecialchars($cumulativeEconomyFurniture)); ?></p>
        <hr>
        <p><?php echo "Accessories: " . nl2br(htmlspecialchars($cumulativeEconomyAccessories)); ?></p>
       <hr>
        <p style="font-size: 12px; color: #888;">
            *This is only an indicative price based on our clients' average spends. The final price can be higher or lower depending on factors like finish material, number of furniture pieces, civil work required, design elements, and wood type.
        </p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="#" class="download-button">Download PDF <img src="pdf-icon.png" alt="PDF Icon"></a>
        </div>
    </div>
</div>

<!-- Premium Modal Popup -->
<div class="modal-background" id="premiumModal">
    <div class="modal-box">
        <div class="close-button">
            <button onclick="closeModal('premiumModal')">×</button>
        </div>
        <div class="header">Your estimate is ready - The first step towards your dream home!</div>
        <div class="sub-header">We're excited to be part of your dream home journey!</div>
        <h3>Premium</h3>
        <p class="price">
            <?php echo " ₹" . number_format( $cumulativePremiumPrice, 2); ?>
        </p>
        <p><?php echo "Room Name: " . htmlspecialchars($cumulativeRoomNames) . " (" . htmlspecialchars($cumulativequantity) . ")"; ?></p><hr>
        <p><?php echo "Furniture: " . nl2br(htmlspecialchars($cumulativePremiumFurniture)); ?></p>
        <p><?php echo "Accessories: " . nl2br(htmlspecialchars($cumulativePremiumAccessories)); ?></p>
        <p style="font-size: 12px; color: #888;">
        *This is only an indicative price based on our clients' average spends. The final price can be higher or lower depending on factors like finish material, number of furniture pieces, civil work required, design elements, and wood type.
        </p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="#" class="download-button">Download PDF <img src="pdf-icon.png" alt="PDF Icon"></a>
        </div>
    </div>
</div>

<!-- Luxury Modal Popup -->
<div class="modal-background" id="luxuryModal">
    <div class="modal-box">
        <div class="close-button">
            <button onclick="closeModal('luxuryModal')">×</button>
        </div>
        <div class="header">Your estimate is ready - The first step towards your dream home!</div>
        <div class="sub-header">We're excited to be part of your dream home journey!</div>
        <h3>Luxury</h3>
        <p class="price">
            <?php echo " ₹" . number_format($cumulativeLuxuryPrice, 2); ?>
        </p>
        <p><?php echo "Room Name: " . htmlspecialchars($cumulativeRoomNames) . " (" . htmlspecialchars($cumulativequantity) . ")"; ?></p><hr>
        <p><?php echo "Furniture: " . nl2br(htmlspecialchars($cumulativeLuxuryFurniture)); ?></p>
        <p><?php echo "Accessories: " . nl2br(htmlspecialchars($cumulativeLuxuryAccessories)); ?></p>
        <p style="font-size: 12px; color: #888;">
        *This is only an indicative price based on our clients' average spends. The final price can be higher or lower depending on factors like finish material, number of furniture pieces, civil work required, design elements, and wood type.
        </p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="#" class="download-button">Download PDF <img src="pdf-icon.png" alt="PDF Icon"></a>
        </div>
    </div>
</div>

<script>
    // Show the Economy modal
    function showEconomyDetails() {
        document.getElementById("economyModal").style.display = "flex";
    }
    // Show the Premium modal
    function showPremiumDetails() {
        document.getElementById("premiumModal").style.display = "flex";
    }
    // Show the Luxury modal
    function showLuxuryDetails() {
        document.getElementById("luxuryModal").style.display = "flex";
    }
    // Hide a specific modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }
</script>

</div>

<!-- Compare Packages Section - WHITE BACKGROUND, NO SEPARATOR -->
<div class="container compare-section">
        <h1>Compare packages <span class="show-more">show more</span></h1>
        <div class="packages">
    <div class="package economy">
        <div class="icon">⭐</div>
        <h2>Economy</h2>
        <p class="price">
            <?php echo " ₹" . number_format($cumulativeEconomyPrice, 2); ?>
        </p>
        <p class="description">Cumulative Economy Price</p>
    </div>
    <div class="package premium">
        <div class="icon">💎</div>
        <h2>Premium</h2>
        <p class="price">
            <?php echo " ₹" . number_format($cumulativePremiumPrice, 2); ?>
        </p>
        <p class="description">Cumulative Premium Price</p>
    </div>
    <div class="package luxury">
        <div class="icon">👑</div>
        <h2>Luxury</h2>
        <p class="price">
            <?php echo " ₹" . number_format($cumulativeLuxuryPrice, 2); ?>
        </p>
        <p class="description">Cumulative Luxury Price</p>
    </div>
</div>
</div>

<script>
function goBack() {
    window.location.href = "getanestimate.php";
}
</script>

    </div>
</div>

<?php require_once('footer.php'); ?>
