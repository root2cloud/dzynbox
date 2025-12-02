<?php require_once('header.php'); ?>

<style>
/* ================================================================
   🎨 REFER-A-FRIEND PAGE - SIDE-BY-SIDE LAYOUT
   ================================================================ */

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
}

:root {
    --primary: #6366f1;
    --secondary: #ec4899;
    --accent: #f59e0b;
    --dark: #0f172a;
    --light: #f8fafc;
}

/* ============ CINEMATIC HERO WITH PARTICLES - REMOVED BG ============ */
.cinematic-hero {
    min-height: 5vh;
    background: transparent;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Animated Gradient Orbs - HIDDEN */
.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0;
    animation: float 20s ease-in-out infinite;
    display: none;
}

.orb-1 {
    width: 500px;
    height: 500px;
    background: linear-gradient(45deg, #667eea, #764ba2);
    top: -10%;
    left: -10%;
    animation-delay: 0s;
}

.orb-2 {
    width: 400px;
    height: 400px;
    background: linear-gradient(45deg, #f093fb, #f5576c);
    bottom: -10%;
    right: -10%;
    animation-delay: 5s;
}

.orb-3 {
    width: 350px;
    height: 350px;
    background: linear-gradient(45deg, #4facfe, #00f2fe);
    top: 50%;
    left: 50%;
    animation-delay: 10s;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(100px, -100px) rotate(90deg); }
    50% { transform: translate(50px, 100px) rotate(180deg); }
    75% { transform: translate(-100px, 50px) rotate(270deg); }
}

/* Floating Particles - HIDDEN */
.particles {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
    display: none;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(255,255,255,0.8);
    border-radius: 50%;
    animation: rise 15s linear infinite;
}

@keyframes rise {
    0% {
        transform: translateY(100vh) scale(0);
        opacity: 0;
    }
    50% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100vh) scale(1);
        opacity: 0;
    }
}

/* Hero Content with Glassmorphism */
.hero-container {
    position: relative;
    z-index: 10;
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 20px;
    text-align: center;
}

.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border-radius: 30px;
    padding: 40px 30px;
    border: 2px solid rgba(102, 126, 234, 0.4);
    box-shadow: 
        0 20px 60px rgba(0,0,0,0.1),
        inset 0 1px 1px rgba(255,255,255,0.3);
    animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(60px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-badge {
    display: inline-block;
    backdrop-filter: blur(10px);
    padding: 12px 30px;
    border-radius: 50px;
    color: #667eea;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 30px;
    border: 2px solid #667eea;
    animation: pulse-glow 2s ease-in-out infinite;
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 20px rgba(102, 126, 234, 0.3); }
    50% { box-shadow: 0 0 40px rgba(102, 126, 234, 0.5); }
}

