<?php require_once('header.php'); ?>

<style>
/* ================================================================
   🎨 MARVELOUS REFER-A-FRIEND PAGE - WORLD-CLASS DESIGN
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

/* ============ CINEMATIC HERO WITH PARTICLES ============ */
.cinematic-hero {
    min-height: 5vh;
    /* background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); */
    background: linear-gradient(135deg, #667eea 0%, #2a2051ff 50%, #0e033cff 100%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Animated Gradient Orbs */
.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.6;
    animation: float 20s ease-in-out infinite;
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

/* Floating Particles */
.particles {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
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
    padding: 0 20px;
    text-align: center;
}

.glass-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border-radius: 30px;
    padding: 80px 60px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 
        0 20px 60px rgba(0,0,0,0.3),
        inset 0 1px 1px rgba(255,255,255,0.5);
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
    /* background: linear-gradient(135deg, rgba(255,255,255,0.3), rgba(255,255,255,0.1)); */
    backdrop-filter: blur(10px);
    padding: 12px 30px;
    border-radius: 50px;
    color: white;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 30px;
    border: 2px solid rgba(255,255,255,0.3);
    animation: pulse-glow 2s ease-in-out infinite;
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 20px rgba(255,255,255,0.5); }
    50% { box-shadow: 0 0 40px rgba(255,255,255,0.8); }
}

