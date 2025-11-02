<?php require_once('header.php'); ?>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    /*  Desktop view adjustments only */
@media (min-width: 992px) {

  /* Product container common style for Featured, Latest, Popular sections */
  .productt.kk .itemm.kl,
  .productt.kk .itemm.kl .thumb.lk img,
  .productt.kk .product-carousel .itemm.kl .thumb.lk {
    border-radius: 10px !important;
    overflow: hidden !important;
  }

  /*  Ensure images have smooth rounded corners like mobile */
  .productt.kk .thumb.lk .photo.ph {
    border-radius: 10px !important;
    overflow: hidden !important;
  }

  /*  Name section (remove underline & center align) */
  .productt.kk .text h3,
  .productt.kk .text h3 a {
    text-decoration: none !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    color: #111 !important;
    text-align: center !important;
    display: block !important;
    transition: color 0.3s ease;
  }

  /* Hover soft highlight (optional) */
  .productt.kk .text h3 a:hover {
    color: #e91e63 !important;
  }

  /*  Price spacing and style fix for consistency */
  .productt.kk .text h4 {
    text-align: center !important;
    margin-top: 6px !important;
    font-size: 15px !important;
    font-weight: 500 !important;
    color: #000 !important;
  }

  /*  Plus icon beside price */
  .productt.kk .text h4 a i {
    background: #000 !important;
    color: #fff !important;
    border-radius: 50% !important;
    padding: 5px !important;
    font-size: 12px !important;
  }

  /*  Smooth shadow and padding like mobile */
  .productt.kk .itemm.kl {
    padding: 10px !important;
    border: 1px solid #e0e0e0 !important;
    border-radius: 10px !important;
    transition: box-shadow 0.3s ease;
  }

  .productt.kk .itemm.kl:hover {
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
  }

}
    /* Desktop Styles - UNCHANGED */
    .module-heading {
      font-family: 'Roboto', sans-serif;
      font-size: 28px;
      font-weight: 700;
      color: #333;
    }

    .category-name {
      font-family: 'Roboto', sans-serif;
      font-size: 18px;
      font-weight: 400;
      color: #555;
    }

    a.category {
      font-family: 'Roboto', sans-serif;
      text-decoration: none;
      color: #000;
    }

    .thumb {
        position: relative;
        height: 200px;
        background-color: #f8f8f8;
        transition: background-color 0.3s ease;
    }

    .product-card:hover .thumb {
        background-color: #eaeaea;
    }

    .text {
        padding: 15px;
    }

    a.category:hover .category-name {
      color: rgba(15, 15, 15, 1.00);
    }

    h2, .module-heading {
        padding: 20px 0 10px 0;
        font-family: "Roboto", sans-serif;
        font-size: 28px;
        line-height: 32px;
        color: #2F4858;
        text-align: center;
        text-transform: capitalize;
    }

    .explore-categories .category .category-name {
        color: #000000;
        -webkit-transition: color .3s ease;
        transition: color .3s ease;
    }

    .nav {
        background: white;
    }

    .menu > ul > li a {
        text-decoration: none;
        padding: 0.5em 20px;
        display: block;
        color: black;
    }

    .product-card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
    }

    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .out-of-stock {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 0, 0, 0.7);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5em;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .categories{
        position: relative;
        margin-top: 30px;
    }

    .row {
        margin-right:0px; 
        margin-left: 0px; 
    }

    .secondcategories{
        position: relative;
        margin-top: 30px;
    }

    .category img {
        width: 40px;
        height: 40px;
    }
    
    .category-name {
        margin-top: 14px;
        text-align: center;
    }
    
    .category {
        text-align: center;
        display: block;
    }

    .product .item {
    }

    .kk .kl .lk .ph{
        width: 100%;
        height: 200px;
        -webkit-background-size: cover;
        background-size: cover;
        background-position: center center;
        background-repeat:no-repeat;
    }

    .kk .text h3 a {
        color:rgba(15, 15, 15, 1.00);
        font-weight: 400;
        font-size: 14px;
        line-height: 1.5;
    }

    .kk .text h4 {
        color:rgb(15, 15, 15);
        text-align: center;
        font-size:15px;
    }

    .explore-categories .categories {
      display: flex;
      gap: 20px;
      overflow-x: auto;
      padding: 20px 0;
    }

    .category {
      flex: 0 0 auto;
      text-align: center;
      width: 150px;
    }

    .category img {
      max-width: 100%;
      height: auto;
    }

    .category-name {
      margin-top: 10px;
      font-size: 16px;
    }

    .estimation-link h4 {
      transition: all 0.3s ease;
    }

    .estimation-link h4:hover {
      transform: scale(1.05);
      text-decoration: underline;
      color: #007bff;
    }

    /* MOBILE RESPONSIVE - ENHANCED */
    @media (max-width: 768px) {
        /* Carousel */
        #carouselExample .carousel-inner {
            height: 280px !important;
        }
        
        #carouselExample .carousel-item {
            height: 280px !important;
        }
        
        #carouselExample .carousel-item img,
        #carouselExample .carousel-item video {
            height: 280px !important;
            object-fit: cover !important;
        }
        
        /* Module Headings */
        .module-heading,
        h2 {
            font-size: 20px !important;
            padding: 15px 10px !important;
            line-height: 1.3 !important;
        }
        
        .headline h2 {
            font-size: 18px !important;
        }
        
        .headline h3 {
            font-size: 14px !important;
        }
        
        /* Category Section */
        .explore-categories .categories {
            gap: 12px !important;
            padding: 15px 8px !important;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
        }
        
        .category {
            width: 90px !important;
            flex-shrink: 0 !important;
        }
        
        .category img {
            width: 32px !important;
            height: 32px !important;
        }
        
        .category-name {
            font-size: 11px !important;
            margin-top: 6px !important;
            line-height: 1.2 !important;
        }
        
        /* Video Grid - Stack Vertically */
        div[style*="width:100%;display:flex;justify-content:space-between"] {
            flex-direction: column !important;
            padding: 10px !important;
            width: 100% !important;
        }
        
        div[style*="margin:10px;width:30%"] {
            width: 100% !important;
            margin: 8px 0 !important;
        }
        
        div[style*="margin:10px;width:30%"] video {
            width: 100% !important;
            height: 220px !important;
        }
        
        div[style*="margin:10px;width:30%"] h4 {
            font-size: 14px !important;
            margin-top: 8px !important;
        }
        
        /* Product Cards - FIXED LAYOUT */
        .productt.kk {
            padding: 12px 0 !important;
        }
        
        .product-carousel {
            padding: 0 8px !important;
        }
        
        /* Product card container */
        .itemm.kl {
            margin: 8px 4px !important;
            background: white !important;
            border: 1px solid #e0e0e0 !important;
            border-radius: 8px !important;
            overflow: hidden !important;
            height: auto !important;
            min-height: auto !important;
        }
        
        /* Main product link - FLEX COLUMN */
        .itemm.kl > a.product-main-link {
            display: flex !important;
            flex-direction: column !important;
            text-decoration: none !important;
            color: inherit !important;
            position: relative !important;
        }
        
        /* Thumb container - NO absolute positioning */
        .thumb.lk {
            height: 200px !important;
            width: 100% !important;
            position: relative !important;
            display: block !important;
            flex-shrink: 0 !important;
        }
        
        /* CRITICAL: Photo div must NOT be absolutely positioned */
        .kk .kl .lk .ph,
        .thumb.lk .ph,
        .thumb .photo,
        .photo.ph {
            position: relative !important;
            width: 100% !important;
            height: 200px !important;
            top: auto !important;
            left: auto !important;
            bottom: auto !important;
            right: auto !important;
        }
        
        /* Overlay if any */
        .thumb .overlay {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
        }
        
        /* Text section BELOW image - STATIC POSITIONING */
        .itemm.kl .text,
        .kk .itemm.kl .text,
        .kk .text {
            position: static !important;
            display: block !important;
            padding: 12px !important;
            background: white !important;
            width: 100% !important;
            top: auto !important;
            left: auto !important;
            bottom: auto !important;
            right: auto !important;
            transform: none !important;
            margin-top: 0 !important;
        }
        
        /* Center tag */
        .kk .text center {
            display: block !important;
            width: 100% !important;
            visibility: visible !important;
        }
        
        /* Product name */
        .kk .text h3 {
            font-size: 14px !important;
            line-height: 1.4 !important;
            margin: 0 0 8px 0 !important;
            text-align: center !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            color: #000 !important;
        }
        
        .kk .text h3 a {
            font-size: 14px !important;
            color: #000 !important;
            text-decoration: none !important;
            display: inline !important;
            visibility: visible !important;
            pointer-events: none !important;
        }
        
        /* Price */
        .kk .text h4 {
            font-size: 16px !important;
            font-weight: 600 !important;
            margin: 8px 0 !important;
            display: block !important;
            text-align: center !important;
            color: #000 !important;
            visibility: visible !important;
        }
        
        /* Plus icon link - CLICKABLE on mobile */
        .kk .text h4 a {
            display: inline-flex !important;
            margin-left: 8px !important;
            pointer-events: auto !important;
            position: relative !important;
            z-index: 10 !important;
        }
        
        .kk .text h4 a i {
            background: #000 !important;
            color: #fff !important;
            padding: 6px !important;
            border-radius: 50% !important;
            font-size: 12px !important;
        }
        
        /* Rating */
        .kk .text .rating {
            font-size: 12px !important;
            display: block !important;
            text-align: center !important;
            margin-top: 8px !important;
        }
        
        .kk .text .rating i {
            font-size: 12px !important;
            color: #ffa500 !important;
        }
        
        /* Out of Stock */
        .out-of-stock {
            font-size: 1.1em !important;
        }
        
        /* Container Padding */
        .container-fluid {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
    }

    @media (max-width: 576px) {
        #carouselExample .carousel-inner,
        #carouselExample .carousel-item,
        #carouselExample .carousel-item img,
        #carouselExample .carousel-item video {
            height: 220px !important;
        }
        
        .module-heading,
        h2 {
            font-size: 18px !important;
        }
        
        .headline h2 {
            font-size: 16px !important;
        }
        
        .headline h3 {
            font-size: 12px !important;
        }
        
        .category {
            width: 80px !important;
        }
        
        .category img {
            width: 28px !important;
            height: 28px !important;
        }
        
        .category-name {
            font-size: 10px !important;
            margin-top: 5px !important;
        }
        
        div[style*="margin:10px;width:30%"] video {
            height: 180px !important;
        }
        
        div[style*="margin:10px;width:30%"] h4 {
            font-size: 13px !important;
        }
        
        .thumb.lk,
        .kk .kl .lk .ph,
        .thumb.lk .ph,
        .thumb .photo,
        .photo.ph {
            height: 180px !important;
        }
        
        .kk .text {
            padding: 10px !important;
        }
        
        .kk .text h3,
        .kk .text h3 a {
            font-size: 13px !important;
        }
        
        .kk .text h4 {
            font-size: 15px !important;
        }
    }

    @media (max-width: 480px) {
        #carouselExample .carousel-inner,
        #carouselExample .carousel-item,
        #carouselExample .carousel-item img,
        #carouselExample .carousel-item video {
            height: 200px !important;
        }
        
        .module-heading,
        h2 {
            font-size: 16px !important;
            padding: 12px 8px !important;
        }
        
        .explore-categories .categories {
            gap: 10px !important;
            padding: 12px 6px !important;
        }
        
        .category {
            width: 70px !important;
        }
        
        .category img {
            width: 26px !important;
            height: 26px !important;
        }
        
        .category-name {
            font-size: 9px !important;
        }
        
        div[style*="margin:10px;width:30%"] video {
            height: 160px !important;
        }
        
        .thumb.lk,
        .kk .kl .lk .ph,
        .thumb.lk .ph,
        .thumb .photo,
        .photo.ph {
            height: 160px !important;
        }
        
        .kk .text {
            padding: 8px !important;
        }
        
        .kk .text h3,
        .kk .text h3 a {
            font-size: 12px !important;
        }
        
        .kk .text h4 {
            font-size: 14px !important;
        }
        
        .kk .text .rating i {
            font-size: 11px !important;
        }
    }
    @media (min-width: 992px) {
  .what-we-do {
    background: #fff;
    padding: 80px 60px;
    font-family: "Roboto", sans-serif;
    text-align: center;
  }

  .what-we-do h2 {
    font-size: 28px;
    font-weight: 700;
    text-transform: uppercase;
    color: #2F4858;
    margin-bottom: 50px;
    letter-spacing: 1px;    
  }

  .what-we-do-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    justify-content: center;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
    position: relative;
  }

  .room-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: transform 0.4s ease, box-shadow 0.3s ease;
    background: #000;
  }

  .room-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }

  .room-card:hover img {
    transform: scale(1.05);
  }

  .room-card .overlay-text {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.3);
    color: #fff;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 6rem;
    opacity: 1;
    transition: opacity 0.3s ease;
  }

  .room-card:hover .overlay-text {
    opacity: 1;
  }

  /*  Individual Controls — adjust freely per image */
  
  /* Living Room (top-left, wide) */
  .living {
    width: 800px;
    height: 320px;
    transform: translateX(220px); /* shift left (-) or right (+) */
  }

  /* Kitchen (top-right, narrow & taller) */
  .kitchen {
    width: 420px;
    height: 320px;
    transform: translateX(230px); /* move right */
  }

  /* Dining (bottom-left, smaller square) */
  .dining {
    width: 350px;
    height: 330px;
    transform: translateX(220px); /* offset horizontally */
  }

  /* Bedroom (bottom-right, wide rectangle) */
  .bedroom {
    width: 870px;
    height: 330px;
    transform: translateX(-220px); /* more to the right */
  }

  /* Layout placement inside grid */
  .living { grid-column: 1; grid-row: 1; }
  .kitchen { grid-column: 2; grid-row: 1; }
  .dining { grid-column: 1; grid-row: 2; }
  .bedroom { grid-column: 2; grid-row: 2; }

  /* .living .overlay-text { font-size: 8rem; }
  .kitchen .overlay-text { font-size: 2rem; }
  .dining .overlay-text { font-size: 1.8rem; }
  .bedroom .overlay-text { font-size: 10rem; } */

}