.hero-title {
    font-size: 42px;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: 25px;
    line-height: 1.1;
    text-shadow: none;
    animation: slideIn 1.2s cubic-bezier(0.68, -0.55, 0.27, 1.55);
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.hero-title .gradient-text {
    background: linear-gradient(135deg, #ffd700, #ffed4e, #ffa500);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shimmer 3s linear infinite;
    background-size: 200% 200%;
}

@keyframes shimmer {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.hero-subtitle {
    font-size: 16px;
    color: #4a5568;
    margin-bottom: 50px;
    font-weight: 400;
    line-height: 1.7;
    animation: fadeIn 1.5s ease-out 0.3s backwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* 3D Reward Box */
.reward-box-3d {
    perspective: 1000px;
    margin: 50px auto 0;
    display: inline-block;
}

.reward-inner {
    background: linear-gradient(135deg, #ffd700 0%, #ff8c00 100%);
    padding: 30px 40px;
    border-radius: 30px;
    transform-style: preserve-3d;
    transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    box-shadow: 
        0 30px 80px rgba(255,140,0,0.5),
        inset 0 -10px 30px rgba(0,0,0,0.2);
    position: relative;
    overflow: hidden;
}

.reward-box-3d:hover .reward-inner {
    transform: rotateX(10deg) rotateY(-10deg) scale(1.05);
    box-shadow: 0 50px 100px rgba(255,140,0,0.6);
}

.reward-inner::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
    transform: rotate(45deg);
    animation: shine 4s infinite;
}

@keyframes shine {
    0% { transform: translateX(-100%) rotate(45deg); }
    100% { transform: translateX(100%) rotate(45deg); }
}

.reward-amount {
    font-size: 38px;
    font-weight: 900;
    color: #1a1a1a;
    text-shadow: 3px 3px 0 rgba(255,255,255,0.3);
    animation: count-up 2s ease-out;
}

@keyframes count-up {
    from {
        opacity: 0;
        transform: scale(0.5);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* ============ FLOATING FEATURES SECTION - WHITE BG ============ */
.features-space {
    padding: 60px 20px;
    background: #ffffff;
    position: relative;
    overflow: hidden;
}

.features-space::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    top: 0;
    left: 0;
    background: linear-gradient(90deg, transparent, #6366f1, transparent);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 50px;
    max-width: 1300px;
    margin: 0 auto;
}

.feature-pod {
    background: rgba(99, 102, 241, 0.05);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(102, 126, 234, 0.4);
    border-radius: 25px;
    padding: 50px 40px;
    transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    position: relative;
    overflow: hidden;
    animation: float-in 0.8s ease-out backwards;
}

.feature-pod:nth-child(1) { animation-delay: 0.1s; }
.feature-pod:nth-child(2) { animation-delay: 0.2s; }
.feature-pod:nth-child(3) { animation-delay: 0.3s; }

@keyframes float-in {
    from {
        opacity: 0;
        transform: translateY(100px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.feature-pod::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(99,102,241,0.2), transparent);
    transition: left 0.7s;
}

.feature-pod:hover::before {
    left: 100%;
}

.feature-pod:hover {
    transform: translateY(-20px) scale(1.03);
    border-color: rgba(102,126,234,0.6);
    box-shadow: 
        0 30px 80px rgba(99,102,241,0.3),
        inset 0 1px 1px rgba(255,255,255,0.2);
}

.feature-icon-3d {
    width: 80px;
    height: 80px;
    margin: 0 auto 35px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    transform-style: preserve-3d;
    transition: all 0.5s;
    box-shadow: 0 20px 50px rgba(102,126,234,0.4);
}

.feature-pod:hover .feature-icon-3d {
    transform: rotateY(180deg) rotateX(15deg);
}

.feature-pod h3 {
    font-size: 20px;
    color: #0f172a;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
}

.feature-pod p {
    font-size: 15px;
    color: #4a5568;
    line-height: 1.8;
    text-align: center;
}

/* ============ 🔥 SIDE-BY-SIDE SECTION - WHITE BG 🔥 ============ */
.side-by-side-wrapper {
    padding: 80px 20px;
    background: #ffffff;
    position: relative;
    overflow: hidden;
}

.side-by-side-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
}

/* ========== LEFT SIDE: HOW IT WORKS ========== */
.timeline-side {
    position: relative;
}

.section-title {
    text-align: center;
    font-size: 32px;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: 60px;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 10px;
}

.timeline-flow {
    position: relative;
}

.timeline-step {
    display: flex;
    align-items: flex-start;
    gap: 25px;
    margin-bottom: 40px;
    opacity: 0;
    transform: translateX(-50px);
    animation: slide-in-right 0.8s ease-out forwards;
}

.timeline-step:nth-child(1) { animation-delay: 0.2s; }
.timeline-step:nth-child(2) { animation-delay: 0.4s; }
.timeline-step:nth-child(3) { animation-delay: 0.6s; }

@keyframes slide-in-right {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.step-number-circle {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    font-weight: 900;
    box-shadow: 0 10px 30px rgba(102,126,234,0.5);
}

.step-content-box {
    flex: 1;
    background: rgba(99, 102, 241, 0.05);
    backdrop-filter: blur(10px);
    padding: 25px;
    border-radius: 20px;
    border: 2px solid rgba(102, 126, 234, 0.4);
    transition: all 0.4s;
}

.step-content-box:hover {
    transform: translateX(10px);
    background: rgba(99, 102, 241, 0.08);
    border-color: rgba(102,126,234,0.6);
    box-shadow: 0 10px 40px rgba(102,126,234,0.3);
}

.step-content-box h4 {
    font-size: 18px;
    color: #0f172a;
    font-weight: 700;
    margin-bottom: 12px;
}

.step-content-box p {
    font-size: 14px;
    color: #4a5568;
    line-height: 1.7;
}

/* ========== RIGHT SIDE: FORM - LIGHT PURPLE BORDER ========== */
.form-side {
    position: relative;
}

.form-container-deluxe {
    background: #ffffff;
    backdrop-filter: blur(20px);
    padding: 40px 35px;
    border-radius: 30px;
    border: 2px solid rgba(102, 126, 234, 0.4);
    box-shadow: 0 30px 90px rgba(0,0,0,0.1);
    position: sticky;
    top: 20px;
}

.form-header {
    text-align: center;
    margin-bottom: 35px;
}

.form-header h2 {
    font-size: 28px;
    color: #0f172a;
    font-weight: 900;
    margin-bottom: 10px;
}

.form-header p {
    font-size: 14px;
    color: #4a5568;
}

/* ✅ INLINE LABEL+INPUT LAYOUT */
.input-group {
    margin-bottom: 18px;
    position: relative;
    display: grid;
    grid-template-columns: 0.5fr 1fr;
    gap: 12px;
    align-items: center;
}

.input-group label {
    color: #0f172a;
    font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: all 0.3s;
}

.input-field {
    width: 100%;
    padding: 10px 14px;
    background: #f8fafc;
    border: 2px solid rgba(102, 126, 234, 0.3);
    border-radius: 11px;
    color: #0f172a;
    font-size: 13px;
    font-family: inherit;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

.input-field::placeholder {
    color: #94a3b8;
}

.input-field:focus {
    outline: none;
    background: #ffffff;
    border: 2px solid rgba(102, 126, 234, 0.6);
    box-shadow: 0 0 0 4px rgba(102,126,234,0.15);
    transform: translateY(-2px);
}

.input-group:has(.input-field:focus) label {
    color: #667eea;
}

/* ✅ FULL-WIDTH FOR DIVIDER */
.divider-fancy {    
    display: flex;
    align-items: center;
    gap: 20px;
    margin: 25px 0 18px;
    grid-column: 1 / -1;
}

.divider-fancy span {
    color: #94a3b8;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    white-space: nowrap;
}

.divider-fancy::before,
.divider-fancy::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(102,126,234,0.3), transparent);
}

/* ✅ FULL-WIDTH FOR TEXTAREA & BUTTON */
.input-group.full-width {
    grid-column: 1 / -1;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.input-group.full-width label {
    white-space: normal;
}

.submit-button-epic {
    width: 100%;
    padding: 13px 32px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    cursor: pointer;
    transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    box-shadow: 0 20px 50px rgba(102,126,234,0.5);
    position: relative;
    overflow: hidden;
    margin-top: 5px;
}

.submit-button-epic::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.submit-button-epic:hover::before {
    width: 400px;
    height: 400px;
}

.submit-button-epic:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 30px 70px rgba(102,126,234,0.7);
}

/* ============ RESPONSIVE ============ */
@media (max-width: 1024px) {
    .side-by-side-container {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    
    .form-container-deluxe {
        position: static;
    }
}

@media (max-width: 768px) {
    .hero-title { font-size: 28px; }
    .hero-subtitle { font-size: 14px; }
    .reward-amount { font-size: 28px; }
    .section-title { font-size: 24px; }
    .features-grid { grid-template-columns: 1fr; }
    .step-number-circle {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .feature-icon-3d {
        width: 60px;
        height: 60px;
        font-size: 28px;
    }
    .side-by-side-wrapper {
        padding: 40px 15px;
    }
    .form-container-deluxe {
        padding: 30px 20px;
    }
    
    .input-group {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
$particles = '';
for($i = 1; $i <= 50; $i++) {
    $left = rand(0, 100);
    $delay = rand(0, 15);
    $duration = rand(10, 20);
    $particles .= "
    <style>
    .particle-{$i} {
        left: {$left}%;
        animation-delay: {$delay}s;
        animation-duration: {$duration}s;
    }
    </style>";
}
echo $particles;
?>

<!-- ========== CINEMATIC HERO ========== -->
<div class="cinematic-hero">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    
    <div class="particles">
        <?php for($i = 1; $i <= 50; $i++): ?>
        <div class="particle particle-<?php echo $i; ?>"></div>
        <?php endfor; ?>
    </div>
    
    <div class="hero-container">
        <div class="glass-card">
            <div class="hero-badge">✨ Exclusive Rewards Program</div>
            
            <h1 class="hero-title">
                Share the Love,<br>
                <span class="gradient-text">Earn Incredible Rewards</span>
            </h1>
            
            <p class="hero-subtitle">
                Transform your network into a stream of rewards! Refer friends to our premium interior design services and unlock unbeatable benefits.
            </p>
            
            <div class="reward-box-3d">
                <div class="reward-inner">
                    <div style="color: rgba(0,0,0,0.7); font-size: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;">Earn Up To</div>
                    <div class="reward-amount">₹25,000</div>
                    <div style="color: rgba(0,0,0,0.8); font-size: 16px; font-weight: 600; margin-top: 15px;">Cash • Vouchers • Discounts</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== FLOATING FEATURES ========== -->
<div class="features-space">
    <h2 class="section-title" style="margin-bottom: 100px;">Why Our Program is Unbeatable</h2>
    
    <div class="features-grid">
        <div class="feature-pod">
            <div class="feature-icon-3d">💎</div>
            <h3>Premium Rewards</h3>
            <p>Receive up to ₹25,000 in cash, luxury vouchers, or exclusive project discounts. Your choice, your reward!</p>
        </div>
        
        <div class="feature-pod">
            <div class="feature-icon-3d">⚡</div>
            <h3>Lightning Fast</h3>
            <p>Rewards processed instantly upon project confirmation. No bureaucracy, no delays—just pure efficiency.</p>
        </div>
        
        <div class="feature-pod">
            <div class="feature-icon-3d">♾</div>
            <h3>Unlimited Potential</h3>
            <p>No caps, no limits. Refer 10, 20, or 100 friends—your earning potential is truly unlimited.</p>
        </div>
    </div>
</div>

<!-- ========== 🔥 SIDE-BY-SIDE: TIMELINE + FORM 🔥 ========== -->
<div class="side-by-side-wrapper">
    <div class="side-by-side-container">
        
        <!-- LEFT: HOW REFERRAL WORKS -->
        <div class="timeline-side">
            <h2 class="section-title">How Referral Works</h2>
            
            <div class="timeline-flow">
                <div class="timeline-step">
                    <div class="step-number-circle">1</div>
                    <div class="step-content-box">
                        <h4>Share Referral Details</h4>
                        <p>Simply fill out our elegant form with your friend's contact information and their interior design aspirations.</p>
                    </div>
                </div>
                
                <div class="timeline-step">
                    <div class="step-number-circle">2</div>
                    <div class="step-content-box">
                        <h4>We Connect & Consult</h4>
                        <p>Our expert design team reaches out within 24 hours to provide a personalized, no-obligation consultation.</p>
                    </div>
                </div>
                
                <div class="timeline-step">
                    <div class="step-number-circle">3</div>
                    <div class="step-content-box">
                        <h4>Claim Your Reward</h4>
                        <p>Once your referral confirms their project, you receive your choice of reward immediately—guaranteed!</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- RIGHT: FORM -->
        <div class="form-side">
            <div class="form-container-deluxe">
                <div class="form-header">
                    <h2>Submit Your Referral</h2>
                    <p>Transform a friend's space & earn rewards</p>
                </div>
                
                <form action="process-referral.php" method="POST">
                    <!-- Your Info - SIDE BY SIDE -->
                    <div class="input-group">
                        <label>Your Name *</label>
                        <input type="text" name="your_name" class="input-field" required placeholder="John Doe">
                    </div>
                    
                    <div class="input-group">
                        <label>Your Email *</label>
                        <input type="email" name="your_email" class="input-field" required placeholder="you@example.com">
                    </div>
                    
                    <div class="input-group">
                        <label>Your Phone *</label>
                        <input type="tel" name="your_phone" class="input-field" required placeholder="+91 98765">
                    </div>
                    
                    <div class="divider-fancy">
                        <span>Referral Info</span>
                    </div>
                    
                    <!-- Referral Info - SIDE BY SIDE -->
                    <div class="input-group">
                        <label>Ref. Name *</label>
                        <input type="text" name="referral_name" class="input-field" required placeholder="Jane Smith">
                    </div>
                    
                    <div class="input-group">
                        <label>Ref. Email</label>
                        <input type="email" name="referral_email" class="input-field" placeholder="friend@example.com">
                    </div>
                    
                    <div class="input-group">
                        <label>Ref. Phone *</label>
                        <input type="tel" name="referral_phone" class="input-field" required placeholder="+91 98765">
                    </div>
                    
                    <!-- Full Width Textarea -->
                    <div class="input-group full-width">
                        <label>Details</label>
                        <textarea name="message" class="input-field" rows="2" placeholder="Design dreams..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-button-epic">Submit Now</button>
                </form>
            </div>
        </div>
        
    </div>
</div>  

<?php require_once('footer.php'); ?>
