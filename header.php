<!-- This is main configuration File -->



	
<?php
ob_start();
session_start();
include("admin/inc/config.php");
include("admin/inc/functions.php");
include("admin/inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

// Getting all language variables into array as global variable
$i=1;
$statement = $pdo->prepare("SELECT * FROM tbl_language");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	define('LANG_VALUE_'.$i,$row['lang_value']);
	$i++;
}

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$logo = $row['logo'];
	$favicon = $row['favicon'];
	$contact_email = $row['contact_email'];
	$contact_phone = $row['contact_phone'];
	$meta_title_home = $row['meta_title_home'];
    $meta_keyword_home = $row['meta_keyword_home'];
    $meta_description_home = $row['meta_description_home'];
    $before_head = $row['before_head'];
    $after_body = $row['after_body'];
}

// Checking the order table and removing the pending transaction that are 24 hours+ old. Very important
$current_date_time = date('Y-m-d H:i:s');
$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status=?");
$statement->execute(array('Pending'));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$ts1 = strtotime($row['payment_date']);
	$ts2 = strtotime($current_date_time);     
	$diff = $ts2 - $ts1;
	$time = $diff/(3600);
	if($time>24) {

		// Return back the stock amount
		$statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
		$statement1->execute(array($row['payment_id']));
		$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result1 as $row1) {
			$statement2 = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
			$statement2->execute(array($row1['product_id']));
			$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);							
			foreach ($result2 as $row2) {
				$p_qty = $row2['p_qty'];
			}
			$final = $p_qty+$row1['quantity'];

			$statement = $pdo->prepare("UPDATE tbl_product SET p_qty=? WHERE p_id=?");
			$statement->execute(array($final,$row1['product_id']));
		}
		
		// Deleting data from table
		$statement1 = $pdo->prepare("DELETE FROM tbl_order WHERE payment_id=?");
		$statement1->execute(array($row['payment_id']));

		$statement1 = $pdo->prepare("DELETE FROM tbl_payment WHERE id=?");
		$statement1->execute(array($row['id']));
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


	<!-- Meta Tags -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="assets/uploads/<?php echo $favicon; ?>">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="assets/css/jquery.bxslider.min.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/rating.css">
	<link rel="stylesheet" href="assets/css/spacing.css">
	<link rel="stylesheet" href="assets/css/bootstrap-touch-slider.css">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/tree-menu.css">
	<link rel="stylesheet" href="assets/css/select2.min.css">
	<link rel="stylesheet" href="/DBNEW/assets/css/main.css">
	<link rel="stylesheet" href="assets/css/responsive.css">

	<?php

	$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$about_meta_title = $row['about_meta_title'];
		$about_meta_keyword = $row['about_meta_keyword'];
		$about_meta_description = $row['about_meta_description'];
		$faq_meta_title = $row['faq_meta_title'];
		$faq_meta_keyword = $row['faq_meta_keyword'];
		$faq_meta_description = $row['faq_meta_description'];
		$blog_meta_title = $row['blog_meta_title'];
		$blog_meta_keyword = $row['blog_meta_keyword'];
		$blog_meta_description = $row['blog_meta_description'];
		$contact_meta_title = $row['contact_meta_title'];
		$contact_meta_keyword = $row['contact_meta_keyword'];
		$contact_meta_description = $row['contact_meta_description'];
		$pgallery_meta_title = $row['pgallery_meta_title'];
		$pgallery_meta_keyword = $row['pgallery_meta_keyword'];
		$pgallery_meta_description = $row['pgallery_meta_description'];
		$vgallery_meta_title = $row['vgallery_meta_title'];
		$vgallery_meta_keyword = $row['vgallery_meta_keyword'];
		$vgallery_meta_description = $row['vgallery_meta_description'];
	}

	$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	
	if($cur_page == 'index.php' || $cur_page == 'login.php' || $cur_page == 'registration.php' || $cur_page == 'cart.php' || $cur_page == 'checkout.php' || $cur_page == 'forget-password.php' || $cur_page == 'reset-password.php' || $cur_page == 'product-category.php' || $cur_page == 'product.php') {
		?>
		<title><?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}

	if($cur_page == 'about.php') {
		?>
		<title><?php echo $about_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $about_meta_keyword; ?>">
		<meta name="description" content="<?php echo $about_meta_description; ?>">
		<?php
	}
	if($cur_page == 'faq.php') {
		?>
		<title><?php echo $faq_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $faq_meta_keyword; ?>">
		<meta name="description" content="<?php echo $faq_meta_description; ?>">
		<?php
	}
	if($cur_page == 'contact.php') {
		?>
		<title><?php echo $contact_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $contact_meta_keyword; ?>">
		<meta name="description" content="<?php echo $contact_meta_description; ?>">
		<?php
	}
	if($cur_page == 'product.php')
	{
		$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
		    $og_photo = $row['p_featured_photo'];
		    $og_title = $row['p_name'];
		    $og_slug = 'product.php?id='.$_REQUEST['id'];
			$og_description = substr(strip_tags($row['p_description']),0,200).'...';
		}
	}

	if($cur_page == 'dashboard.php') {
		?>
		<title>Dashboard - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	if($cur_page == 'customer-profile-update.php') {
		?>
		<title>Update Profile - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	if($cur_page == 'customer-billing-shipping-update.php') {
		?>
		<title>Update Billing and Shipping Info - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	if($cur_page == 'customer-password-update.php') {
		?>
		<title>Update Password - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	if($cur_page == 'customer-order.php') {
		?>
		<title>Orders - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	?>
	
	<?php if($cur_page == 'blog-single.php'): ?>
		<meta property="og:title" content="<?php echo $og_title; ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo BASE_URL.$og_slug; ?>">
		<meta property="og:description" content="<?php echo $og_description; ?>">
		<meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
	<?php endif; ?>

	<?php if($cur_page == 'product.php'): ?>
		<meta property="og:title" content="<?php echo $og_title; ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo BASE_URL.$og_slug; ?>">
		<meta property="og:description" content="<?php echo $og_description; ?>">
		<meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
	<?php endif; ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

	<!--<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>-->

  <script>
    // Dropdown Toggle JavaScript - Add this before closing </body> tag

document.addEventListener('DOMContentLoaded', function() {
    // Get all menu items with dropdowns
    const menuItems = document.querySelectorAll('.menu > ul > li');
    
    menuItems.forEach(function(item) {
        const link = item.querySelector('a');
        const submenu = item.querySelector('ul');
        
        if (submenu && link) {
            // Add click event listener for first level
            link.addEventListener('click', function(e) {
                // Only prevent default if this item has a dropdown
                if (submenu) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Close other open menus at the same level
                    menuItems.forEach(function(otherItem) {
                        if (otherItem !== item) {
                            otherItem.classList.remove('dropdown-active');
                            // Also close any open second level menus
                            const secondLevelItems = otherItem.querySelectorAll('li');
                            secondLevelItems.forEach(function(subItem) {
                                subItem.classList.remove('dropdown-active');
                            });
                        }
                    });
                    
                    // Toggle current menu
                    item.classList.toggle('dropdown-active');
                }
            });
            
            // Handle second level dropdowns
            const secondLevelItems = submenu.querySelectorAll('li');
            secondLevelItems.forEach(function(subItem) {
                const subLink = subItem.querySelector('a');
                const subSubmenu = subItem.querySelector('ul');
                
                if (subSubmenu && subLink) {
                    subLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Close other second level menus
                        secondLevelItems.forEach(function(otherSubItem) {
                            if (otherSubItem !== subItem) {
                                otherSubItem.classList.remove('dropdown-active');
                            }
                        });
                        
                        // Toggle current second level menu
                        subItem.classList.toggle('dropdown-active');
                    });
                }
            });
        }
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.menu')) {
            menuItems.forEach(function(item) {
                item.classList.remove('dropdown-active');
                const subItems = item.querySelectorAll('li');
                subItems.forEach(function(subItem) {
                    subItem.classList.remove('dropdown-active');
                });
            });
        }
    });
    
    // Close dropdowns when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            menuItems.forEach(function(item) {
                item.classList.remove('dropdown-active');
                const subItems = item.querySelectorAll('li');
                subItems.forEach(function(subItem) {
                    subItem.classList.remove('dropdown-active');
                });
            });
        }
    });
    
    // Mobile touch handling for better UX
    let touchStartY = 0;
    let touchStartX = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartY = e.touches[0].clientY;
        touchStartX = e.touches[0].clientX;
    });
    
    document.addEventListener('touchend', function(e) {
        const touchEndY = e.changedTouches[0].clientY;
        const touchEndX = e.changedTouches[0].clientX;
        const deltaY = Math.abs(touchEndY - touchStartY);
        const deltaX = Math.abs(touchEndX - touchStartX);
        
        // If it's a tap (minimal movement), process normally
        if (deltaY < 10 && deltaX < 10) {
            // Let the click events handle it
            return;
        }
        
        // If it's a scroll or swipe, close dropdowns
        if (deltaY > 50) {
            menuItems.forEach(function(item) {
                item.classList.remove('dropdown-active');
                const subItems = item.querySelectorAll('li');
                subItems.forEach(function(subItem) {
                    subItem.classList.remove('dropdown-active');
                });
            });
        }
    });
});
  </script>