/* Mobile: hide entirely */
@media (max-width: 991px) {
  .what-we-do { display: none; }
}

/* Reach Out Our Design Consultant Button */

 .design-btn {
  display: inline-block;
  margin-top: 60px;
  padding: 18px 45px;
  background: #2F4858; /* deep bluish tone matching header */
  color: #fff;
  font-size: 18px;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-decoration: none;
  border-radius: 50px;
  transition: all 0.3s ease;
  box-shadow: 0px 6px 18px rgba(0,0,0,0.2);
}

.design-btn:hover {
  background: #1b2f3c;
  box-shadow: 0 10px 25px rgba(47,72,88,0.35);
  transform: translateY(-3px);
}

</style>
</head>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $featured_product_title = $row['featured_product_title'];
    $featured_product_subtitle = $row['featured_product_subtitle'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $total_featured_product_home = $row['total_featured_product_home'];
    $total_latest_product_home = $row['total_latest_product_home'];
    $total_popular_product_home = $row['total_popular_product_home'];
    $home_service_on_off = $row['home_service_on_off'];
    $home_welcome_on_off = $row['home_welcome_on_off'];
    $home_featured_product_on_off = $row['home_featured_product_on_off'];
    $home_latest_product_on_off = $row['home_latest_product_on_off'];
    $home_popular_product_on_off = $row['home_popular_product_on_off'];
}
?>

