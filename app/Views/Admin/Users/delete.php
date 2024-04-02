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

<div class="row">
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h5 class="pb-2 border-bottom mb-4"><?= esc($title); ?></h5>

        <?php if (session()->has('errors_model')): ?>
          <ul>
            <?php foreach (session('errors_model') as $error): ?>
              <li class="text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?= form_open("admin/users/delete/$user->id"); ?>

          <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
            <strong>Attention!</strong> Are you sure about deleting the user <strong><?= esc($user->username) ?>?</strong>
          </div>

          <button type="submit" class="btn btn-danger btn-sm mr-2">
            <i class="bx bx-trash-alt tf-icons"></i>
              Delete
          </button>

          <a href="<?= site_url("admin/users/show/$user->id"); ?>" class="btn btn-light text-dark btn-sm">
            <i class="bx bx-left-arrow-alt tf-icons"></i>
            Back
          </a>

        <?= form_close(); ?>

      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>


<?= $this->endSection(); ?>