<?php echo $before_head; ?>
<style>
	.top .left ul li {
	 font-family:"Roboto", sans-serif;
    list-style-type: none;
    float: left;
    margin-right: 14px;
    /* color: #0d1452; */
    color: white;
   
}
.menu > ul > li > ul {
   
   width:auto;
   
  
}
.slide-text > a.btn-primary {
    color: #ffffff;
    cursor: pointer;
    font-weight: 400;
    font-size: 13px;
    line-height: 15px;
    margin-left: 10px;
    text-align: center;
    padding: 17px 30px;
    white-space: nowrap;
    letter-spacing: 1px;
    background: black;
    display: inline-block;
    text-decoration: none;
    text-transform: uppercase;
    border: none;
    -webkit-animation-delay: 2s;
    animation-delay: 2s;
    -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
    transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
}
.log{
		position:relative;
		/* margin-bottom:35px; */
		margin-top: -21px;
		font-family:"Roboto", sans-serif";
	}
#getanestimate{
	position:relative;
	margin-top: 40px;
}
.featuredLinksBar {
    border-bottom: 1px solid #EEE;
    border-width: 1px 0;
    padding: 10px 0;
    color: rgba(84, 84, 84, 1.00);
}

.featuredLinksBar__content {
    margin: auto;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    max-width: 990px;
    min-width: 768px;
}
.featuredLinksBar_contact-links, .featuredLinksBar_linkContainer {
    font-family:"Roboto", sans-serif;
    line-height: 1;
    font-size: 14.7px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    margin: 0;
}
.featuredLinksBar_contact-links .featuredLinksBarcontact-link, .featuredLinksBarlinkContainer .featuredLinksBar_contact-link {
    margin: 0 10px;
}