.hero-title {
    font-size: 72px;
    font-weight: 900;
    color: white;
    margin-bottom: 25px;
    line-height: 1.1;
    text-shadow: 0 10px 30px rgba(0,0,0,0.3);
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
    font-size: 24px;
    color: rgba(255,255,255,0.95);
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
    padding: 50px 70px;
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
    font-size: 68px;
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

/* ============ FLOATING FEATURES SECTION ============ */
.features-space {
    padding: 150px 20px;
    background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
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
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
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
    border-color: rgba(99,102,241,0.5);
    box-shadow: 
        0 30px 80px rgba(99,102,241,0.3),
        inset 0 1px 1px rgba(255,255,255,0.2);
}

.feature-icon-3d {
    width: 120px;
    height: 120px;
    margin: 0 auto 35px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 56px;
    transform-style: preserve-3d;
    transition: all 0.5s;
    box-shadow: 0 20px 50px rgba(102,126,234,0.4);
}

.feature-pod:hover .feature-icon-3d {
    transform: rotateY(180deg) rotateX(15deg);
}

.feature-pod h3 {
    font-size: 28px;
    color: white;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
}

.feature-pod p {
    font-size: 17px;
    color: rgba(255,255,255,0.8);
    line-height: 1.8;
    text-align: center;
}

/* ============ ANIMATED TIMELINE ============ */
.timeline-section {
    padding: 150px 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    position: relative;
}

.section-title {
    text-align: center;
    font-size: 58px;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: 80px;
    position: relative;
    display: inline-block;
    left: 50%;
    transform: translateX(-50%);
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 6px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 10px;
}

.timeline-flow {
    max-width: 1100px;
    margin: 0 auto;
    position: relative;
}

.timeline-step {
    display: flex;
    align-items: center;
    gap: 60px;
    margin-bottom: 100px;
    opacity: 0;
    transform: translateX(-100px);
    animation: slide-in-right 0.8s ease-out forwards;
}

.timeline-step:nth-child(even) {
    flex-direction: row-reverse;
    transform: translateX(100px);
    animation-name: slide-in-left;
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

@keyframes slide-in-left {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.step-number-circle {
    flex-shrink: 0;
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 42px;
    font-weight: 900;
    box-shadow: 0 20px 50px rgba(102,126,234,0.5);
    position: relative;
    animation: rotate-pulse 3s ease-in-out infinite;
}

@keyframes rotate-pulse {
    0%, 100% { transform: rotate(0deg) scale(1); }
    50% { transform: rotate(360deg) scale(1.1); }
}

.step-content-box {
    flex: 1;
    background: white;
    padding: 45px 50px;
    border-radius: 25px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    transition: all 0.4s;
    border-left: 5px solid #667eea;
}

.step-content-box:hover {
    transform: scale(1.05);
    box-shadow: 0 30px 80px rgba(102,126,234,0.25);
}

.step-content-box h4 {
    font-size: 26px;
    color: #0f172a;
    font-weight: 700;
    margin-bottom: 18px;
}

.step-content-box p {
    font-size: 17px;
    color: #64748b;
    line-height: 1.8;
}

/* ============ PREMIUM FORM WITH MICRO-INTERACTIONS ============ */
.form-sanctuary {
    padding: 150px 20px;
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    position: relative;
}

.form-container-deluxe {
    max-width: 850px;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    padding: 70px 60px;
    border-radius: 40px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 30px 90px rgba(0,0,0,0.5);
}

.form-header {
    text-align: center;
    margin-bottom: 60px;
}

.form-header h2 {
    font-size: 48px;
    color: white;
    font-weight: 900;
    margin-bottom: 15px;
}

.form-header p {
    font-size: 19px;
    color: rgba(255,255,255,0.8);
}

.input-group {
    margin-bottom: 35px;
    position: relative;
}

.input-group label {
    display: block;
    color: rgba(255,255,255,0.9);
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 12px;
    transition: all 0.3s;
}

.input-field {
    width: 100%;
    padding: 20px 25px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    color: white;
    font-size: 16px;
    font-family: inherit;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

.input-field::placeholder {
    color: rgba(255,255,255,0.5);
}

.input-field:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.15);
    border-color: #667eea;
    box-shadow: 0 0 0 6px rgba(102,126,234,0.2);
    transform: translateY(-3px);
}

.input-group:has(.input-field:focus) label {
    color: #667eea;
    transform: translateX(5px);
}

.divider-fancy {
    display: flex;
    align-items: center;
    gap: 25px;
    margin: 50px 0;
}

.divider-fancy span {
    color: rgba(255,255,255,0.6);
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.divider-fancy::before,
.divider-fancy::after {
    content: '';
    flex: 1;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(102,126,234,0.5), transparent);
}

.submit-button-epic {
    width: 100%;
    padding: 24px 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 20px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 2px;
    cursor: pointer;
    transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    box-shadow: 0 20px 50px rgba(102,126,234,0.5);
    position: relative;
    overflow: hidden;
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
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 30px 70px rgba(102,126,234,0.7);
}

/* ============ CALL-TO-ACTION EXPLOSION ============ */
.cta-explosion {
    padding: 120px 20px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cta-explosion::before {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(255,255,255,0.1), transparent);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: expand-pulse 4s ease-in-out infinite;
}

@keyframes expand-pulse {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
    50% { transform: translate(-50%, -50%) scale(1.5); opacity: 0.2; }
}

.cta-explosion h3 {
    font-size: 52px;
    color: white;
    font-weight: 900;
    margin-bottom: 30px;
    text-shadow: 0 10px 30px rgba(0,0,0,0.3);
    animation: bounce-in 1s ease-out;
}

@keyframes bounce-in {
    0% { transform: scale(0); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.phone-display {
    font-size: 58px;
    color: white;
    font-weight: 900;
    margin: 40px 0;
    letter-spacing: 3px;
    text-shadow: 0 8px 25px rgba(0,0,0,0.4);
    animation: glow-pulse 2s ease-in-out infinite;
}

@keyframes glow-pulse {
    0%, 100% { text-shadow: 0 0 30px rgba(255,255,255,0.8); }
    50% { text-shadow: 0 0 60px rgba(255,255,255,1); }
}

/* ============ RESPONSIVE ============ */
@media (max-width: 768px) {
    .hero-title { font-size: 42px; }
    .reward-amount { font-size: 48px; }
    .section-title { font-size: 38px; }
    .timeline-step { flex-direction: column !important; }
    .features-grid { grid-template-columns: 1fr; }
}

/* Generate 50 particles */
</style>

<?php
// Generate 50 floating particles
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
    <h2 class="section-title" style="color: white; margin-bottom: 100px;">Why Our Program is Unbeatable</h2>
    
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

<!-- ========== ANIMATED TIMELINE ========== -->
<div class="timeline-section">
    <h2 class="section-title">How It Works</h2>
    
    <div class="timeline-flow">
        <div class="timeline-step">
            <div class="step-number-circle">1</div>
            <div class="step-content-box">
                <h4>Share Referral Details</h4>
                <p>Simply fill out our elegant form below with your friend's contact information and their interior design aspirations.</p>
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

<!-- ========== PREMIUM FORM ========== -->
<div class="form-sanctuary">
    <div class="form-container-deluxe">
        <div class="form-header">
            <h2>Submit Your Referral</h2>
            <p>Help transform a friend's space & earn amazing rewards</p>
        </div>
        
        <form action="process-referral.php" method="POST">
            <!-- Your Info -->
            <div class="input-group">
                <label>Your Full Name *</label>
                <input type="text" name="your_name" class="input-field" required placeholder="John Doe">
            </div>
            
            <div class="input-group">
                <label>Your Email Address *</label>
                <input type="email" name="your_email" class="input-field" required placeholder="you@example.com">
            </div>
            
            <div class="input-group">
                <label>Your Phone Number *</label>
                <input type="tel" name="your_phone" class="input-field" required placeholder="+91 98765 43210">
            </div>
            
            <div class="divider-fancy">
                <span>Referral Information</span>
            </div>
            
            <!-- Referral Info -->
            <div class="input-group">
                <label>Referral's Full Name *</label>
                <input type="text" name="referral_name" class="input-field" required placeholder="Jane Smith">
            </div>
            
            <div class="input-group">
                <label>Referral's Email Address</label>
                <input type="email" name="referral_email" class="input-field" placeholder="friend@example.com">
            </div>
            
            <div class="input-group">
                <label>Referral's Phone Number *</label>
                <input type="tel" name="referral_phone" class="input-field" required placeholder="+91 98765 43210">
            </div>
            
            <div class="input-group">
                <label>Additional Details (Optional)</label>
                <textarea name="message" class="input-field" rows="4" placeholder="Tell us about their design dreams..."></textarea>
            </div>
            
            <button type="submit" class="submit-button-epic">Submit Now</button>
        </form>
    </div>
</div>

<!-- ========== CTA EXPLOSION ========== -->
<div class="cta-explosion">
    <h3>Questions? We're Here 24/7!</h3>
    <div class="phone-display">(+91) 949 508 7777</div>
    <p style="font-size: 19px; color: rgba(255,255,255,0.95); max-width: 650px; margin: 0 auto;">
        Our dedicated referral team is ready to answer any questions about the program
    </p>
</div>

<?php require_once('footer.php'); ?>