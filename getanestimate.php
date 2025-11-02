<?php require_once('header.php'); ?>

<style>
/* ============================================
   🏠 INTERIOR DESIGN LUXURY ESTIMATION UI 2025 🏠
   ============================================ */

:root {
    --interior-cream: #F5F1E8;
    --interior-charcoal: #2C3E50;
    --interior-gold: #C9A962;
    --interior-sage: #8B9D83;
    --interior-terracotta: #D4856A;
    --interior-navy: #1A3B5C;
    --shadow-soft: 0 15px 40px rgba(44, 62, 80, 0.12);
    --shadow-hover: 0 25px 60px rgba(44, 62, 80, 0.25);
}

/* ============================================
   ARCHITECTURAL BACKGROUND WITH BLUEPRINT GRID
   ============================================ */
body {
    background: linear-gradient(135deg, #F5F1E8 0%, #E8E4DA 100%);
    position: relative;
    overflow-x: hidden;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        repeating-linear-gradient(0deg, rgba(201, 169, 98, 0.03) 0px, rgba(201, 169, 98, 0.03) 1px, transparent 1px, transparent 40px),
        repeating-linear-gradient(90deg, rgba(201, 169, 98, 0.03) 0px, rgba(201, 169, 98, 0.03) 1px, transparent 1px, transparent 40px);
    z-index: -1;
    animation: blueprintPan 60s linear infinite;
}

@keyframes blueprintPan {
    0% { background-position: 0 0; }
    100% { background-position: 40px 40px; }
}

/* Floating Design Elements */
.design-element {
    position: fixed;
    pointer-events: none;
    opacity: 0.08;
    z-index: 0;
}

.design-element.ruler {
    width: 200px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--interior-gold), transparent);
    animation: rulerFloat 20s ease-in-out infinite;
}

@keyframes rulerFloat {
    0%, 100% { transform: translateX(-100px) translateY(100px) rotate(45deg); }
    50% { transform: translateX(calc(100vw + 100px)) translateY(80vh) rotate(45deg); }
}

/* ============================================
   LUXURY MATERIAL DESIGN CONTAINER
   ============================================ */
.container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(30px);
    border: 3px solid var(--interior-gold);
    border-radius: 20px;
    padding: 60px !important;
    box-shadow: 
        var(--shadow-soft),
        inset 0 1px 0 rgba(255, 255, 255, 1),
        0 0 0 1px rgba(201, 169, 98, 0.1);
    position: relative;
    overflow: hidden;
    animation: containerSlideIn 1s cubic-bezier(0.22, 0.61, 0.36, 1);
}

@keyframes containerSlideIn {
    0% {
        opacity: 0;
        transform: translateY(80px) scale(0.95);
        filter: blur(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
    }
}

/* Elegant Corner Accents */
.container::before,
.container::after {
    content: '';
    position: absolute;
    width: 80px;
    height: 80px;
    border: 2px solid var(--interior-gold);
    opacity: 0.4;
}

.container::before {
    top: 20px;
    left: 20px;
    border-right: none;
    border-bottom: none;
    animation: cornerPulse 3s ease-in-out infinite;
}

.container::after {
    bottom: 20px;
    right: 20px;
    border-left: none;
    border-top: none;
    animation: cornerPulse 3s ease-in-out infinite 1.5s;
}

@keyframes cornerPulse {
    0%, 100% { opacity: 0.4; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.1); }
}

/* ============================================
   SOPHISTICATED TYPOGRAPHY
   ============================================ */
.heading h3 {
    font-size: 3rem;
    font-weight: 700;
    color: var(--interior-charcoal);
    text-transform: uppercase;
    letter-spacing: 8px;
    position: relative;
    display: inline-block;
    margin-bottom: 40px;
    font-family: 'Playfair Display', serif;
}

.heading h3::before {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--interior-gold), transparent);
    animation: underlineGrow 2s ease-in-out infinite;
}

@keyframes underlineGrow {
    0%, 100% { width: 120px; opacity: 0.6; }
    50% { width: 180px; opacity: 1; }
}

.heading h3::after {
    content: '✦';
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    color: var(--interior-gold);
    font-size: 12px;
    animation: ornamentSpin 4s linear infinite;
}

@keyframes ornamentSpin {
    0% { transform: translateX(-50%) rotate(0deg); }
    100% { transform: translateX(-50%) rotate(360deg); }
}

/* ============================================
   ROOM CARDS - INTERIOR DESIGN INSPIRED
   ============================================ */
.room-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    margin-top: 40px;
}

