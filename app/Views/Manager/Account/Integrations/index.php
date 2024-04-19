<?= $this->extend('layout/main'); ?>

<!-- Here we send the title to the main template -->
<?= $this->section('title'); ?>

  <?= $title; ?>

<?= $this->endSection(); ?>

<!-- Here we send the styles to the main template -->
<?= $this->section('styles'); ?>



<?= $this->endSection(); ?>

<!-- Here we send the content to the main template -->
<?= $this->section('content'); ?>

<?= $this->include('Manager/Account/Bankrolls/initial_balance_form'); ?>

<!-- Toast with Placements -->
<div
  class="bs-toast toast toast-placement-ex mt-2 mr-0 top-0 end-0 m-4"
  role="alert"
  aria-live="assertive"
  aria-atomic="true"
  data-delay="2000"
>
  <div class="toast-header p-3">
    <i class="bx bx-check text-success border border-success rounded-3 me-2"></i>
    <div class="me-auto text-success">User successfully registered!</div>
    <small>Just now</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('manager/account/profile'); ?>"><i class="bx bx-user me-1"></i> Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('manager/account/strategies'); ?>"
          ><i class="bx bx-abacus me-1"></i> Strategies</a
        >
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('manager/account/competitions'); ?>"
          ><i class="bx bx-trophy me-1"></i> Competitions</a
        >
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('manager/account/bankrolls'); ?>"
          ><i class="bx bx-dollar me-1"></i> Bankrolls</a
        >
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= site_url('manager/account/integrations'); ?>"
          ><i class="bx bx-link me-1"></i> Integrations</a
        >
      </li>
    </ul>    
  </div>
</div>

<div class="col-lg-12">
  <div class="card">
      <div class="card-body">
    
        <!-- Toast with Placements -->
        <button type="button" class="btn btn-primary" id="toastbtn">Show Toast</button>

      </div>
    </div>
</div>

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>


  <script>

    $('#toastbtn').on('click', function() {

      $('.toast').toast('show');

    });

  </script>

<?= $this->endSection(); ?>