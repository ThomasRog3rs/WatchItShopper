<?php require APPROOT.'/views/inc/header.php' ?>
<?php flash('post_message')?>
  <div class="row mb-4">
    <div class="col-md-6">
      <h1>Posts:</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-dark float-right">Post an ad</a>
    </div>
  </div>

  <?php if(empty($data['posts'])) : ?>
  <h3 class="text-center">Sorry, we have no posts! :(</h3>
  <?php endif; ?>

  <div class="row mb-4">
  <?php foreach($data['posts'] as $post) :?>
    <div class="col-md-12">
      <div class="card text-white bg-success mb-3">
        <div class="card-header">
          <h4><?php echo $post->title; ?></h4>
        </div>
        <div class="card-body">
          <div class="card-text mb-2 lead">
            <p style="display: inline"><?php echo $post->body;?></p>
            <p style="display: inline" class="float-right">£<?php echo $post->price;?></p>
          </div>
          <div class="bg-secondary p-2 mb-2">
            Posted by <?php echo $post->name; ?> on <?php echo $post->postCreated;?>
          </div>
          <a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->postId;?>" class="btn btn-dark">View More</a>
        </div>
      </div>
      <br>
    </div>
  <?php endforeach?>
  </div>

<?php require APPROOT.'/views/inc/footer.php' ?>