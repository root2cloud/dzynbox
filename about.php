<?php require_once('header.php'); ?>
<style>
    .page-banner h1 {
    color: rgba(15, 15, 15, 1.00);
    font-family: "Roboto", sans-serif;
    text-align: center;
    z-index: 999;
    position: relative;
}
</style>
<?php


$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
   $about_title = $row['about_title'];
    $about_content = $row['about_content'];
    $about_banner = $row['about_banner'];
}
?>

<div class="page-banner" style="background-color:rgba(245, 245, 245, 1.00);">
    <div class="inner">
        <h1><?php echo $about_title; ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">            
            <div class="col-md-12">
                
                <p>
                    <?php echo $about_content; ?>
                </p>

            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>