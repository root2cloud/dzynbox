<?php
require_once('header.php');
// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bhkType = isset($_POST['bhk_type']) ? $_POST['bhk_type'] : '';
    $sizeType = isset($_POST['size_type']) ? $_POST['size_type'] : '';
    $materialType = isset($_POST['material_type']) ? $_POST['material_type'] : '';

    if ($bhkType && $sizeType && $materialType) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="quote.pdf"');
        echo "Quote for: " . htmlspecialchars($bhkType) . " BHK - " . htmlspecialchars($sizeType) . " with " . htmlspecialchars($materialType);
        exit;
    } else {
        echo "Error: Please complete all steps.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BHK Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Page Banner - Shorter on Desktop */
        .page-banner {
            background-color: #e0e0e0;
            padding: 20px 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .page-banner h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        /* Progress Bar */
        .progress-container {
            width: 100%;
            background-color:#8D8D8D;
            border-radius: 25px;
            height: 50px;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background-color:black;
            border-radius: 25px;
            transition: width 0.3s ease-in-out;
        }

        .steps {
            display: flex;
            justify-content: space-between;
            position: absolute;
            width: 100%;
            top: 15px;
            font-size: 14px;
        }

        .step {
            text-align: center;
            flex: 1;
            color: white;
            transition: all 0.3s;
        }

        .step.active {
            color:blue;
            font-weight: bold;
        }

        /* Step Container */
        .containerr {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display:flex;
            flex-direction: column;
        }

        .containerr > label {
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        /* BHK Images Container */
        #bhk-images {
            text-align: center;
            margin: 15px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #bhk-images.empty {
            display: none;
        }

        /* Step 1 Buttons */
        .buttons-container {
            display: flex;
            flex-direction: row;
            gap:15px;
            justify-content: center;
            padding:20px; 
            width:100%;
        }

        .buttons-container button:hover {
            background-color:black;
            transform: translateY(-2px);
        }

        .buttons-container button:focus {
            outline: none;
        }

        /* Step 2 Materials */
        .material-options label {
            display: block;
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
            box-shadow:2px 2px 1px 1px rgba(1,0,0,0.5);
            cursor: pointer;
        }

        .material-options input[type="radio"] {
            margin-right: 10px;
        }

        .material-options input[type="radio"]:checked + span {
            font-weight: bold;
        }

        .material-options label:has(input:checked) {
            background-color: #4caf50;
            color: white;
            box-shadow:2px 2px 5px 5px rgba(1,1,0,1);
        }

        .material-options label:hover {
            background-color: black;
            color:white;
        }

        /* Buttons */
        .button {
            background-color:black;
            color: white;
            border: none;
            padding: 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 6px;
            transition: background-color 0.3s;
            align-self:center;
        }

        .button:hover {
            background-color:#333;
        }

        .hidden {
            display: none !important;
        }

        /* Package Cards */
        .cards-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: 30%;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);   
        }

        .card h3 {
            margin-top: 0;
            color: #4caf50;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }

        .buttons-container button {
            background-color: black;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            text-align: center;
            min-width:20%; 
        }

        .dropdown{
            display:flex;
            justify-content:space-around;
            margin-top: 10px;
        }
        
        .dropdown label{
            font-size:16px;
            margin-left:13px;
            cursor: pointer;
        }

        .dropdown input[type="radio"] {
            margin-right: 5px;
        }
        
        .exclusive-card{
            background:black;
            color:white;
        }
        
        .premium-card{
            background:black;
            color:white;
        }
        
        .luxury-card{
            background:black;
            color:white;
        }
        
        .onebhk-button-container{
            display:flex;
            flex-direction:column;
            min-width: 20%;
        }
        
        .rotate {
            width: 25%;
            max-width: 300px;
            height: auto;
            animation: spin 30s linear infinite;
            display: block;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(45deg); }
            50% { transform:rotate(90deg); }
            100% { transform:rotate(180deg); }
        }

        /* Button Group for Back/Next */
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        /* MOBILE RESPONSIVE STYLES */
        @media (max-width: 768px) {
            /* Grey Banner on Mobile */
            .page-banner {
                padding: 30px 15px;
                margin-bottom: 20px;
            }

            .page-banner h1 {
                font-size: 28px;
            }

            /* Shorter progress container on mobile */
            .progress-container {
                width: 90%;
                max-width: 400px;
                height: 35px;
                margin: 0 auto 20px auto;
            }

            .steps {
                justify-content: center;
                top: 10px;
            }

            .step {
                display: none;
                font-size: 11px;
            }

            .step.active {
                display: block;
                flex: none;
                width: 100%;
            }

            .containerr {
                padding: 15px;
                margin: 0 10px 15px 10px;
            }

            .containerr > label {
                margin-bottom: 10px;
                font-size: 16px;
            }

            #bhk-images {
                margin: 10px 0;
            }

            .rotate {
                width: 50%;
                max-width: 200px;
            }

            /* Shorter buttons-container width on mobile */
            .buttons-container {
                flex-direction: column;
                gap: 10px;
                padding: 10px 0;
                width: 90%;
                max-width: 350px;
                margin: 0 auto;
            }

            .onebhk-button-container {
                width: 100%;
                min-width: 100%;
            }

            .buttons-container button {
                width: 100%;
                min-width: 100%;
                padding: 10px 15px;
                font-size: 14px;
            }

            .dropdown {
                flex-direction: column;
                gap: 8px;
                margin-top: 8px;
            }

            .dropdown label {
                font-size: 13px;
                margin-left: 0;
                padding: 8px;
                background: #f9f9f9;
                border-radius: 5px;
            }

            .material-options label {
                padding: 12px;
                font-size: 14px;
            }

            .cards-container {
                flex-direction: column;
                gap: 15px;
            }

            .card {
                width: 100%;
            }

            /* Back/Next buttons side by side on mobile */
            .button-group {
                display: flex;
                flex-direction: row;
                gap: 10px;
                justify-content: center;
                margin-top: 15px;
            }

            .button-group .button {
                width: auto;
                min-width: 100px;
                max-width: 150px;
                padding: 10px 20px;
                font-size: 14px;
                margin: 0;
            }

            /* Single button (Next only) on step 1 */
            .button {
                width: 70%;
                max-width: 200px;
                padding: 10px;
                font-size: 14px;
                margin: 8px auto;
            }
        }

        @media (max-width: 480px) {
            /* Smaller banner on small screens */
            .page-banner {
                padding: 25px 10px;
            }

            .page-banner h1 {
                font-size: 24px;
            }

            .progress-container {
                width: 85%;
                max-width: 320px;
                height: 32px;
                margin: 0 auto 15px auto;
            }

            .step {
                font-size: 10px;
            }

            .containerr {
                padding: 12px;
                margin: 0 8px 12px 8px;
            }

            .containerr > label {
                font-size: 15px;
            }

            #bhk-images {
                margin: 8px 0;
            }

            .rotate {
                width: 60%;
                max-width: 180px;
            }

            /* Even shorter buttons-container on small screens */
            .buttons-container {
                padding: 8px 0;
                gap: 8px;
                width: 85%;
                max-width: 300px;
            }

            .buttons-container button {
                padding: 8px 12px;
                font-size: 13px;
            }

            .dropdown label {
                font-size: 12px;
                padding: 6px;
            }

            .material-options label {
                padding: 10px;
                font-size: 13px;
            }

            .card h3 {
                font-size: 16px;
            }

            .card p {
                font-size: 12px;
            }

            /* Back/Next buttons side by side on small screens */
            .button-group .button {
                min-width: 90px;
                max-width: 130px;
                padding: 9px 15px;
                font-size: 13px;
            }

            /* Single button smaller */
            .button {
                width: 65%;
                max-width: 180px;
                padding: 9px;
                font-size: 13px;
            }
        }

        @media (max-width: 360px) {
            /* Smallest banner on tiny screens */
            .page-banner {
                padding: 20px 8px;
            }

            .page-banner h1 {
                font-size: 20px;
            }

            .progress-container {
                width: 80%;
                max-width: 280px;
                height: 30px;
            }

            .step {
                font-size: 9px;
            }

            .containerr {
                padding: 10px;
            }

            .containerr > label {
                font-size: 14px;
            }

            .rotate {
                width: 70%;
                max-width: 160px;
            }

            /* Even smaller buttons-container on tiny screens */
            .buttons-container {
                width: 80%;
                max-width: 260px;
            }

            .buttons-container button {
                padding: 7px 10px;
                font-size: 12px;
            }

            /* Back/Next buttons side by side on tiny screens */
            .button-group .button {
                min-width: 80px;
                max-width: 120px;
                padding: 8px 12px;
                font-size: 12px;
            }

            /* Single button smallest */
            .button {
                width: 60%;
                max-width: 160px;
                padding: 8px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<!-- Grey Page Banner -->
<div class="page-banner">
    <h1>BHK Tracker</h1>
</div>

<!-- Progress Bar -->
<div class="progress-container">
    <div class="progress-bar" id="progressBar"></div>
    <div class="steps">
        <div class="step active" id="step1Label">Step 1: Select BHK</div>
        <div class="step" id="step2Label">Step 2: Select Material</div>
        <div class="step" id="step3Label">Step 3: Select Package</div>
        <div class="step" id="step4Label">Step 4: Get Quote</div>
    </div>
</div>

<form method="POST" action="" id="trackerForm">
    <!-- Step 1: Select BHK -->
    <div class="containerr" id="step1-container">
        <label for="bhk-type">Select BHK Type:</label>
        
        <div id="bhk-images" class="empty">
            <img id="img-1bhk" src="https://res.cloudinary.com/df5wchqdr/image/upload/v1757065033/3c61a879-74ce-4843-8ce5-1239f3181c2b__1_-removebg-preview_nbeoes.png" class="rotate hidden" alt="1 BHK"/>
            <img id="img-2bhk" src="https://res.cloudinary.com/df5wchqdr/image/upload/v1757065739/Gemini_Generated_Image_wzm7r5wzm7r5wzm7__1_-removebg-preview_utmoe5.png" class="rotate hidden" alt="2 BHK"/>
            <img id="img-3bhk" src="https://res.cloudinary.com/df5wchqdr/image/upload/v1757065478/Gemini_Generated_Image_wzm7r5wzm7r5wzm7__2_-removebg-preview_cfa9rc.png" class="rotate hidden" alt="3 BHK"/>
            <img id="img-4bhk" src="https://res.cloudinary.com/df5wchqdr/image/upload/v1757068134/ChatGPT_Image_Sep_5__2025__03_57_31_PM-removebg-preview_e6ir1i.png" class="rotate hidden" alt="4 BHK"/>
            <img id="img-5bhk" src="https://res.cloudinary.com/df5wchqdr/image/upload/v1757068396/ChatGPT_Image_Sep_5__2025__04_01_06_PM-removebg-preview_vej3gs.png" class="rotate hidden" alt="5 BHK"/>
        </div>
    
        <div class="buttons-container">
            <div class="onebhk-button-container">
                <button type="button" onclick="selectBhk('1bhk')">1 BHK</button>
                <div id="1bhk" class="hidden dropdown">
                    <label><input type="radio" name="size_type" value="Small (below 1200 sqft)"> Small (below 1200 sqft)</label>
                    <label><input type="radio" name="size_type" value="Large (above 1200 sqft)"> Large (above 1200 sqft)</label>
                    <input type="hidden" name="bhk_type" value="1 BHK">
                </div>
            </div>
            
            <div class="onebhk-button-container">
                <button type="button" onclick="selectBhk('2bhk')">2 BHK</button>
                <div id="2bhk" class="hidden dropdown">
                    <label><input type="radio" name="size_type" value="Small (below 1200 sqft)"> Small (below 1200 sqft)</label>
                    <label><input type="radio" name="size_type" value="Large (above 1200 sqft)"> Large (above 1200 sqft)</label>
                    <input type="hidden" name="bhk_type" value="2 BHK">
                </div>
            </div>
            
            <div class="onebhk-button-container">
                <button type="button" onclick="selectBhk('3bhk')">3 BHK</button>
                <div id="3bhk" class="hidden dropdown">
                    <label><input type="radio" name="size_type" value="Small (below 1200 sqft)"> Small (below 1200 sqft)</label>
                    <label><input type="radio" name="size_type" value="Large (above 1200 sqft)"> Large (above 1200 sqft)</label>
                    <input type="hidden" name="bhk_type" value="3 BHK">
                </div>
            </div>
            
            <div class="onebhk-button-container">
                <button type="button" onclick="selectBhk('4bhk')">4 BHK</button>
                <div id="4bhk" class="hidden dropdown">
                    <label><input type="radio" name="size_type" value="Small (below 1200 sqft)"> Small (below 1200 sqft)</label>
                    <label><input type="radio" name="size_type" value="Large (above 1200 sqft)"> Large (above 1200 sqft)</label>
                    <input type="hidden" name="bhk_type" value="4 BHK">
                </div>
            </div>

            <div class="onebhk-button-container"> 
                <button type="button" onclick="selectBhk('5bhk')">5 BHK</button>
                <div id="5bhk" class="hidden dropdown">
                    <label><input type="radio" name="size_type" value="Small (below 1200 sqft)"> Small (below 1200 sqft)</label>
                    <label><input type="radio" name="size_type" value="Large (above 1200 sqft)"> Large (above 1200 sqft)</label>
                    <input type="hidden" name="bhk_type" value="5 BHK">
                </div>
            </div>
        </div>
        <button type="button" class="button" onclick="nextStep()">Next</button>
    </div>

    <!-- Step 2: Select Material -->
    <div class="containerr hidden" id="step2-container">
        <label>Select Material:</label>
        <div class="material-options">
            <label>
                <input type="radio" name="material_type" id="plywood" value="Plywood">
                <span>Plywood</span>
            </label>
            <label>
                <input type="radio" name="material_type" id="teak" value="Teak">
                <span>Teak</span>
            </label>
            <label>
                <input type="radio" name="material_type" id="hd-fiberwood" value="High Density Fiberwood">
                <span>High Density Fiberwood</span>
            </label>
        </div>
        <div class="button-group">
            <button type="button" class="button" onclick="previousStep()">Back</button>
            <button type="button" class="button" onclick="nextStep()">Next</button>
        </div>
    </div>

    <!-- Step 3: Select Package -->
    <div class="containerr hidden" id="step3-container">
        <label>Select a Package:</label>
        <div class="cards-container">
            <div class="card exclusive-card">
                <h3>Exclusive</h3>
                <p style="color:white;">Includes basic features and finishes.</p>
                <input type="radio" name="package_type" value="Exclusive" id="exclusive">
                <label for="exclusive" style="color:white; cursor:pointer;">Select Exclusive</label>
            </div>
            <div class="card premium-card">
                <h3>Premium</h3>
                <p style="color:white;">Includes advanced features and premium finishes.</p>
                <input type="radio" name="package_type" value="Premium" id="premium">
                <label for="premium" style="color:white; cursor:pointer;">Select Premium</label>
            </div>
            <div class="card luxury-card">
                <h3>Luxury</h3>
                <p style="color:white;">Top-of-the-line features and luxury finishes.</p>
                <input type="radio" name="package_type" value="Luxury" id="luxury">
                <label for="luxury" style="color:white; cursor:pointer;">Select Luxury</label>
            </div>
        </div>
        <div class="button-group">
            <button type="button" class="button" onclick="previousStep()">Back</button>
            <button type="button" class="button" onclick="nextStep()">Next</button>
        </div>
    </div>

    <!-- Step 4: Submit -->
    <div class="containerr hidden" id="step4-container">
        <p>Review your selections and submit the form to get your quote.</p>
        <div class="button-group">
            <button type="submit" class="button">Get Quote PDF</button>
            <button type="button" class="button" onclick="previousStep()">Back</button>
        </div>
    </div>
</form>

<script>
let currentStep = 1;

function selectBhk(bhkId) {
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => dropdown.classList.add('hidden'));
    
    document.getElementById(bhkId).classList.remove('hidden');
    
    document.querySelectorAll("#bhk-images img").forEach(img => {
        img.classList.add("hidden");
    });
    
    const selectedImage = document.getElementById("img-" + bhkId);
    const imageContainer = document.getElementById("bhk-images");
    
    if (selectedImage) {
        selectedImage.classList.remove("hidden");
        imageContainer.classList.remove("empty");
    }
}

function nextStep() {
    const totalSteps = 4;
    document.getElementById(step${currentStep}-container).classList.add('hidden');
    document.getElementById(step${currentStep}Label).classList.remove('active');
    currentStep++;
    if (currentStep <= totalSteps) {
        document.getElementById(step${currentStep}-container).classList.remove('hidden');
        document.getElementById(step${currentStep}Label).classList.add('active');
        const progressBar = document.getElementById('progressBar');
        progressBar.style.width = ${(currentStep - 1) / (totalSteps - 1) * 100}%;
    } else {
        currentStep = totalSteps;
    }
}

function previousStep() {
    if (currentStep > 1) {
        const totalSteps = 4;
        document.getElementById(step${currentStep}-container).classList.add('hidden');
        document.getElementById(step${currentStep}Label).classList.remove('active');
        currentStep--;
        if (currentStep > 0) {
            document.getElementById(step${currentStep}-container).classList.remove('hidden');
            document.getElementById(step${currentStep}Label).classList.add('active');
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = ${(currentStep - 1) / (totalSteps - 1) * 100}%;
        }
    }
}
</script>

</body>
</html>

<?php require_once('footer.php'); ?>