/.featuredLinksBar_contact-links, .featuredLinksBar_linkContainer {/
/*    line-height: 1;*/
/*    font-size: 14.7px;*/
/*    display: -webkit-box;*/
/*    display: -webkit-flex;*/
/*    display: -ms-flexbox;*/
/*    display: flex;*/
/*    -webkit-box-align: center;*/
/*    -webkit-align-items: center;*/
/*    -ms-flex-align: center;*/
/*    align-items: center;*/
/*    margin: 0;*/
/}/
ol, ul {
    list-style: none;
}
.featuredLinksBar_contact-links .featuredLinksBarcontact-link, .featuredLinksBarlinkContainer .featuredLinksBar_contact-link {
    margin: 0 10px;
}
a {
    font-family:"Roboto", sans-serif;;
    color: black; 
    text-decoration: none;
	/* margin-bottom: 10px; */
}
.featuredLinksBar_contact-links .contact-channel, .featuredLinksBar_linkContainer .contact-channel {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}
#icon {
    position: relative;
    margin-left: -58px;
    background-color: white;
    border: none;
    color: black;
}
.log {
    position: relative;
    /* margin-bottom: 35px; */
    margin-top: 1px;
    font-family:"Roboto", sans-serif;
}
.menu-mobile:after {
    content: "\f067";
    /* font-family: "Roboto", sans-serif;"; */
    font-size: 2.5rem;
    padding: 0;
    float: right;
    color: black;
    position: relative;
    top: 50%;
    -webkit-transform: translateY(-25%);
    -ms-transform: translateY(-25%);
    transform: translateY(-25%);
}


.menu ul li a {
    text-decoration: none;
    position: relative;
    color: #333; /* Normal text color */
    padding-bottom: 5px; /* Adjust the space between text and underline */
}

.menu ul li a:hover {
    color: black; /* Text color on hover */
}

.menu ul li a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: black; /* Color of the underline */
    visibility: hidden;
    transition: all 0.3s ease-in-out;
}

.menu ul li a:hover::after {
    visibility: visible;
    width: 100%;
}
.header .right {
    float: none;
    display: table-cell;
    vertical-align: middle;
    padding-right: 0;
    font-family: 'Roboto', sans-serif;
}
.featuredLinksBar11 {
    border-bottom: 1px solid #EEE;
    border-width: 1px 0;
    padding: 10px 0;
	background-color:black;
    color:white;
    font-family: "Roboto", sans-serif;
}

.call-us-icon path {
  fill: white;
}

.email-icon path {
  fill: white;
}
header {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding: 10px;
  background-color: black;
}

.leftt {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  gap: 30px;
  color: white;
}

.rightt {
  display: flex;
  justify-content: flex-end;
  gap: 20px;
}

.ka {
  cursor: pointer;
  font-size: clamp(14px, 2vw, 16px); /* Responsive font size */
  padding: 1px 1px;
  color: #333;
  border-radius: 5px;
}

.ka:hover {
  background-color:;
}

/* Responsive Design */
@media (max-width: 500px) {
  header {
    flex-direction: row; /* Stacks left and right sections vertically */
    align-items: center; /* Centers items in the column layout */
  }

  .leftt,
  .rightt {
    flex-direction: row; /* Stacks each section's items vertically */
    align-items: center;
    gap: 10px; /* Reduces space between items */
  }


}
.head{
	background-color: black;
}



.sub-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding: 10px;
 
}

.left_sub {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  align-items: center;
  gap: 100px; /* Adjusted for even spacing */
  color: white;
}

.form-control.search-top {
  width: 800px; /* Sets a wider width */
  max-width: 100%; /* Ensures responsiveness */
}

/* Responsive Design */
/* @media (max-width: 768px) {
  .sub-container {
    flex-direction: row;
    align-items: center;
  }

  .left_sub {
    flex-direction: row;
    gap: 2px;
  }

  .form-control.search-top {
  width: clamp(150px, 50%, 70%); Automatically adjusts width
  max-width: 75.9%; Ensures it doesn't exceed the container
}

} */

/* Search Bar Styling - DESKTOP */
.form-control.search-top {
    width: 800px;
    max-width: 100%;
    padding: 8px 15px;
    padding-right: 45px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    font-size: 14px;
    background-color: #fff;
    height: 40px;
}

.form-control.search-top:focus {
    outline: none;
    border-color: #ccc;
    box-shadow: none;
}

