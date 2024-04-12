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

<div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">

  <h4 class="card-title"><?= $title ?></h4>

  <div class="row">
      <div class="col-lg-12 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-3 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2"><i class="bx bx-coin text-primary"></i></span>
                  </div>
                </div>
                <span><strong>Minimum</strong></span>
                <h3 class="card-title text-nowrap mb-1">$0.00</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2"><i class="bx bx-coin-stack text-primary"></i></span>
                    </div>
                  </div>
                <span><strong>Maximum</strong></span>
                <h3 class="card-title text-nowrap mb-1">$0.00</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2"><i class="bx bx-money text-primary"></i></span>
                  </div>
                </div>
                <span><strong>Initital Balance</strong></span>
                <h3 class="card-title text-nowrap mb-1">
                <?php if (!empty($reports)): ?>
                    $<?= $reports->initial_balance; ?>
                  <?php else: ?>
                    $0.00
                  <?php endif; ?>
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2"><i class="bx bx-wallet text-primary"></i></span>
                  </div>
                </div>
                <span><strong>Final Balance</strong></span>
                <h3 class="card-title text-nowrap mb-1">
                  <?php if (!empty($reports)): ?>
                    $<?= $reports->current_balance; ?>
                  <?php else: ?>
                    $0.00
                  <?php endif; ?>
                </h3>
              </div>
            </div>
          </div>
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