<div id="carouselExample" class="carousel slide" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="false">
            <video class="d-block w-100" autoplay muted style="object-fit:cover;">
                <source src="https://res.cloudinary.com/df5wchqdr/video/upload/v1755580538/Walkthrough_video_1_adklln.mp4" type="video/mp4">
            </video>
        </div>              
        <div class="carousel-item" data-bs-interval="3000">
            <img src="https://res.cloudinary.com/df5wchqdr/image/upload/v1755841798/8853628f-7b7e-4614-9363-3d296437c72f_nk9aue.png" class="d-block w-100" alt="Slide 1" style="object-fit:cover;">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <img src="https://res.cloudinary.com/df5wchqdr/image/upload/v1755842221/3c0ee229-d64c-42c0-a658-3201644548d3_yhhn6b.png" class="d-block w-100" alt="Slide 2" style="object-fit:cover;">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <img src="https://res.cloudinary.com/df5wchqdr/image/upload/v1755842488/6833a1c5-d6e1-437f-8e9b-460470c881f0_qcuuzj.png" class="d-block w-100" alt="Slide 3" style="object-fit:cover;">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <img src="https://res.cloudinary.com/df5wchqdr/image/upload/v1755841444/b74a0a26-245b-493a-8b40-b34128cb80d6_bb78eb.png" class="d-block w-100" alt="Slide 3" style="object-fit:cover;">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
  const carouselElement = document.getElementById('carouselExample');
  const carousel = new bootstrap.Carousel(carouselElement, {
    interval: false,
    ride: false
  });

  const items = carouselElement.querySelectorAll('.carousel-item');

  items.forEach((item, index) => {
    const video = item.querySelector('video');

    if (video) {
      video.pause();

      video.addEventListener('ended', () => {
        if (item.classList.contains('active')) {
          carousel.next();
        }
      });

      carouselElement.addEventListener('slide.bs.carousel', (event) => {
        const oldSlide = items[event.from];
        const newSlide = items[event.to];

        const oldVideo = oldSlide.querySelector('video');
        if (oldVideo) {
          oldVideo.pause();
          oldVideo.currentTime = 0;
        }

        const newVideo = newSlide.querySelector('video');
        if (newVideo) {
          newVideo.play();
        }
      });
    }
  });

  function autoAdvanceIfImageSlide() {
    const activeSlide = carouselElement.querySelector('.carousel-item.active');
    const hasVideo = !!activeSlide.querySelector('video');

    if (!hasVideo) {
      setTimeout(() => {
        carousel.next();
      }, 3000);
    }
  }

  carouselElement.addEventListener('slid.bs.carousel', () => {
    autoAdvanceIfImageSlide();
  });

  const firstSlide = carouselElement.querySelector('.carousel-item.active');
  const firstVideo = firstSlide.querySelector('video');
  if (firstVideo) {
    firstVideo.play();
  } else {
    autoAdvanceIfImageSlide();
  }
});
</script>