/* Search Icon - BLACK COLOR */
#icon {
    position: relative;
    margin-left: -45px;
    background-color: transparent !important;
    background: none !important;
    border: none !important;
    color: #000 !important;
    cursor: pointer;
    padding: 8px 10px;
}

#icon:hover {
    color: #333 !important;
    background-color: transparent !important;
}

#icon .fas,
#icon .fa-search,
#icon i,
#icon .ll {
    color: #000 !important;
    font-size: 16px;
}

button#icon {
    background: none !important;
    background-color: transparent !important;
}

.btn-danger#icon {
    background: none !important;
    background-color: transparent !important;
    border: none !important;
    color: #000 !important;
}

/* Mobile Responsive Design - NO GAP BETWEEN BUTTONS */
@media (max-width: 768px) {
  /* Header section */
  header {
    flex-direction: row !important;
    align-items: center !important;
    padding: 5px 8px !important;
  }

  .leftt,
  .rightt {
    flex-direction: row !important;
    align-items: center !important;
    gap: 5px !important;
    font-size: 11px !important;
  }

  /* Sub-container - ROW LAYOUT */
  .sub-container {
    flex-direction: row !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 10px 8px !important;
    gap: 8px !important;
  }

  .left_sub {
    flex-direction: row !important;
    align-items: center !important;
    gap: 8px !important;
    width: 100% !important;
    flex-wrap: nowrap !important;
  }

  /* Logo - BIGGER SIZE */
  .left_sub > div:first-child {
    flex-shrink: 0 !important;
    order: 1;
  }

  .left_sub > div:first-child img.logo {
    height: 50px !important;
    width: auto !important;
    max-width: 120px !important;
  }

  /* Search bar container */
  .left_sub > div:nth-child(2) {
    flex: 0 1 auto !important;
    min-width: 0 !important;
    max-width: 200px !important;
    order: 2;
    position: relative !important;
  }

  .left_sub > div:nth-child(2) form {
    width: 100% !important;
    display: flex !important;
    align-items: center !important;
    position: relative !important;
    margin: 0 !important;
    padding: 0 !important;
  }

  .left_sub > div:nth-child(2) .form-group {
    width: 100% !important;
    margin: 0 !important;
    position: relative !important;
  }

  /* Search input */
  .form-control.search-top {
    width: 100% !important;
    max-width: 180px !important;
    padding: 8px 10px !important;
    padding-right: 10px !important;
    font-size: 12px !important;
    height: 36px !important;
    border: 1px solid #e0e0e0 !important;
    border-radius: 4px !important;
  }

  /* Search Icon - POSITIONED RIGHT AFTER PLACEHOLDER TEXT */
  #icon,
  button#icon,
  .btn-danger#icon {
    position: absolute !important;
    left: 120px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    margin: 0 !important;
    padding: 4px !important;
    background: none !important;
    background-color: transparent !important;
    border: none !important;
    color: #000 !important;
    z-index: 10 !important;
    width: auto !important;
    height: auto !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    pointer-events: none !important;
  }

  #icon:hover,
  button#icon:hover,
  .btn-danger#icon:hover {
    color: #333 !important;
    background: transparent !important;
    background-color: transparent !important;
  }

  #icon .fas,
  #icon .fa-search,
  #icon i,
  #icon .ll {
    color: #000 !important;
    font-size: 13px !important;
  }

  /* Get An Estimate & How It Works - NO GAP */
  .left_sub > div:last-child {
    display: flex !important;
    flex-direction: column !important;
    gap: 0px !important;
    flex-shrink: 0 !important;
    order: 3;
    align-items: flex-start !important;
    justify-content: center !important;
  }

  .left_sub > div:last-child a {
    font-size: 15px !important;
    padding: 4px 10px !important;
    white-space: nowrap !important;
    background: transparent !important;
    border: none !important;
    border-radius: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 7px !important;
    transition: all 0.3s ease !important;
    box-shadow: none !important;
    color: #000 !important;
    text-decoration: none !important;
    line-height: 1.3 !important;
    margin: 0 !important;
    font-weight: 600 !important;
  }

  .left_sub > div:last-child a:hover {
    background: transparent !important;
    color: #333 !important;
    text-decoration: underline !important;
  }

  .left_sub > div:last-child a i {
    font-size: 17px !important;
    margin-right: 0 !important;
    color: #000 !important;
  }

  /* Navigation Menu */
  .menu > ul {
    flex-direction: column !important;
    align-items: flex-start !important;
    width: 100% !important;
  }

  .menu > ul > li {
    margin-right: 0 !important;
    margin-bottom: 8px !important;
    width: 100% !important;
  }

  .menu > ul > li > ul {
    position: static !important;
    transform: none !important;
    left: auto !important;
    box-shadow: none !important;
    border: none !important;
    background: #f8f9fa !important;
    margin-left: 15px !important;
    min-width: auto !important;
  }
}

