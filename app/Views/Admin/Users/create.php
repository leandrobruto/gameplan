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

      <?= form_open("admin/users/register"); ?>

        <?= $this->include('Admin/Users/form'); ?>

        <a href="<?= site_url("admin/users"); ?>" class="btn btn-light text-dark btn-sm">
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