.card {
    position: relative;
    background: linear-gradient(145deg, #ffffff 0%, #f9f7f4 100%);
    border: 2px solid rgba(201, 169, 98, 0.2);
    border-radius: 16px;
    padding: 25px !important;
    box-shadow: var(--shadow-soft);
    transition: all 0.5s cubic-bezier(0.22, 0.61, 0.36, 1);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    overflow: hidden;
}

/* Material Texture Overlay */
.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, 
        var(--interior-sage),
        var(--interior-gold),
        var(--interior-terracotta),
        var(--interior-navy)
    );
    background-size: 300% 100%;
    animation: materialFlow 8s linear infinite;
    opacity: 0;
    transition: opacity 0.5s;
}

.card:hover::before {
    opacity: 1;
}

@keyframes materialFlow {
    0% { background-position: 0% 50%; }
    100% { background-position: 300% 50%; }
}

/* Elegant Staggered Reveal */
.card {
    opacity: 0;
    animation: roomCardReveal 0.8s cubic-bezier(0.22, 0.61, 0.36, 1) forwards;
}

.card:nth-child(1) { animation-delay: 0.1s; }
.card:nth-child(2) { animation-delay: 0.2s; }
.card:nth-child(3) { animation-delay: 0.3s; }
.card:nth-child(4) { animation-delay: 0.4s; }
.card:nth-child(5) { animation-delay: 0.5s; }
.card:nth-child(6) { animation-delay: 0.6s; }
.card:nth-child(7) { animation-delay: 0.7s; }
.card:nth-child(8) { animation-delay: 0.8s; }

@keyframes roomCardReveal {
    0% {
        opacity: 0;
        transform: translateY(40px);
        filter: blur(8px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
        filter: blur(0);
    }
}

/* Sophisticated Hover Effect */
.card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: var(--shadow-hover);
    border-color: var(--interior-gold);
    background: linear-gradient(145deg, #ffffff 0%, #faf8f5 100%);
}

/* Selected State with Design Elegance */
.card.selected {
    background: linear-gradient(145deg, 
        rgba(201, 169, 98, 0.15) 0%, 
        rgba(139, 157, 131, 0.1) 100%
    );
    border: 3px solid var(--interior-gold);
    box-shadow: 
        var(--shadow-hover),
        0 0 30px rgba(201, 169, 98, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
}

.card.selected::after {
    content: '✓ SELECTED';
    position: absolute;
    top: 15px;
    right: 15px;
    background: var(--interior-gold);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(201, 169, 98, 0.4);
    animation: badgePop 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

@keyframes badgePop {
    0% { transform: scale(0) rotate(-180deg); opacity: 0; }
    100% { transform: scale(1) rotate(0deg); opacity: 1; }
}

/* ============================================
   ROOM ICON SYSTEM
   ============================================ */
.room-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--interior-sage), var(--interior-navy));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    box-shadow: 0 8px 20px rgba(44, 62, 80, 0.15);
    transition: all 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
    position: relative;
    overflow: hidden;
}

.room-icon::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3), transparent 60%);
    animation: iconShine 3s linear infinite;
}

@keyframes iconShine {
    0% { transform: translate(-100%, -100%); }
    100% { transform: translate(100%, 100%); }
}

.card:hover .room-icon {
    transform: rotate(360deg) scale(1.1);
    box-shadow: 0 12px 30px rgba(44, 62, 80, 0.25);
}

.card.selected .room-icon {
    background: linear-gradient(135deg, var(--interior-gold), var(--interior-terracotta));
}

/* ============================================
   DESIGNER CHECKBOX
   ============================================ */
input[type="checkbox"] {
    appearance: none;
    width: 28px;
    height: 28px;
    border: 3px solid var(--interior-gold);
    border-radius: 6px;
    background: white;
    cursor: pointer;
    position: relative;
    transition: all 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.1);
}

input[type="checkbox"]::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-left: 0px solid transparent;
    border-bottom: 0px solid transparent;
    border-top: 3px solid white;
    border-right: 3px solid white;
    transform: translate(-50%, -60%) rotate(45deg);
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

input[type="checkbox"]:checked {
    background: linear-gradient(135deg, var(--interior-gold), var(--interior-terracotta));
    border-color: var(--interior-gold);
    transform: scale(1.15);
    box-shadow: 0 6px 20px rgba(201, 169, 98, 0.4);
}

input[type="checkbox"]:checked::before {
    width: 6px;
    height: 12px;
    border-left: 0;
    border-top: 0;
    border-right: 3px solid white;
    border-bottom: 3px solid white;
    transform: translate(-50%, -60%) rotate(45deg);
}