/* For smaller screens (less than 600px) */
@media (max-width: 600px) {
  .left_sub {
    gap: 6px !important;
  }

  /* Logo */
  .left_sub > div:first-child img.logo {
    height: 45px !important;
    max-width: 110px !important;
  }

  /* Search bar */
  .left_sub > div:nth-child(2) {
    max-width: 160px !important;
  }

  .form-control.search-top {
    max-width: 150px !important;
    font-size: 11px !important;
    padding: 7px 8px !important;
    padding-right: 8px !important;
    height: 32px !important;
  }

  /* Icon - NEAR PLACEHOLDER END */
  #icon,
  button#icon,
  .btn-danger#icon {
    position: absolute !important;
    left: 105px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    margin: 0 !important;
    padding: 3px !important;
    color: #000 !important;
    background: none !important;
    width: auto !important;
    height: auto !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    pointer-events: none !important;
  }

  #icon .fas,
  #icon .fa-search,
  #icon i,
  #icon .ll {
    font-size: 12px !important;
  }

  /* Buttons - NO GAP */
  .left_sub > div:last-child {
    gap: 0px !important;
  }

  .left_sub > div:last-child a {
    font-size: 14px !important;
    padding: 3px 8px !important;
    gap: 6px !important;
    background: transparent !important;
    border: none !important;
    line-height: 1.3 !important;
    font-weight: 600 !important;
  }

  .left_sub > div:last-child a:hover {
    background: transparent !important;
    text-decoration: underline !important;
  }

  .left_sub > div:last-child a i {
    font-size: 15px !important;
  }
}

/* For very small screens (less than 480px) */
@media (max-width: 480px) {
  .sub-container {
    padding: 8px 5px !important;
    gap: 5px !important;
  }

  .left_sub {
    gap: 5px !important;
  }

  /* Logo */
  .left_sub > div:first-child img.logo {
    height: 40px !important;
    max-width: 95px !important;
  }

  /* Search bar */
  .left_sub > div:nth-child(2) {
    max-width: 130px !important;
  }

  .form-control.search-top {
    max-width: 120px !important;
    font-size: 10px !important;
    padding: 6px 8px !important;
    padding-right: 8px !important;
    height: 28px !important;
  }

  /* Icon - NEAR PLACEHOLDER END */
  #icon,
  button#icon,
  .btn-danger#icon {
    position: absolute !important;
    left: 90px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    margin: 0 !important;
    padding: 3px !important;
    color: #000 !important;
    background: none !important;
    width: auto !important;
    height: auto !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    pointer-events: none !important;
  }

  #icon .fas,
  #icon .fa-search,
  #icon i,
  #icon .ll {
    font-size: 11px !important;
  }

  /* Buttons - NO GAP */
  .left_sub > div:last-child {
    gap: 0px !important;
  }

  .left_sub > div:last-child a {
    font-size: 13px !important;
    padding: 3px 6px !important;
    gap: 5px !important;
    background: transparent !important;
    border: none !important;
    line-height: 1.2 !important;
    font-weight: 600 !important;
  }

  .left_sub > div:last-child a:hover {
    background: transparent !important;
    text-decoration: underline !important;
  }

  .left_sub > div:last-child a i {
    font-size: 14px !important;
  }

  header {
    padding: 4px 5px !important;
  }

  .leftt, .rightt {
    font-size: 10px !important;
    gap: 3px !important;
  }
}



/* Mobile only - Spacing between header sections */
@media (max-width: 768px) {
  .container-fluid.head,
  .head {
    margin-bottom: 15px !important;
    padding-bottom: 10px !important;
  }

  .sub-container {
    margin-top: 10px !important;
  }
}


li {
  list-style-type: none;
}

/* Add this CSS to your existing styles to center the dropdown menus */

.menu > ul > li {
    position: relative;
    display: inline-block;
}

.menu > ul > li > ul {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    width: auto;
    min-width: 200px;
    background: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border: 1px solid #ddd;
    z-index: 1000;
    display: none;
}

.menu > ul > li:hover > ul {
    display: block;
}

.menu > ul > li > ul > li {
    position: relative;
    display: block;
    width: 100%;
}

.menu > ul > li > ul > li > ul {
    position: absolute;
    top: 0;
    left: 100%;
    transform: none;
    width: auto;
    min-width: 200px;
    background: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border: 1px solid #ddd;
    z-index: 1001;
    display: none;
}

.menu > ul > li > ul > li:hover > ul {
    display: block;
}

/* Style the menu items */
.menu ul li a {
    text-decoration: none;
    position: relative;
    color: #333;
    padding: 10px 15px;
    display: block;
    white-space: nowrap;
}

.menu ul li a:hover {
    color: black;
    background-color: #f5f5f5;
}

/* Remove the existing underline effect for dropdown items */
.menu > ul > li > ul li a::after,
.menu > ul > li > ul > li > ul li a::after {
    display: none;
}

/* Keep the underline effect only for top-level menu items */
.menu > ul > li > a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: black;
    visibility: hidden;
    transition: all 0.3s ease-in-out;
}

.menu > ul > li > a:hover::after {
    visibility: visible;
    width: 100%;
}

.menu > ul > li {
    position: relative !important;
    display: inline-block !important;
    vertical-align: top !important;
}