<div class="hp-module text-center explore-categories">
  <div class="with-stroke module-heading bg-gray">Explore Our Furniture Range</div>
  <div class="categories single-row">
    
    <div class="category">
      <a href="#">
        <img src="https://cdn-icons-png.flaticon.com/512/9120/9120401.png" width="256" height="256" alt="Shopping bag icon">
        <h4 class="no-padding category-name">New Arrivals</h4>
      </a>
    </div>
    <div class="category">
      <a href="./product-category.php?id=112&type=end-category">
        <img src="https://cdn-icons-png.flaticon.com/512/2148/2148573.png" width="256" height="256" alt="Sofa icon">
        <h4 class="no-padding category-name">Sofas</h4>
      </a>
    </div>
    <div class="category">
      <a href="./product-category.php?id=84&type=end-category">
        <img src="https://cdn-icons-png.flaticon.com/512/8948/8948866.png" width="256" height="256" alt="Bed icon">
        <h4 class="no-padding category-name">Beds</h4>
      </a>
    </div>
    <div class="category">
      <a href="./product-category.php?id=134&type=end-category">
        <img src="https://cdn-icons-png.flaticon.com/512/1012/1012472.png" width="256" height="256" alt="Dining icon">
        <h4 class="no-padding category-name">Dining</h4>
      </a>
    </div>
    <div class="category">
      <a href="./product-category.php?id=108&type=end-category">
        <img src="https://cdn-icons-png.flaticon.com/512/7055/7055664.png" width="256" height="256" alt="Wardrobe icon">
        <h4 class="no-padding category-name">Wardrobes</h4>
      </a>
    </div>
    <div class="category">
      <a href="#">
        <img src="https://cdn-icons-png.flaticon.com/512/5378/5378071.png" width="256" height="256" alt="Shoe Rack icon">
        <h4 class="no-padding category-name">Shoe Racks</h4>
      </a>
    </div>
    <div class="category">
      <a href="#">
        <img src="https://cdn-icons-png.flaticon.com/512/4042/4042158.png" width="256" height="256" alt="Bookshelves icon">
        <h4 class="no-padding category-name">Bookshelves</h4>
      </a>
    </div>
    <div class="category">
      <a href="./product-category.php?id=109&type=end-category">
        <img src="https://cdn-icons-png.flaticon.com/512/109/109972.png" width="256" height="256" alt="TV Unit icon">
        <h4 class="no-padding category-name">TV Units</h4>
      </a>
    </div>
    <div class="category">
      <a href="./product-category.php?id=124&type=end-category">
        <img src="https://cdn-icons-png.flaticon.com/512/3374/3374344.png" width="256" height="256" alt="Decor icon">
        <h4 class="no-padding category-name">Decor</h4>
      </a>
    </div>
    <div class="category">
      <a href="#">
        <img src="https://cdn-icons-png.flaticon.com/512/1698/1698625.png" width="256" height="256" alt="Recliner icon">
        <h4 class="no-padding category-name">Recliners</h4>
      </a>
    </div>
    <div class="category">
      <a href="./product-category.php?id=110&type=end-category">
        <img src="https://cdn-icons-png.flaticon.com/512/686/686648.png" width="256" height="256" alt="Seating icon">
        <h4 class="no-padding category-name">Seating</h4>
      </a>
    </div>
    <div class="category">
      <a href="./product-category.php?id=111&type=end-category">
        <img src="https://cdn-icons-png.flaticon.com/512/7343/7343249.png" width="256" height="256" alt="Coffee Table icon">
        <h4 class="no-padding category-name">Coffee Tables</h4>
      </a>
    </div>

  </div>
