<style>
    .home-newsletterr{
        padding: 80px 0;
        background: white;
    }
    
    .home-newsletterrr{
        padding: 60px 0;
        background: #f8f9fa;
        color: #333;
    }
    
    .footerbottom{
        width: 100%;
        height: auto;
        background: #2c3e50;
        text-align: center;
        padding: 12px 0;
        color: white;
    }
    
    .footer_bottom{
        color: #000;
        text-align: left;
    }

    .home-newsletterrr h3 {
        color: #000;
        font-family: "Roboto", sans-serif;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }
    
    .home-newsletterrr ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .home-newsletterrr ul li {
        color: #000;
        font-family: "Roboto", sans-serif;
        font-size: 13px;
        line-height: 2;
        margin-bottom: 5px;
    }

    li.footer_images a {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        color: #000;
        text-decoration: none;
        font-size: 13px;
        transition: all 0.3s ease;
    }
    
    li.footer_images a:hover {
        color: #007bff;
        font-weight: 600;
    }
    
    .home-newsletterrr .logo {
        margin-bottom: 20px;
        max-width: 200px;
        height: auto;
        display: block;
    }

    .home-newsletterrr .logo img {
        width: 100%;
        height: auto;
    }
    
    .roww {
        display: flex;
        justify-content: flex-start;
        margin: 20px 0;
    }

    .social-list {
        display: flex;
        flex-direction: row;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 15px;
    }

    .social-list li {
        margin: 0;
    }

    .social-list a {
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.3s ease !important;
        background: none !important;
        width: auto !important;
        height: auto !important;
        border-radius: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        box-shadow: none !important;
    }

    .social-list a i {
        font-size: 22px !important;
        transition: all 0.3s ease !important;
    }

    /* Facebook - Blue */
    .social-list a i.fa-facebook-f {
        color: #1877f2 !important;
    }
    .social-list a:hover i.fa-facebook-f {
        transform: translateY(-3px);
    }

    /* Instagram - Gradient Pink/Orange */
    .social-list a i.fa-instagram {
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .social-list a:hover i.fa-instagram {
        transform: translateY(-3px);
    }

    /* Twitter/X - Black */
    .social-list a i.fa-twitter,
    .social-list a i.fa-x-twitter {
        color: #000000 !important;
    }
    .social-list a:hover i.fa-twitter,
    .social-list a:hover i.fa-x-twitter {
        transform: translateY(-3px);
    }

    /* YouTube - Red */
    .social-list a i.fa-youtube {
        color: #ff0000 !important;
    }
    .social-list a:hover i.fa-youtube {
        transform: translateY(-3px);
    }

    /* LinkedIn - Blue */
    .social-list a i.fa-linkedin-in {
        color: #0a66c2 !important;
    }
    .social-list a:hover i.fa-linkedin-in {
        transform: translateY(-3px);
    }

    /* WhatsApp - Green */
    .social-list a i.fa-whatsapp {
        color: #25d366 !important;
    }
    .social-list a:hover i.fa-whatsapp {
        transform: translateY(-3px);
    }
    
    /* Contact icons - BLACK */
    .home-newsletterrr li i {
        color: #000 !important;
        margin-right: 8px;
        min-width: 14px;
    }

    .home-newsletterrr li a {
        color: #000;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .home-newsletterrr li a:hover {
        color: #3f20a4ff;
    }

    .home-newsletterrr li span {
        color: #000;
    }
    
    .footerbottom {
        border-top: 2px solid #e0e0e0;
    }

    .footerbottom .copyright {
        font-family: "Roboto", sans-serif;
        font-size: 12px;
        color: #ccc;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .home-newsletterrr {
            padding: 40px 0;
        }

        .home-newsletterrr h3 {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .social-list {
            gap: 12px;
        }

        .social-list a i {
            font-size: 20px !important;
        }

        .col-md-3 {
            margin-bottom: 30px;
        }
    }
</style>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $footer_about = $row['footer_about'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
    $contact_address = $row['contact_address'];
    $footer_copyright = $row['footer_copyright'];
    $total_recent_post_footer = $row['total_recent_post_footer'];
    $total_popular_post_footer = $row['total_popular_post_footer'];
    $newsletter_on_off = $row['newsletter_on_off'];
    $before_body = $row['before_body'];
}
?>

<?php if($newsletter_on_off == 1): ?>
<section class="home-newsletterrr">
    <div class="container-fluid" style="padding-left: 40px; padding-right: 40px;">  
            <div class="row footer_bottom">
            <div class="col-md-3" style="text-align: center;">
                <div style="text-align: center;">
                    <img src="assets/uploads/<?php echo $logo; ?>" alt="logo image" class="logo">
                </div>
                <div class="roww">
                    <ul class="social-list">
                        <?php
                        $statement = $pdo->prepare("SELECT * FROM tbl_social");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            if($row['social_url'] != '') {
                                $icon_class = str_replace('fa ', 'fa-', $row['social_icon']);
                                ?>
                                <li class="social_images">
                                    <a href="<?php echo $row['social_url']; ?>" target="_blank" title="Follow us">
                                        <i class="fab <?php echo $icon_class; ?>"></i>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-3">
                <h3>Account</h3>
                <ul>
                    <li class="footer_images"><a href="customer-profile-update.php">My Account</a></li>
                    <li class="footer_images"><a href="whistlist.php">My Wishlist</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h3>Information</h3>
                <ul>
                    <li class="footer_images"><a href="about.php">About us</a></li>
                    <li class="footer_images"><a href="dzynboxcashpoints.php">Dzynbox Cash Points</a></li>
                    <li class="footer_images"><a href="return_canculation.php">Returns & Cancellation</a></li>
                    <li class="footer_images"><a href="contact.php"><?php echo $contact_title; ?></a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="fa fa-phone"></i> <a href="tel:9030902090">9030902090</a></li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto:dzynbox@gmail.com">hello@dzynbox.com</a></li>
                    <li><i class="fa fa-map-marker"></i> <span>No 14 & 15, Radiance drive inn, Radial Road,<br> Tellapur Ramachandrapuram, Medak Hyderabad -<br> 502032 Telangana, India</span></li>
                </ul>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="single">
                    <?php
                    if(isset($_POST['form_subscribe']))
                    {
                        if(empty($_POST['email_subscribe'])) 
                        {
                            $valid = 0;
                            $error_message1 .= LANG_VALUE_131;
                        }
                        else
                        {
                            if (filter_var($_POST['email_subscribe'], FILTER_VALIDATE_EMAIL) === false)
                            {
                                $valid = 0;
                                $error_message1 .= LANG_VALUE_134;
                            }
                            else
                            {
                                $statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_email=?");
                                $statement->execute(array($_POST['email_subscribe']));
                                $total = $statement->rowCount();                            
                                if($total)
                                {
                                    $valid = 0;
                                    $error_message1 .= LANG_VALUE_147;
                                }
                                else
                                {
                                    $key = md5(uniqid(rand(), true));
                                    $current_date = date('Y-m-d');
                                    $current_date_time = date('Y-m-d H:i:s');
                                    
                                    $statement = $pdo->prepare("INSERT INTO tbl_subscriber (subs_email,subs_date,subs_date_time,subs_hash,subs_active) VALUES (?,?,?,?,?)");
                                    $statement->execute(array($_POST['email_subscribe'],$current_date,$current_date_time,$key,0));
                                    
                                    $to = $_POST['email_subscribe'];
                                    $subject = 'Subscriber Email Confirmation';
                                    $verification_url = BASE_URL.'verify.php?email='.$to.'&key='.$key;
                                    
                                    $message = 'Thanks for your interest to subscribe our newsletter!<br><br>Please click this link to confirm your subscription: '.$verification_url.'<br><br>This link will be active only for 24 hours.';
                                    
                                    $headers = 'From: ' . $contact_email . "\r\n" .
                                           'Reply-To: ' . $contact_email . "\r\n" .
                                           'X-Mailer: PHP/' . phpversion() . "\r\n" . 
                                           "MIME-Version: 1.0\r\n" . 
                                           "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                    
                                    mail($to, $subject, $message, $headers);
                                    $success_message1 = LANG_VALUE_136;
                                }
                            }
                        }
                    }
                    if($error_message1 != '') {
                        echo "<script>alert('".$error_message1."')</script>";
                    }
                    if($success_message1 != '') {
                        echo "<script>alert('".$success_message1."')</script>";
                    }
                    ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<div class="footerbottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 copyright">
                All Rights Reserved By Dzynbox
            </div>
        </div>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $stripe_public_key = $row['stripe_public_key'];
    $stripe_secret_key = $row['stripe_secret_key'];
}
?>

<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="assets/js/megamenu.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/owl.animate.js"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/rating.js"></script>
<script src="assets/js/jquery.touchSwipe.min.js"></script>
<script src="assets/js/bootstrap-touch-slider.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
    function confirmDelete()
    {
        return confirm("Sure you want to delete this data?");
    }

    $(document).ready(function () {
        advFieldsStatus = $('#advFieldsStatus').val();
        $('#paypal_form').hide();
        $('#stripe_form').hide();
        $('#bank_form').hide();

        $('#advFieldsStatus').on('change',function() {
            advFieldsStatus = $('#advFieldsStatus').val();
            if ( advFieldsStatus == '' ) {
                $('#paypal_form').hide();
                $('#stripe_form').hide();
                $('#bank_form').hide();
            } else if ( advFieldsStatus == 'PayPal' ) {
                $('#paypal_form').show();
                $('#stripe_form').hide();
                $('#bank_form').hide();
            } else if ( advFieldsStatus == 'Stripe' ) {
                $('#paypal_form').hide();
                $('#stripe_form').show();
                $('#bank_form').hide();
            } else if ( advFieldsStatus == 'Bank Deposit' ) {
                $('#paypal_form').hide();
                $('#stripe_form').hide();
                $('#bank_form').show();
            }
        });
    });

    $(document).on('submit', '#stripe_form', function () {
        $('#submit-button').prop("disabled", true);
        $("#msg-container-fluid").hide();
        Stripe.card.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
        return false;
    });
    Stripe.setPublishableKey('<?php echo $stripe_public_key; ?>');
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#submit-button').prop("disabled", false);
            $("#msg-container-fluid").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
            $("#msg-container-fluid").show();
        } else {
            var form$ = $("#stripe_form");
            var token = response['id'];
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            form$.get(0).submit();
        }
    }
</script>
<?php echo $before_body; ?>
</body>
</html>