.menu > ul > li > ul {
    position: absolute !important;
    top: 100% !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    width: auto !important;
    min-width: 250px !important;
    max-width: 400px !important;
    background: white !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    border: 1px solid #ddd !important;
    border-radius: 4px !important;
    z-index: 1000 !important;
    display: none !important;
    padding: 8px 0 !important;
    margin: 0 !important;
    opacity: 0 !important;
    visibility: hidden !important;
    transition: all 0.3s ease !important;
}

/* Toggle functionality - show dropdown when active or hover */
.menu > ul > li.dropdown-active > ul,
.menu > ul > li:hover > ul {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

.menu > ul > li > ul > li {
    position: relative !important;
    display: block !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}

.menu > ul > li > ul > li > ul {
    position: absolute !important;
    top: 0 !important;
    left: 100% !important;
    transform: none !important;
    width: auto !important;
    min-width: 250px !important;
    max-width: 400px !important;
    background: white !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    border: 1px solid #ddd !important;
    border-radius: 4px !important;
    z-index: 1001 !important;
    display: none !important;
    padding: 8px 0 !important;
    margin: 0 !important;
    margin-left: -8px !important;
    opacity: 0 !important;
    visibility: hidden !important;
    transition: all 0.3s ease !important;
}

/* Second level toggle functionality */
.menu > ul > li > ul > li.dropdown-active > ul,
.menu > ul > li > ul > li:hover > ul {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

/* Enhanced menu item styling */
.menu ul li a {
    text-decoration: none !important;
    position: relative !important;
    color: #333 !important;
    padding: 12px 20px !important;
    display: block !important;
    white-space: nowrap !important;
    font-weight: normal !important;
    font-size: 14px !important;
    line-height: 1.4 !important;
    border-bottom: 1px solid transparent !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
}

.menu ul li a:hover {
    color: black !important;
    background-color: #f8f9fa !important;
    padding-left: 24px !important;
}

/* Active state for toggled items */
.menu > ul > li.dropdown-active > a {
    background-color: #e9ecef !important;
    color: black !important;
}

.menu > ul > li > ul > li.dropdown-active > a {
    background-color: #f8f9fa !important;
    color: black !important;
    padding-left: 24px !important;
}

/* Dropdown indicators */
.menu > ul > li:has(ul) > a::before {
    content: '\25BC' !important;
    font-size: 10px !important;
    margin-right: 8px !important;
    transition: transform 0.3s ease !important;
    display: inline-block !important;
}

.menu > ul > li.dropdown-active:has(ul) > a::before {
    transform: rotate(180deg) !important;
}

.menu > ul > li > ul > li:has(ul) > a::after {
    content: '\25B6' !important;
    font-size: 8px !important;
    float: right !important;
    margin-top: 2px !important;
    transition: transform 0.3s ease !important;
}

.menu > ul > li > ul > li.dropdown-active:has(ul) > a::after {
    transform: rotate(90deg) !important;
}

/* Remove the existing underline effect for ALL dropdown items */
.menu > ul > li > ul li a::after,
.menu > ul > li > ul > li > ul li a::after {
    display: none !important;
}

/* Keep the underline effect ONLY for top-level menu items */
.menu > ul > li > a {
    padding-bottom: 5px !important;
}

.menu > ul > li > a::after {
    content: '' !important;
    position: absolute !important;
    width: 0 !important;
    height: 2px !important;
    bottom: 0 !important;
    left: 0 !important;
    background-color: black !important;
    visibility: hidden !important;
    transition: all 0.3s ease-in-out !important;
}

.menu > ul > li > a:hover::after {
    visibility: visible !important;
    width: 100% !important;
}

/* Ensure proper spacing and prevent layout conflicts */
.menu > ul {
    /* display: flex !important; */
    align-items: center !important;
    flex-wrap: nowrap !important;
    margin: 0 !important;
    padding: 0 !important;
}

.menu > ul > li {
    margin-right: 30px !important;
}

.menu > ul > li:last-child {
    margin-right: 0 !important;
}

/* Prevent dropdown from being cut off on right side */
.menu > ul > li:nth-last-child(-n+3) > ul {
    left: auto !important;
    right: 0 !important;
    transform: none !important;
}

.menu > ul > li:nth-last-child(-n+3) > ul > li > ul {
    left: auto !important;
    right: 100% !important;
    margin-left: 0 !important;
    margin-right: -8px !important;
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .menu > ul {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
    
    .menu > ul > li {
        margin-right: 0 !important;
        margin-bottom: 10px !important;
        width: 100% !important;
    }
    
    .menu > ul > li > ul {
        position: static !important;
        transform: none !important;
        left: auto !important;
        box-shadow: none !important;
        border: none !important;
        background: #f8f9fa !important;
        margin-left: 20px !important;
        min-width: auto !important;
    }
    
    .menu > ul > li > ul > li > ul {
        position: static !important;
        left: auto !important;
        margin-left: 40px !important;
        box-shadow: none !important;
        border: none !important;
    }
}

@media (min-width: 769px) {
    .form-control.search-top {
        padding-right: 42px !important;
    }
    .search-icon-btn#icon {
        position: absolute !important;
        right: 24px !important; /* move icon slightly left from the edge */
        top: 50% !important;
        transform: translateY(-50%) !important;
        padding: 0 !important;
        border: none !important;
        background: transparent !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 2 !important;
    }
    .search-icon-btn#icon .fas,
    .search-icon-btn#icon .ll {
        color: #222 !important;
        font-size: 20px !important;
    }
    .search-icon-btn#icon:hover,
    .search-icon-btn#icon:focus {
        background: transparent !important;
        box-shadow: none !important;
    }
}