input[type="checkbox"]:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 20px rgba(201, 169, 98, 0.3);
}

/* ============================================
   ELEGANT QUANTITY CONTROLS
   ============================================ */
.quantity-controls {
    display: flex;
    align-items: center;
    gap: 15px;
    background: rgba(245, 241, 232, 0.5);
    padding: 8px 15px;
    border-radius: 30px;
    border: 1px solid rgba(201, 169, 98, 0.2);
}

.quantity-btn {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: 2px solid var(--interior-gold);
    background: white;
    color: var(--interior-charcoal);
    font-size: 20px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.22, 0.61, 0.36, 1);
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.08);
}

.quantity-btn:hover {
    background: linear-gradient(135deg, var(--interior-gold), var(--interior-terracotta));
    color: white;
    transform: scale(1.15) rotate(90deg);
    box-shadow: 0 8px 20px rgba(201, 169, 98, 0.3);
}

.quantity-btn:active {
    transform: scale(1.05) rotate(45deg);
}

.quantity {
    font-size: 20px;
    font-weight: 800;
    color: var(--interior-charcoal);
    min-width: 35px;
    text-align: center;
    font-family: 'Lora', serif;
    transition: all 0.3s cubic-bezier(0.22, 0.61, 0.36, 1);
}

.quantity.updated {
    animation: quantityElegantBounce 0.6s cubic-bezier(0.22, 0.61, 0.36, 1);
}

@keyframes quantityElegantBounce {
    0%, 100% { 
        transform: scale(1);
        color: var(--interior-charcoal);
    }
    25% { 
        transform: scale(1.4) translateY(-5px);
        color: var(--interior-gold);
    }
    50% { 
        transform: scale(1.6) translateY(-8px);
        color: var(--interior-terracotta);
    }
    75% { 
        transform: scale(1.3) translateY(-3px);
        color: var(--interior-sage);
    }
}

/* ============================================
   ROOM TITLE - INTERIOR DESIGN TYPOGRAPHY
   ============================================ */
.card-title {
    font-size: 18px !important;
    font-weight: 600;
    color: var(--interior-charcoal);
    text-align: center;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin: 0;
    font-family: 'Lora', serif;
    transition: all 0.3s;
}

.card:hover .card-title {
    color: var(--interior-gold);
    letter-spacing: 3px;
}

.card.selected .card-title {
    color: var(--interior-gold);
    font-weight: 700;
}

/* ============================================
   DESIGNER CALL-TO-ACTION BUTTON
   ============================================ */
.btn-primary {
    position: relative;
    background: linear-gradient(135deg, var(--interior-charcoal), var(--interior-navy));
    border: 3px solid var(--interior-gold);
    padding: 20px 70px;
    font-size: 18px;
    font-weight: 800;
    border-radius: 50px;
    color: white;
    letter-spacing: 4px;
    text-transform: uppercase;
    cursor: pointer;
    overflow: hidden;
    box-shadow: 
        0 15px 40px rgba(44, 62, 80, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    transition: all 0.5s cubic-bezier(0.22, 0.61, 0.36, 1);
    font-family: 'Playfair Display', serif;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(201, 169, 98, 0.4), transparent 70%);
    transform: translate(-50%, -50%);
    transition: width 0.8s, height 0.8s;
    border-radius: 50%;
}

.btn-primary:hover::before {
    width: 600px;
    height: 600px;
}

.btn-primary:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 
        0 25px 60px rgba(44, 62, 80, 0.4),
        0 0 40px rgba(201, 169, 98, 0.5);
    border-color: var(--interior-gold);
    letter-spacing: 6px;
}

.btn-primary:active {
    transform: translateY(-4px) scale(1.02);
}

/* Blueprint Arrow Icon */
.btn-primary::after {
    content: '→';
    position: absolute;
    right: 30px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 24px;
    transition: all 0.3s;
}

.btn-primary:hover::after {
    right: 20px;
    animation: arrowSlide 1s ease-in-out infinite;
}

@keyframes arrowSlide {
    0%, 100% { transform: translateY(-50%) translateX(0); }
    50% { transform: translateY(-50%) translateX(10px); }
}

/* ============================================
   PAGE BANNER - ARCHITECTURAL STYLE
   ============================================ */
.page-banner {
    background: linear-gradient(135deg, var(--interior-charcoal), var(--interior-navy));
    position: relative;
    overflow: hidden;
    border-bottom: 5px solid var(--interior-gold);
}

.page-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255, 255, 255, 0.03) 35px, rgba(255, 255, 255, 0.03) 70px);
    animation: blueprintSlide 30s linear infinite;
}

