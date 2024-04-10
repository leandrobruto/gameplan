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

<div class="col-md-8">
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Create user</h5>
    </div>
    <div class="card-body">

      <?php if (session()->has('errors_model')): ?>
        <ul>
            <?php foreach (session('errors_model') as $error): ?>
                <li class="text-danger"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <?= form_open("admin/users/store"); ?>

        <?= $this->include('Admin/Users/form'); ?>

        <button type="submit" class="btn btn-primary">
          <i class="bx bx-save tf-icons"></i>  
          Save
        </button>

        <a href="<?= site_url("admin/users"); ?>" class="btn btn-light text-dark">
          <i class="bx bx-left-arrow-alt tf-icons"></i>
          Voltar
        </a>

      <?= form_close(); ?>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

<script src="<?= site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?= site_url('assets/vendor/mask/app.js') ?>"></script>

<?= $this->endSection(); ?>