/* ravi */



</style>

	
</head>
<body>

<?php echo $after_body; ?>


<!-- top bar -->
<div class="container-fluid head">
 <header>
	
	<div class="leftt">
	<!-- <div><i class="fa fa-phone"></i> <?php //echo $contact_phone; ?></div>
	<div><i class="fa fa-envelope-o"></i> <?php //echo $contact_email; ?></div> -->
	<?php
					if(isset($_SESSION['customer'])) {
						?>
						
						<li><i class="fa fa-user "></i> <?php echo LANG_VALUE_13; ?> <?php echo $_SESSION['customer']['cust_name']; ?></li>
						<li><a href="dashboard.php"><i class="fa fa-home"></i> <?php echo LANG_VALUE_89; ?></a></li>
						<?php
					} else {
						?>
						<li><a href="login.php" style="color: white; padding: 10px;"><i class="fa fa-sign-in"></i> <?php echo LANG_VALUE_9; ?></a></li>
						
						<?php	
					}
					?>
	</div>
	<div class="rightt">
	<!-- <div class="ka"><a class="inherit contact-channel" href="/help">
							<span class="contact-channel-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="call-us-icon">
  <path fill="white" fill-rule="evenodd" d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"></path>
</svg>

							</span>
						</a></div> -->
	<div class="ka"><a class="inherit contact-channel" href="/orders">
							<span class="contact-channel-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 24 24" class="email-icon">
  <path fill="white" fill-rule="evenodd" d="M6.54 6.8C5.7 6.8 5.02 6.15 5 5.32c-.02-.83.63-1.5 1.46-1.54.83-.03 1.52.62 1.54 1.45v.04c0 .8-.65 1.47-1.46 1.5zm0-4C5.16 2.76 4.02 3.86 4 5.24c-.02 1.4 1.08 2.53 2.46 2.56C7.84 7.8 8.98 6.7 9 5.32V5.3c0-1.37-1.1-2.5-2.46-2.5zM23 21h-1.4c-.3-1.35-1.6-2.22-2.96-1.95-.98.2-1.75.97-1.95 1.95h-1.43v-8.55h2.3c3.07.1 5.5 2.66 5.42 5.74V21zm-2.42.68c-.02.1-.04.22-.08.32-.2.6-.77 1-1.4 1-.64 0-1.2-.4-1.42-1-.04-.1-.07-.2-.08-.3v-.2c0-.17.03-.34.1-.5.26-.78 1.1-1.2 1.88-.93.44.15.78.5.93.93.08.16.1.33.1.5.05.07.04.13.04.18h-.05zM14.24 21H7c-.26-1.35-1.57-2.23-2.92-1.97-1 .2-1.78.97-1.97 1.97H1v-9.88h2.8l.13.18.23.3c.62.78 1.3 1.53 2 2.23.04.05.1.08.16.1.1.05.25.05.36 0 .06-.02.12-.05.17-.1.72-.7 1.4-1.44 2-2.23.1-.1.18-.2.26-.33l.14-.15h5V21zM6 21.5c.03.17.03.34 0 .5-.22.6-.78 1-1.4 1-.64 0-1.2-.4-1.4-1-.1-.17-.17-.35-.2-.55.02-.16.06-.3.14-.45.2-.6.77-1 1.4-1 .66-.02 1.25.4 1.46 1 .05.15.08.3.1.45l-.1.05zM2.2 6.13c-.32-1.2-.06-2.46.7-3.43C3.77 1.6 5.12.95 6.53 1c1.43-.04 2.8.6 3.66 1.74.73.96 1 2.22.7 3.4-.54 1.52-1.3 2.94-2.3 4.2l-.14.16-.13.17-.23.33c-.48.63-1 1.23-1.57 1.8-.35-.37-1-1-1.6-1.8l-.2-.28c-.07-.07-.13-.14-.18-.22l-.1-.16c-1-1.25-1.77-2.68-2.25-4.2zm15.37 5.32H15.3v-.83c0-.27-.23-.5-.5-.5H10c.8-1.13 1.44-2.38 1.87-3.7.4-1.5.07-3.07-.87-4.28C9.94.76 8.28-.04 6.53 0 4.8-.05 3.16.73 2.1 2.1 1.16 3.33.84 4.92 1.23 6.4c.42 1.34 1.04 2.6 1.84 3.72H.5c-.28 0-.5.23-.5.5V21.5c0 .28.22.5.5.5h1.6c.27 1.36 1.6 2.23 2.95 1.96C6.03 23.76 6.8 23 7 22h9.7c.27 1.36 1.58 2.23 2.94 1.96.98-.2 1.75-.97 1.95-1.96h1.9c.27 0 .5-.22.5-.5v-3.3c.07-3.64-2.8-6.65-6.44-6.75zm-2.3 1V21v-8.55z"></path>
