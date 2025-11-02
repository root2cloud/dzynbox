<style>
    .home-newsletterr{
        padding: 80px 0;
        background: white;
    }
    .home-newsletterrr{
        padding: 25px 0;
        background: rgba(245, 245, 245, 1.00);
        color:black;
    }
    .footerbottom{
        width: 100%;
        height: auto;
        background: black;
        text-align: center;
        padding: 14px 0;
        color:white;
    }
    .footer_bottom{
        color:aliceblue;
        text-align: center;
    }

    li.footer_images a {
        font-family: "Roboto", sans-serif;
        font-weight:300;
        color: black;
        text-decoration: none;
    }
    
    li.footer_images a:hover {
        color: #007bff;
        text-decoration: underline;
    }
    
    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    
    /* Desktop Footer Styles */
    .home-newsletterrr h3 {
        color: black;
        font-family: "Roboto", sans-serif;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .home-newsletterrr ul li {
        color: black;
        font-family: "Roboto", sans-serif;
        font-size: 14px;
        line-height: 1.8;
    }
    
    .home-newsletterrr .logo {
        margin-bottom: 20px;
    }
    
    .roww {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .social-list {
        display: flex;
        flex-direction: row;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .social-list li {
        margin: 0 10px;
    }

    .social-list .fa {
        font-size: 24px;
        color: #333;
        transition: color 0.3s;
    }

    .social-list .fa:hover {
        color: #007bff;
    }
    
    .footerbottom .copyright {
        font-family: "Roboto", sans-serif;
        font-size: 14px;
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
    <div class="container">
        <div class="row footer_bottom">
            <div class="col-md-3">
                <div>
                    <img src="assets/uploads/<?php echo $logo; ?>" alt="logo image" class="logo" height="100" width="200">
                </div>
                <div class="roww">
                    <ul class="social-list">
                        <?php
                        $statement = $pdo->prepare("SELECT * FROM tbl_social");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            if($row['social_url'] != '') {
                                ?>
                                <li class="social_images">
                                    <a href="<?php echo $row['social_url']; ?>" target="_blank">
                                        <i class="fa <?php echo $row['social_icon']; ?>"></i>
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
                <h3>ACCOUNT</h3>
                <ul>
                    <li class="footer_images"><a href="customer-profile-update.php">My Account</a></li><br>
                    <li class="footer_images"><a href="whistlist.php">My Wishlist</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h3>INFORMATION</h3>
                <ul>
                    <li class="footer_images"><a href="about.php">About us</a></li><br>
                    <li class="footer_images"><a href="dzynboxcashpoints.php">Dzynbox Cash Points</a></li><br>
                    <li class="footer_images"><a href="return_canculation.php">Returns&Cancellation</a></li><br>
                    <!-- <li class="footer_images"><a href="partnerwithdzynbox.php">Partner with Dzynbox</a></li><br>
                    <li class="footer_images"><a href="joinus.php">Join Us</a></li><br> -->
                    <li class="footer_images"><a href="contact.php"><?php echo $contact_title; ?></a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h3>CONTACT US</h3>
                <ul>
                    <li><i class="fa fa-phone"></i> 9030902090</li><br>
                    <li><i class="fa fa-envelope-o"></i> dzynbox@gmail.com</li><br>
                    <li><i class="fa fa-map-marker"></i> Address : - <br><br>
                        No 14 & 15 , Radiance drive inn, Radial Road, Tellapur<br>
                        Ramachandrapuram, Medak<br>
                        Hyderabad- 502032<br>
                        Telangana<br>
                        India
                    </li>
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
    <div class="container">
        <div class="row">
            <div class="col-md-12 copyright">
                All Rights Reserved by dzynbox
            </div>
        </div>
    </div>
</div>

<a href="#" class="scrollup">
    <i class="fa fa-angle-up"></i>
</a>

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
        $("#msg-container").hide();
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
            $("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
            $("#msg-container").show();
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
