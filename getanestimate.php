<?php require_once('header.php'); ?>

<style>
/* Container Animation */
.container {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Card Animation - Staggered Effect */
.card {
    opacity: 0; 
    animation: cardFadeIn 0.5s ease-out forwards;
    transition: all 0.3s ease;
}

.card:nth-child(1) { animation-delay: 0.1s; }
.card:nth-child(2) { animation-delay: 0.2s; }
.card:nth-child(3) { animation-delay: 0.3s; }
.card:nth-child(4) { animation-delay: 0.4s; }
.card:nth-child(5) { animation-delay: 0.5s; }
.card:nth-child(6) { animation-delay: 0.6s; }
.card:nth-child(7) { animation-delay: 0.7s; }
.card:nth-child(8) { animation-delay: 0.8s; }

@keyframes cardFadeIn {
    from {
        opacity: 0;
        transform: translateY(20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Card Hover Effect */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
}

/* Checkbox Animation */
input[type="checkbox"] {
    transition: all 0.3s ease;
    cursor: pointer;
}

input[type="checkbox"]:hover {
    transform: scale(1.7);
}

input[type="checkbox"]:checked {
    animation: checkboxPulse 0.4s ease;
}

@keyframes checkboxPulse {
    0%, 100% { transform: scale(1.5); }
    50% { transform: scale(1.8); }
}

/* Button Animation */
.quantity-btn {
    transition: all 0.3s ease;
    background-color: #E0F4E0;
    border: none;
    padding: 8px 12px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-btn:hover {
    background-color: #C8E6C9;
    transform: scale(1.15);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.quantity-btn:active {
    transform: scale(0.95);
}

/* Quantity Number Animation */
.quantity {
    transition: all 0.3s ease;
    display: inline-block;
}

.quantity.updated {
    animation: quantityBounce 0.4s ease;
}

@keyframes quantityBounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.3); color: #4CAF50; }
}

/* Next Button Animation */
.btn-primary {
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-primary:hover::before {
    width: 300px;
    height: 300px;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.btn-primary:active {
    transform: translateY(0);
}

/* Card Title - SAME SIZE ON MOBILE & DESKTOP */
.card-title {
    margin: 0;
    font-weight: bold;
    color: #333;
    font-size: 16px !important;
}

/* Mobile Responsive Styles - TITLE CENTERED */
@media (max-width: 768px) {
    .col-md-3 {
        padding: 8px !important;
    }
    
    /* Keep card HORIZONTAL */
    .card {
        padding: 12px !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 10px;
    }
    
    /* CENTER the card-title */
    .card-title {
        font-size: 16px !important;
        font-weight: bold;
        flex: 1;
        text-align: center !important;
        margin: 0 10px;
    }
    
    .quantity-btn {
        width: 30px;
        height: 30px;
        font-size: 15px;
    }
}

@media (max-width: 480px) {
    .container {
        /* padding: 20px !important; */
    }
    
    /* Keep card HORIZONTAL on small screens */
    .card {
        padding: 10px !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: space-between !important;
    }
    
    /* CENTER the card-title on small screens */
    .card-title {
        font-size: 16px !important;
        font-weight: bold;
        text-align: center !important;
        flex: 1;
        margin: 0 8px;
    }
    
    .quantity-btn {
        width: 28px;
        height: 28px;
        font-size: 14px;
    }
    
    .quantity {
        font-size: 14px;
    }
}

@media (max-width: 360px) {
    /* Keep card HORIZONTAL even on extra small screens */
    .card {
        flex-direction: row !important;
        align-items: center !important;
        padding: 8px !important;
    }
    
    /* CENTER the card-title even on extra small screens */
    .card-title {
        font-size: 14px !important;
        font-weight: bold;
        text-align: center !important;
        flex: 1;
        margin: 0 5px;
    }
    
    .quantity-btn {
        width: 26px;
        height: 26px;
        font-size: 13px;
    }
}

</style>

<!-- fetching row banner login -->
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_login = $row['banner_login'];
}
?>

<!-- login form -->
<?php
if(isset($_POST['form1'])) {
        
    if(empty($_POST['cust_email']) || empty($_POST['cust_password'])) {
        $error_message = LANG_VALUE_132.'<br>';
    } else {
        
        $cust_email = strip_tags($_POST['cust_email']);
        $cust_password = strip_tags($_POST['cust_password']);

        $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
        $statement->execute(array($cust_email));
        $total = $statement->rowCount();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row) {
            $cust_status = $row['cust_status'];
            $row_password = $row['cust_password'];
        }

        if($total==0) {
            $error_message .= LANG_VALUE_133.'<br>';
        } else {
            //using MD5 form
            if( $row_password != md5($cust_password) ) {
                $error_message .= LANG_VALUE_139.'<br>';
            } else {
                if($cust_status == 0) {
                    $error_message .= LANG_VALUE_148.'<br>';
                } else {
                    $_SESSION['customer'] = $row;
                    header("location: ".BASE_URL."dashboard.php");
                }
            }
            
        }
    }
}
?>

<div class="page-banner" style="background-color:rgba(245, 245, 245, 1.00);">
    <div class="inner">
       <h1 style="color: rgba(15, 15, 15, 1.00);">Get Estimate</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">
                <div class="heading text-center">
                <h3>Estimation By Package</h3>
                <h3 class="text-center" style="display: flex; justify-content: center; align-items: center;">
                    <a href="selectpackage.php" target="_blank" style="text-decoration: none; color: inherit; display: flex; align-items: center;"> 
                        Estimation With Floor Plan 
                        <i class="fas fa-external-link-alt" style="margin-left: 8px; font-size: 18px;"></i>
                    </a>
                </h3>

                <!-- Font Awesome CDN for Icons -->
                <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

                </div>

<?php
$statement = $pdo->prepare("SELECT room_name, economy_price, premium_price, luxury_price, room_price FROM tbl_rooms");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container" style="background-color: #f9f9f9; padding: 37px; border-radius: 10px;">
    <form method="post" action="prices.php">
    <div class="row">
        <?php
        $count = 0;

        foreach ($result as $row) {
            if ($count % 4 == 0 && $count != 0) {
                echo '</div><div class="row">';
            }
            ?>

            <div class="col-md-3" style="padding: 10px;">
                <div class="card" style="width: 100%; padding: 15px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1); background-color: #fff; border-radius: 8px; display: flex; align-items: center; justify-content: space-between;">
                    <!-- Checkbox for room selection -->
                    <input type="checkbox" name="select_room[]" value="<?php echo $row['room_name']; ?>" style="margin-right: 10px; transform: scale(1.5);" 
                        data-economy-price="<?php echo $row['economy_price']; ?>" 
                        data-premium-price="<?php echo $row['premium_price']; ?>" 
                        data-luxury-price="<?php echo $row['luxury_price']; ?>" 
                        data-room-price="<?php echo $row['room_price']; ?>" 
                        data-room-id="<?php echo $row['id']; ?>">

                    <!-- Room Name -->
                    <h5 class="card-title"><?php echo $row['room_name']; ?></h5>

                    <!-- Quantity Selector -->
                    <div style="display: flex; align-items: center;">
                        <button type="button" class="quantity-btn" onclick="changeQuantity(this, -1, <?php echo $row['economy_price']; ?>, <?php echo $row['premium_price']; ?>, <?php echo $row['luxury_price']; ?>, <?php echo $row['room_price']; ?>)">-</button>
                        <span class="quantity" style="margin: 0 8px; font-weight: bold; color: #333;">1</span>
                        <button type="button" class="quantity-btn" onclick="changeQuantity(this, 1, <?php echo $row['economy_price']; ?>, <?php echo $row['premium_price']; ?>, <?php echo $row['luxury_price']; ?>, <?php echo $row['room_price']; ?>)">+</button>
                        <input type="hidden" name="quantities[<?php echo $row['room_name']; ?>]" class="room-quantity" value="1">
                    </div>

                    <!-- Display calculated prices -->
                    <div style="display: flex; justify-content: space-between; display: none;">
                        <p>Economy Price: $<span class="economy-price"><?php echo $row['economy_price']; ?></span></p>
                        <p>Premium Price: $<span class="premium-price"><?php echo $row['premium_price']; ?></span></p>
                        <p>Luxury Price: $<span class="luxury-price"><?php echo $row['luxury_price']; ?></span></p>
                        <p>Room Price: $<span class="room-price"><?php echo $row['room_price']; ?></span></p>
                    </div>
                </div>
            </div>

            <?php
            $count++;
        }
        ?>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 5px;">NEXT</button>
    </div>
    </div>
    </form>
</div>

<script>
function changeQuantity(button, change, economyPrice, premiumPrice, luxuryPrice, roomPrice) {
    const quantitySpan = button.parentElement.querySelector('.quantity');
    const hiddenInput = button.parentElement.querySelector('.room-quantity');
    let currentQuantity = parseInt(quantitySpan.textContent);
    
    currentQuantity += change;
    if (currentQuantity < 1) currentQuantity = 1;
    
    quantitySpan.textContent = currentQuantity;
    hiddenInput.value = currentQuantity;
    
    // Add animation class
    quantitySpan.classList.add('updated');
    setTimeout(() => {
        quantitySpan.classList.remove('updated');
    }, 400);
    
    // Update prices (if needed)
    const card = button.closest('.card');
    const economySpan = card.querySelector('.economy-price');
    const premiumSpan = card.querySelector('.premium-price');
    const luxurySpan = card.querySelector('.luxury-price');
    const roomSpan = card.querySelector('.room-price');
    
    if (economySpan) economySpan.textContent = (economyPrice * currentQuantity).toFixed(2);
    if (premiumSpan) premiumSpan.textContent = (premiumPrice * currentQuantity).toFixed(2);
    if (luxurySpan) luxurySpan.textContent = (luxuryPrice * currentQuantity).toFixed(2);
    if (roomSpan) roomSpan.textContent = (roomPrice * currentQuantity).toFixed(2);
}
</script>

                </div>                
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>