</div>

<section class="what-we-do">
  <h2>What We Do</h2>

  <div class="what-we-do-grid">
    <div class="room-card living">
      <a href="./product-category.php?id=85&type=end-category">
        <img src="https://res.cloudinary.com/df5wchqdr/image/upload/v1761310225/Living_Room_ybvqci.jpg" alt="Living Room">
        <div class="overlay-text">Living</div>
      </a>
    </div>

    <div class="room-card kitchen">
      <a href="./product-category.php?id=107&type=end-category">
        <img src="https://res.cloudinary.com/df5wchqdr/image/upload/v1761310225/Kitchen_qy0qd8.jpg" alt="Kitchen">
        <div class="overlay-text">Kitchen</div>
      </a>
    </div>

    <div class="room-card dining">
      <a href="./product-category.php?id=134&type=end-category">
        <img src="https://res.cloudinary.com/df5wchqdr/image/upload/v1761310225/Dining_bccslx.jpg" alt="Dining">
        <div class="overlay-text">Dining</div>
      </a>
    </div>

    <div class="room-card bedroom">
      <a href="./product-category.php?id=84&type=end-category">
        <img src="https://res.cloudinary.com/df5wchqdr/image/upload/v1761310225/Bedroom_anfwm4.jpg" alt="Bedroom">
        <div class="overlay-text">Bedroom</div>
      </a>
    </div>
  </div>
  <a href="contact.php" class="design-btn">Reach Out Our Design Consultant</a>
