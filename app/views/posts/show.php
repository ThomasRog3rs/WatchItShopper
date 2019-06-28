<?php require APPROOT.'/views/inc/header.php' ?>
<div class="row">
  <div class="col-md-12 mx-auto">
  <a href="<?php echo URLROOT?>/posts" class="btn btn-dark"> < go back</a>
  <br>

  <h1><?php echo $data["post"]->title ?></h1>
  
  <?php if($data["post"]->price == null) : ?>
  <h4>£ FREE </h4>
  <?php else : ?>
  <h4>£<?php echo $data["post"]->price ?></h4>
  <?php endif; ?>

  <p><?php echo $data["post"]->body;?></p>
  <p>written by <b> <a href="<?php echo URLROOT?>/users/profile/<?php echo $data["user"]->id; ?>"><?php echo $data["user"]->name?></a></b></p>
  <hr>

  <?php if($data["post"]->user_id == $_SESSION['user_id'] ) : ?>
    <a href="<?php echo URLROOT?>/posts/edit/<?php echo $data["post"]->id; ?>" class="btn btn-success">Edit Post</a>

    <form action="<?php echo URLROOT;?>/posts/delete/<?php echo $data["post"]->id; ?>" method="POST" style="display: inline">
     <input type="submit" value="Delete Post" class="btn btn-danger">
    </form>
  <?php else: ?>
    <a href="<?php echo URLROOT?>/users/profile/<?php echo $data["user"]->id; ?>" class="btn btn-success">Advertiser's Profile</a>
    <a href="mailto: <?php echo $data["user"]->email; ?>" class="btn btn-light">Contact Advertiser</a>
  <?php endif;?>
  <hr>
<p>Remember: Always ask the advertiser for images of the product. Do not pay for a product you have not seen in the real world with your own eyes. Meet face to face in a public area when buying a product.</p>
<?php require APPROOT.'/views/inc/footer.php' ?>
