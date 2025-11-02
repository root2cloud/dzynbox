<?php require_once('header.php'); ?>

<?php
// Array of steps for the "How It Works" section
$steps = [
    [
        'number' => 1,
        'title' => 'Share Your Vision',
        'description' => 'Tell us about your space and style preferences through a quick questionnaire. Whether it\'s a cozy bedroom or a vibrant office, we\'ll capture your ideas to kickstart the design process.',
        'image' => 'https://res.cloudinary.com/df5wchqdr/image/upload/v1754462200/5e9f42301d84d8002f76526d_nlemth.jpg'
    ],
    [
        'number' => 2,
        'title' => 'Get Paired with an Expert',
        'description' => 'We connect you with a skilled designer who understands your aesthetic. They\'ll work closely with you to create a personalized plan tailored to your needs.',
        'image' => 'https://res.cloudinary.com/df5wchqdr/image/upload/v1754462200/5e9f42301d84d8002f76526d_nlemth.jpg'
    ],
    [
        'number' => 3,
        'title' => 'See Your Design in 3D',
        'description' => 'Experience your space come to life with immersive 3D renderings. Preview every detail, from furniture placement to color schemes, in a virtual walkthrough.',
        'image' => 'https://res.cloudinary.com/df5wchqdr/image/upload/v1754462200/5e9f42301d84d8002f76526d_nlemth.jpg'
    ],
    [
        'number' => 4,
        'title' => 'Refine Your Design',
        'description' => 'Collaborate with your designer to tweak and perfect the design. Use our intuitive platform to provide feedback and make adjustments until it\'s just right.',
        'image' => 'https://res.cloudinary.com/df5wchqdr/image/upload/v1754462200/5e9f42301d84d8002f76526d_nlemth.jpg'
    ],
    [
        'number' => 5,
        'title' => 'Bring It Home',
        'description' => 'Order your curated furniture and decor directly through our platform. Track deliveries and watch your dream space become reality with seamless setup guidance.',
        'image' => 'https://res.cloudinary.com/df5wchqdr/image/upload/v1754462200/5e9f42301d84d8002f76526d_nlemth.jpg'
    ]
];
?>

<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    }
    
    html {
        scroll-behavior: smooth;
    }
    
    /* Desktop-only improvements */
    @media (min-width: 768px) {
        /* Enhanced hero section for desktop */
        .hero-section {
            height: 70vh;
            max-height: 600px;
        }
        
        /* Better content container */
        .desktop-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Enhanced step cards */
        .step-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 1px solid rgba(0,0,0,0.05);
            min-height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .step-card:hover {
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            border-color: rgba(236, 72, 153, 0.2);
        }
        
        /* Better image containers */
        .step-image-container {
            position: relative;
            overflow: hidden;
            height: 550px;
        }
        
        .step-image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }
        
        .step-image-container:hover::before {
            opacity: 1;
        }
        
        .step-image-container img {
            height: 550px;
            width: 100%;
            object-fit: cover;
        }
        
        /* Enhanced number badge */
        .step-number {
            width: 70px;
            height: 70px;
            font-size: 28px;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.3);
        }
        
        /* Better spacing */
        .step-wrapper {
            padding: 100px 0;
        }
        
        .step-item {
            margin-bottom: 120px;
        }
        
        /* Enhanced text content */
        .step-title {
            font-size: 3rem;
            line-height: 1.2;
            margin-bottom: 32px;
            font-weight: 800;
        }
        
        .step-description {
            font-size: 1.5rem;
            line-height: 2;
            color: #4b5563;
            font-weight: 400;
        }
        
        /* CTA section improvements */
        .cta-section {
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .cta-button {
            padding: 20px 60px;
            font-size: 1.375rem;
            font-weight: 700;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        
        .cta-button:hover {
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
            transform: translateY(-3px) scale(1.05);
        }
        
        /* Introduction section */
        .intro-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 28px;
        }
        
        .intro-description {
            font-size: 1.5rem;
            line-height: 1.8;
        }
        
        /* CTA text sizing */
        .cta-title {
            font-size: 3.5rem;
            font-weight: 800;
        }
        
        .cta-description {
            font-size: 1.625rem;
            line-height: 1.8;
        }
    }
    
    /* Fade in animation - applies to all viewports */
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
    
    .fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .step-0 { animation-delay: 0s; opacity: 0; }
    .step-1 { animation-delay: 0.15s; opacity: 0; }
    .step-2 { animation-delay: 0.3s; opacity: 0; }
    .step-3 { animation-delay: 0.45s; opacity: 0; }
    .step-4 { animation-delay: 0.6s; opacity: 0; }
</style>