@keyframes blueprintSlide {
    0% { background-position: 0 0; }
    100% { background-position: 100px 100px; }
}

.page-banner h1 {
    color: white;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    font-weight: 800;
    letter-spacing: 6px;
    position: relative;
    z-index: 1;
    font-family: 'Playfair Display', serif;
}

/* ============================================
   RESPONSIVE DESIGN - MOBILE LUXURY
   ============================================ */
@media (max-width: 768px) {
    .container {
        padding: 35px 20px !important;
        border-radius: 15px;
    }
    
    .heading h3 {
        font-size: 2rem;
        letter-spacing: 4px;
    }
    
    .room-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .card {
        padding: 20px !important;
        flex-direction: row;
        justify-content: space-between;
    }
    
    .room-icon {
        width: 60px;
        height: 60px;
        font-size: 28px;
    }
    
    .card-title {
        font-size: 15px !important;
        flex: 1;
        margin: 0 15px;
    }
    
    .quantity-controls {
        gap: 10px;
        padding: 6px 12px;
    }
    
    .quantity-btn {
        width: 34px;
        height: 34px;
        font-size: 18px;
    }
    
    .quantity {
        font-size: 18px;
        min-width: 28px;
    }
    
    .btn-primary {
        padding: 16px 45px;
        font-size: 16px;
        letter-spacing: 3px;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 25px 15px !important;
    }
    
    .heading h3 {
        font-size: 1.6rem;
        letter-spacing: 3px;
    }
    
    .card {
        padding: 15px !important;
    }
    
    .room-icon {
        width: 50px;
        height: 50px;
        font-size: 24px;
    }
    
    .card-title {
        font-size: 13px !important;
        letter-spacing: 1.5px;
    }
    
    .quantity-btn {
        width: 32px;
        height: 32px;
        font-size: 16px;
    }
}

/* ============================================
   SMOOTH PERFORMANCE
   ============================================ */
.card, .quantity-btn, .room-icon, input[type="checkbox"], .btn-primary {
    will-change: transform;
    backface-visibility: hidden;
    -webkit-font-smoothing: antialiased;
}

</style>

<!-- Floating Design Elements -->
<div class="design-element ruler" style="top: 20%; left: 0;"></div>
<div class="design-element ruler" style="top: 60%; right: 0;"></div>

<!-- Google Fonts for Luxury Typography -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800;900&family=Lora:wght@500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- PHP Login Logic -->
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_login = $row['banner_login'];
}

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

