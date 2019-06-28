<?php require APPROOT.'/views/inc/header.php' ?>
<a href="<?php echo URLROOT?>/posts" class="btn btn-dark mb-2"> < go home</a>
<h4>User Name: <?php echo $data['user_name']?> </h4>
<h4>Contact Email: <?php echo $data['user_email']?> </h4>
<h4>Number of posts: <?php echo $data['user_post_num'] ?> </h4>
<?php require APPROOT.'/views/inc/footer.php' ?>