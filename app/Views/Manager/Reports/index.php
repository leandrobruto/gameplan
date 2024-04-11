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

<?= $this->include('Manager/Bankrolls/initial_balance_form'); ?>

<div class="col-lg-12 col-md-4 order-1">
  <div class="row">
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
        <div class="card">
            <div class="card-body">
              <i class="bx bx-money"></i>
              <span>Bankroll Evolution</span>
          </div>
        </div>
      </a>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Daily Results</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Accumulated Results</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Odds</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Tags</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Profit and Loss</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Multiples</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Sports</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Losses Analysis</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Odds</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>amrkets</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Market Details</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Competitions</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-2">
      <div class="card">
        <div class="card-body">
          <i class="bx bx-money"></i>
          <span>Competitions Details</span>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

<?= $this->endSection(); ?>