<?php require APPROOT.'/views/inc/header.php' ?>

<div class="jumbotron jumbotron-fluid text-center">
  <div class="container">
    <h1><?php echo SITENAME ?></h1>
    <p class="lead">
      <?php echo $data['desc'] ?>
    </p>
    <a href="<?php echo URLROOT ?>/pages/about" class="btn btn-dark">Learn More</a>
    <a href="<?php echo URLROOT ?>/users/login" class="btn btn-dark">Login</a>
  </div>
</div>

<?php require APPROOT.'/views/inc/footer.php' ?>