</svg>

							</span>
							<!-- Track Order -->
						</a></div>
	<div class="ka"></div>
					<div class="">
					<a href="cart.php" style="color: white; padding: 10px;"><i class="fa fa-shopping-cart"></i> <?php echo LANG_VALUE_18; ?> (<?php //echo LANG_VALUE_1; ?>₹<?php
					if(isset($_SESSION['cart_p_id'])) {
						$table_total_price = 0;
						$i=0;
	                    foreach($_SESSION['cart_p_qty'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_qty[$i] = $value;
	                    }                    $i=0;
	                    foreach($_SESSION['cart_p_current_price'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_current_price[$i] = $value;
	                    }
	                    for($i=1;$i<=count($arr_cart_p_qty);$i++) {
	                    	$row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
	                        $table_total_price = $table_total_price + $row_total_price;
	                    }
						echo $table_total_price;
					} else {
						echo '0.00';
					}
					?>)</a>

					</div>

	</div>
 </header>
 </div>
<div class="sub-container">
	<div class="left_sub">
	<div><a href="index.php"><img src="assets/uploads/<?php echo $logo; ?>" alt="logo image" class="logo" height="50" width="100"></a></div>
	<div>
<form class="navbar-form navbar-left" role="search" action="search-result.php" method="get" style="position:relative; display: flex; align-items: center;">
    <?php $csrf->echoInputField(); ?>
    <div class="form-group" style="width:100%; display: flex; align-items: center; position:relative;">
        <input type="text" class="form-control search-top" placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text" style="padding-right:48px;">
        <button type="submit" class="btn btn-danger search-icon-btn"
                id="icon"
                style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); padding: 6px 10px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #dc3545; border:none; z-index:2;">
            <i class="fas fa-search ll" style="font-size: 18px; color: #fff;"></i>
        </button>
    </div>
</form>
</div>

	<div>
  <a href="getanestimate.php" style="color: black; text-decoration: none; display: block; font-size: 14px;">
    <i class="fa fa-calculator" style="margin-right: 0px; font-size: 18px;"></i> Get An Estimate
  </a>
  <a href="how-it-works.php" style="color: black; text-decoration: none; display: block; font-size: 14px;">
    <i class="fa fa-info-circle" style="margin-right: 0px; font-size: 18px;"></i> How It Works
  </a>
</div>

	</div>
	<div class="right_sub"></div>
</div>
 </div>
<div class="nav">
	<div class="container-fluid ">
		<div class="row">
			<div class="col-md-12 pl_0 pr_0">
				<div class="menu-container">
					<div class="menu">
<ul style="list-style: none; padding: 0; margin: 0;">
  <li style="font-size: 16px; font-weight: bold;"><a href="index.php" class="topcategory_names" style="text-decoration: none; color: #000;">Home</a></li>

  <?php
  $statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
  ?>
    <li style="font-size: 16px; font-weight: bold;">
      <a href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category" style="text-decoration: none; color: #000;"><?php echo $row['tcat_name']; ?></a>
      <ul style="list-style: none; padding: 0; margin: 0; padding-left: 15px;">
        <?php
        $statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
        $statement1->execute(array($row['tcat_id']));
        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result1 as $row1) {
        ?>
          <li style="font-size: 16px; font-weight: bold;">
            <a href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category" style="text-decoration: none; color: #000;"><?php echo $row1['mcat_name']; ?></a>
            <ul style="list-style: none; padding: 0; margin: 0; padding-left: 15px;">
              <?php
              $statement2 = $pdo->prepare("SELECT * FROM tbl_end_category WHERE mcat_id=?");
              $statement2->execute(array($row1['mcat_id']));
              $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
              foreach ($result2 as $row2) {
              ?>
                <li style="font-size: 16px; font-weight: bold;">
                  <a href="product-category.php?id=<?php echo $row2['ecat_id']; ?>&type=end-category" style="text-decoration: none; color: #000;"><?php echo $row2['ecat_name']; ?></a>
                </li>
              <?php
              }
              ?>
            </ul>
          </li>
        <?php
        }
        ?>
      </ul>
    </li>
  <?php
  }
  ?>

  <?php
  $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);		
  foreach ($result as $row) {
    $about_title = $row['about_title'];
    $faq_title = $row['faq_title'];
    $contact_title = $row['contact_title'];
  }
  ?>

  <li style="font-size: 16px; font-weight: bold;"><a href="about.php" style="text-decoration: none; color: #000;"><?php echo $about_title; ?></a></li>
  <li style="font-size: 16px; font-weight: bold;"><a href="faq.php" style="text-decoration: none; color: #000;"><?php echo $faq_title; ?></a></li>
  <li style="font-size: 16px; font-weight: bold;"><a href="contact.php" style="text-decoration: none; color: #000;"><?php echo $contact_title; ?></a></li>
  <li style="font-size: 16px; font-weight: bold;"><a href="refer-a-friend.php" style="text-decoration: none; color: #000;"><?php //echo $contact_title; ?>Refer a friend</a></li>

</ul>
					</div>  
				</div>
			</div>
		</div>
	</div>
</div>