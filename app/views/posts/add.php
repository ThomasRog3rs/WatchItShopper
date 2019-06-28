<?php require APPROOT.'/views/inc/header.php' ?>
<div class="row">
  <div class="col-md-12 mx-auto">
  <a href="<?php echo URLROOT?>/posts" class="btn btn-dark"> < go back</a>
    <div class="card card-body bg-light mt-5">
    <h2 class="text-center">Add a post</h2>
    <p class="text-center">Please fill out the form to add a post:</p>
    <form action="<?php echo URLROOT ?>/posts/add" method="post">
      <div class="form-group">
          <label for="title">Title: <sup>*</sup></label>
          <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>">
          <span class="invalid-feedback"><?php echo $data['title_err'] ?></span>
      </div>
      <div class="form-group">
          <label for="body">Desciption: <sup>*</sup></label>
          <textarea name="body" id="" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']?></textarea>
          <span class="invalid-feedback"><?php echo $data['body_err'] ?></span>
      </div>
      <div class="form-group">
          <label for="price">Price:</label>
          <input type="number" name="price" class="form-control form-control-lg <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>">
          <span class="invalid-feedback"><?php echo $data['price_err'] ?></span>
      </div>
      <div class="row">
        <div class="col">
          <input type="submit" value="Add Post" class="btn btn-success btn-block">
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
<?php require APPROOT.'/views/inc/footer.php' ?>