<div class="page-banner">
    <div class="inner">
       <h1>Get Estimate</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">
                    <div class="heading text-center">
                        <h3>Select Your Rooms</h3>
                        <p style="color: var(--interior-charcoal); font-size: 16px; margin-top: 30px; font-family: 'Lora', serif; letter-spacing: 1px;">
                            Choose the spaces you'd like to transform
                        </p>
                        <div style="margin-top: 30px;">
                            <a href="selectpackage.php" target="_blank" style="text-decoration: none; color: var(--interior-gold); font-size: 16px; font-weight: 600; letter-spacing: 2px; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; border-bottom: 2px solid var(--interior-gold); padding-bottom: 5px;">
                                <i class="fas fa-drafting-compass"></i>
                                FLOOR PLAN ESTIMATION
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <?php
                    $statement = $pdo->prepare("SELECT room_name, economy_price, premium_price, luxury_price, room_price FROM tbl_rooms");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    
                    // Room icon mapping
                    $roomIcons = [
                        'Living Room' => '🛋️',
                        'Bedroom' => '🛏️',
                        'Kitchen' => '🍳',
                        'Bathroom' => '🚿',
                        'Dining Room' => '🍽️',
                        'Office' => '💼',
                        'Kids Room' => '🧸',
                        'Master Bedroom' => '👑',
                        'Guest Room' => '🚪',
                        'Study' => '📚',
                        'Balcony' => '🌿',
                        'default' => '🏠'
                    ];
                    ?>

                    <form method="post" action="prices.php" id="estimateForm">
                        <div class="room-grid">
                            <?php
                            foreach ($result as $row) {
                                $roomName = $row['room_name'];
                                $icon = isset($roomIcons[$roomName]) ? $roomIcons[$roomName] : $roomIcons['default'];
                                ?>
                                <div class="card" data-room="<?php echo $roomName; ?>">
                                    <input type="checkbox" name="select_room[]" value="<?php echo $roomName; ?>" 
                                        data-economy-price="<?php echo $row['economy_price']; ?>" 
                                        data-premium-price="<?php echo $row['premium_price']; ?>" 
                                        data-luxury-price="<?php echo $row['luxury_price']; ?>" 
                                        data-room-price="<?php echo $row['room_price']; ?>" 
                                        onchange="handleCardSelection(this)">

                                    <div class="room-icon"><?php echo $icon; ?></div>

                                    <h5 class="card-title"><?php echo $roomName; ?></h5>

                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn" onclick="changeQuantity(this, -1, <?php echo $row['economy_price']; ?>, <?php echo $row['premium_price']; ?>, <?php echo $row['luxury_price']; ?>, <?php echo $row['room_price']; ?>)" title="Decrease">−</button>
                                        <span class="quantity">1</span>
                                        <button type="button" class="quantity-btn" onclick="changeQuantity(this, 1, <?php echo $row['economy_price']; ?>, <?php echo $row['premium_price']; ?>, <?php echo $row['luxury_price']; ?>, <?php echo $row['room_price']; ?>)" title="Increase">+</button>
                                        <input type="hidden" name="quantities[<?php echo $roomName; ?>]" class="room-quantity" value="1">
                                    </div>

                                    <div style="display: none;">
                                        <span class="economy-price"><?php echo $row['economy_price']; ?></span>
                                        <span class="premium-price"><?php echo $row['premium_price']; ?></span>
                                        <span class="luxury-price"><?php echo $row['luxury_price']; ?></span>
                                        <span class="room-price"><?php echo $row['room_price']; ?></span>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="text-center" style="margin-top: 60px;">
                            <button type="submit" class="btn-primary">CONTINUE</button>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced Quantity Management with Visual Feedback
function changeQuantity(button, change, economyPrice, premiumPrice, luxuryPrice, roomPrice) {
    const quantitySpan = button.parentElement.querySelector('.quantity');
    const hiddenInput = button.parentElement.querySelector('.room-quantity');
    const card = button.closest('.card');
    let currentQuantity = parseInt(quantitySpan.textContent);
    
    currentQuantity += change;
    if (currentQuantity < 1) currentQuantity = 1;
    if (currentQuantity > 50) currentQuantity = 50; // Reasonable limit
    
    quantitySpan.textContent = currentQuantity;
    hiddenInput.value = currentQuantity;
    
    // Elegant animation
    quantitySpan.classList.add('updated');
    setTimeout(() => quantitySpan.classList.remove('updated'), 600);
    
    // Update hidden prices
    const economySpan = card.querySelector('.economy-price');
    const premiumSpan = card.querySelector('.premium-price');
    const luxurySpan = card.querySelector('.luxury-price');
    const roomSpan = card.querySelector('.room-price');
    
    if (economySpan) economySpan.textContent = (economyPrice * currentQuantity).toFixed(2);
    if (premiumSpan) premiumSpan.textContent = (premiumPrice * currentQuantity).toFixed(2);
    if (luxurySpan) luxurySpan.textContent = (luxuryPrice * currentQuantity).toFixed(2);
    if (roomSpan) roomSpan.textContent = (roomPrice * currentQuantity).toFixed(2);
    
    // Subtle haptic feedback
    if (navigator.vibrate) navigator.vibrate(20);
}

// Card Selection Handler with Visual State
function handleCardSelection(checkbox) {
    const card = checkbox.closest('.card');
    
    if (checkbox.checked) {
        card.classList.add('selected');
        
        // Smooth animation on selection
        card.style.transform = 'scale(1.05)';
        setTimeout(() => {
            card.style.transform = '';
        }, 300);
        
        if (navigator.vibrate) navigator.vibrate([30, 20, 30]);
    } else {
        card.classList.remove('selected');
    }
}

// Form Validation & Submission
document.getElementById('estimateForm').addEventListener('submit', function(e) {
    const checkboxes = this.querySelectorAll('input[type="checkbox"]:checked');
    
    if (checkboxes.length === 0) {
        e.preventDefault();
        alert('Please select at least one room to continue.');
        return false;
    }
    
    const submitBtn = this.querySelector('.btn-primary');
    if (submitBtn.disabled) {
        e.preventDefault();
        return false;
    }
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = 'PROCESSING <i class="fas fa-spinner fa-spin"></i>';
    
    setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'CONTINUE →';
    }, 3000);
});

// Smooth Scroll Reveal
if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.card').forEach(card => {
        observer.observe(card);
    });
}

// Add smooth page entrance
window.addEventListener('load', () => {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.5s ease-in-out';
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
});
</script>

<?php require_once('footer.php'); ?>