<!-- Hero Section -->
<section class="relative h-[55vh] md:hero-section flex items-center justify-center text-center bg-cover bg-center rounded-2xl shadow-xl mx-6 mt-8 overflow-hidden"
    style="background-image: url('https://res.cloudinary.com/dsj36zc9m/image/upload/v1755767372/spacejoy-9M66C_w_ToM-unsplash_hfyr47.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/50"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 drop-shadow-2xl">
            Your Design Journey Starts Here
        </h1>
        <p class="text-xl md:text-3xl text-gray-100 font-light leading-relaxed">
            Learn how we transform your space in 5 simple steps
        </p>
    </div>
</section>

<!-- Main Content Section -->
<section class="py-20 md:step-wrapper bg-white">
    <div class="container mx-auto px-4 desktop-container">
        <!-- Introduction -->
        <div class="text-center mb-16 md:mb-32">
            <h2 class="text-4xl md:intro-title font-bold text-gray-900 mb-4">How It Works</h2>
            <p class="text-xl md:intro-description text-gray-600 max-w-3xl md:max-w-5xl mx-auto leading-relaxed">
                Transform your space in five simple steps with our expert team. 
                From vision to reality, we're with you every step of the way.
            </p>
        </div>

        <!-- Steps -->
        <?php foreach ($steps as $idx => $step): ?>
        <div class="flex flex-col md:flex-row items-center justify-center mx-auto mb-20 md:step-item max-w-7xl space-y-8 md:space-y-0 md:space-x-20 group step-<?php echo $idx; ?> fade-in-up">
            <?php if ($idx % 2 == 0): ?>
                <!-- Text Left, Image Right -->
                <div class="md:w-1/2 w-full flex flex-col justify-center px-4">
                    <div class="bg-white md:step-card rounded-2xl shadow-lg hover:shadow-2xl p-8 md:p-16 transition-all duration-300 ease-in-out hover:scale-105">
                        <div class="flex items-center mb-4 md:mb-10">
                            <span class="flex items-center justify-center w-12 h-12 md:step-number rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold text-xl mr-4 md:mr-6">
                                <?php echo $step['number']; ?>
                            </span>
                            <h2 class="text-3xl md:step-title font-bold text-gray-900 group-hover:text-pink-600 transition-colors duration-300">
                                <?php echo htmlspecialchars($step['title']); ?>
                            </h2>
                        </div>
                        <p class="text-lg md:step-description leading-relaxed">
                            <?php echo htmlspecialchars($step['description']); ?>
                        </p>
                    </div>
                </div>
                
                <!-- Image Right -->
                <div class="md:w-1/2 w-full flex justify-center px-4">
                    <div class="overflow-hidden rounded-2xl md:step-image-container shadow-lg hover:shadow-2xl transition-all duration-300">
                        <img src="<?php echo htmlspecialchars($step['image']); ?>"
                             alt="<?php echo htmlspecialchars($step['title']); ?>"
                             class="w-full h-80 object-cover transition-transform duration-500 hover:scale-110" />
                    </div>
                </div>
            <?php else: ?>
                <!-- Image Left, Text Right -->
                <div class="md:w-1/2 w-full flex justify-center px-4 order-2 md:order-1">
                    <div class="overflow-hidden rounded-2xl md:step-image-container shadow-lg hover:shadow-2xl transition-all duration-300">
                        <img src="<?php echo htmlspecialchars($step['image']); ?>"
                             alt="<?php echo htmlspecialchars($step['title']); ?>"
                             class="w-full h-80 object-cover transition-transform duration-500 hover:scale-110" />
                    </div>
                </div>
                
                <div class="md:w-1/2 w-full flex flex-col justify-center px-4 order-1 md:order-2">
                    <div class="bg-white md:step-card rounded-2xl shadow-lg hover:shadow-2xl p-8 md:p-16 transition-all duration-300 ease-in-out hover:scale-105">
                        <div class="flex items-center mb-4 md:mb-10">
                            <span class="flex items-center justify-center w-12 h-12 md:step-number rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold text-xl mr-4 md:mr-6">
                                <?php echo $step['number']; ?>
                            </span>
                            <h2 class="text-3xl md:step-title font-bold text-gray-900 group-hover:text-pink-600 transition-colors duration-300">
                                <?php echo htmlspecialchars($step['title']); ?>
                            </h2>
                        </div>
                        <p class="text-lg md:step-description leading-relaxed">
                            <?php echo htmlspecialchars($step['description']); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 md:cta-section bg-gradient-to-r from-pink-500 to-purple-600 relative">
    <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="text-4xl md:cta-title font-bold text-white mb-6 md:mb-10">Ready to Get Started?</h2>
        <p class="text-xl md:cta-description text-white/90 mb-8 md:mb-14 max-w-2xl md:max-w-4xl mx-auto leading-relaxed">
            Begin your interior design journey today and transform your space into something extraordinary.
        </p>
        <a href="contact.php" class="inline-block md:cta-button bg-white text-pink-600 font-bold text-lg px-10 py-4 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
            Start Your Project
        </a>
    </div>
</section>
<?php require_once('footer.php'); ?>

