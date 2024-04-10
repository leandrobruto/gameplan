<?= $this->extend('Admin/layout/main'); ?>

<!-- Here we send the title to the main template -->
<?= $this->section('title'); ?>

  <?= $title; ?>

<?= $this->endSection(); ?>

<!-- Here we send the styles to the main template -->
<?= $this->section('styles'); ?>



<?= $this->endSection(); ?>

<!-- Here we send the content to the main template -->
<?= $this->section('content'); ?>

<div class="col-xl-6 col-lg-5 col-md-5 order-1 order-md-0">
    <!-- File input -->
    <div class="card">
      <h5 class="card-header">Editing user image</h5>
      <div class="card-body">

        <?php if (session()->has('errors_model')): ?>
          <ul>
            <?php foreach (session('errors_model') as $error): ?>
              <li class="text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?= form_open_multipart("admin/profiles/uploadImage/$profile->user_id"); ?>

          <div class="mb-3">
            <label for="formFile" class="form-label">File input</label>
            <input class="form-control" name="photo_user" type="file" id="formFile" />
          </div>

          <button type="submit" class="btn btn-primary mr-2">
            <i class="bx bx-image-add tf-icons"></i>
            Save
          </button>

          <a href="<?= site_url("admin/users/show/$profile->user_id"); ?>" class="btn btn-light">
            <i class="bx bx-left-arrow-alt tf-icons"></i>  
              Back
          </a>

        <?= form_close(); ?>
      </div>
    </div>
</div>

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>



<?= $this->endSection(); ?>