</section>

<?php if($home_featured_product_on_off == 1): ?>
    <div class="productt kk pt_10 pb_10">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?php echo $featured_product_title; ?></h2>
                    <h3><?php echo $featured_product_subtitle; ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="product-carousel">
                    
                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? LIMIT ".$total_featured_product_home);
                    $statement->execute(array(1,1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>
                        <div class="itemm kl">
                           <a href="product.php?id=<?php echo $row['p_id']; ?>" class="product-main-link">
                            <div class="thumb lk ">
                                <div class="photo ph" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                <div class="overlay"></div>
                            </div>
                            <div class="text">
                                <center>
                                <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                    </center>
                                <h4>
                                ₹<?php echo $row['p_current_price']; ?> 
                                    <del></del>
                                     <a href="product.php?id=<?php echo $row['p_id']; ?>" style="display: inline-flex; align-items: center; text-decoration: none; margin-left: 10px;">
                                <i class="fa fa-plus" style="color: white; background-color: black; padding: 5px; border-radius: 50%;"></i>
                            </a>
                                </h4>
                                <div class="rating">
                                    <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
                                    if($avg_rating == 0) {
                                        echo '';
                                    }
                                    elseif($avg_rating == 1.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    } 
                                    elseif($avg_rating == 2.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 3.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 4.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                    }
                                    else {
                                        for($i=1;$i<=5;$i++) {
                                            ?>
                                            <?php if($i>$avg_rating): ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php else: ?>
                                                <i class="fa fa-star"></i>
                                            <?php endif; ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                           </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php endif; ?>

<?php if($home_latest_product_on_off == 1): ?>
<div class="productt kk  pt_10 pb_10">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?php echo $latest_product_title; ?></h2>
                    <h3><?php echo $latest_product_subtitle; ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="product-carousel">

                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT ".$total_latest_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>
                        <div class="itemm kl">
                        <a href="product.php?id=<?php echo $row['p_id']; ?>" class="product-main-link">
                            <div class="thumb lk">
                                <div class="photo ph" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                <div class="overlay"></div>
                            </div>
                            <div class="text">
                                <center>
                                <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                    </center>
                                <h4>
                                ₹<?php echo $row['p_current_price']; ?> 
                                    <del></del>
                                    <a href="product.php?id=<?php echo $row['p_id']; ?>" style="display: inline-flex; align-items: center; text-decoration: none; margin-left: 10px;">
                                <i class="fa fa-plus" style="color: white; background-color: black; padding: 5px; border-radius: 50%;"></i>
                            </a>
                                </h4>
                                <div class="rating">
                                    <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
                                    if($avg_rating == 0) {
                                        echo '';
                                    }
                                    elseif($avg_rating == 1.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    } 
                                    elseif($avg_rating == 2.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 3.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 4.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                    }
                                    else {
                                        for($i=1;$i<=5;$i++) {
                                            ?>
                                            <?php if($i>$avg_rating): ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php else: ?>
                                                <i class="fa fa-star"></i>
                                            <?php endif; ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                        </a>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($home_popular_product_on_off == 1): ?>
    <div class="productt kk pt_10 pb_10">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?php echo $popular_product_title; ?></h2>
                    <h3><?php echo $popular_product_subtitle; ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="product-carousel">

                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_total_view DESC LIMIT ".$total_popular_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>
                        <div class="itemm kl">
                        <a href="product.php?id=<?php echo $row['p_id']; ?>" class="product-main-link">
                            <div class="thumb lk">
                                <div class="photo ph" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                <div class="overlay"></div>
                            </div>
                            <div class="text">
                                <center>
                                <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                    </center>
                                <h4>
                                ₹<?php echo $row['p_current_price']; ?> 
                                    <del></del>
                                    
                                    <a href="product.php?id=<?php echo $row['p_id']; ?>" style="display: inline-flex; align-items: center; text-decoration: none; margin-left: 10px;">
                                <i class="fa fa-plus" style="color: white; background-color: black; padding: 5px; border-radius: 50%;"></i>
                            </a>
                                </h4>   
                                <div class="rating">
                                    <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
                                    if($avg_rating == 0) {
                                        echo '';
                                    }
                                    elseif($avg_rating == 1.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    } 
                                    elseif($avg_rating == 2.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 3.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 4.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                    }
                                    else {
                                        for($i=1;$i<=5;$i++) {
                                            ?>
                                            <?php if($i>$avg_rating): ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php else: ?>
                                                <i class="fa fa-star"></i>
                                            <?php endif; ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                             <?php else: ?>
                                   
                                <?php endif; ?>
                            </div>
                        </a>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php require_once('footer.php'); ?>