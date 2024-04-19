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

<div class="col-xl-12 col-md-12 col-sm-6 mb-4">

  <h5 class="card-title"><?= $title ?></h5>
  
  <div class="row">
    <div class="col-12 d-flex justify-content-start">
      <a href="#" type="button" class="btn btn-primary me-2">
        <i class="bx bx-up-arrow-alt tf-icons"></i> 
        <strong>Add Withdrawal</strong>
      </a>
      <button 
        type="button" class="btn btn-secondary me-2"
        data-bs-toggle="modal"
        data-bs-target="#simpleBetModal">
        <i class="bx bx-down-arrow-alt tf-icons"></i> 
        <strong>Add deposit</strong>
      </button>
    </div>
  </div>
</div>

<div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
  <div class="row">
      <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2">
                      <i class='bx bx-money'></i>
                    </span>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Withdrawals</span>
                <h3 class="card-title text-nowrap mb-1">$0.00</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2">
                      <i class='bx bx-credit-card'></i>
                    </span>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Deposits</span>
                <h3 class="card-title text-nowrap mb-1">
                  $0.00
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2">
                      <i class='bx bx-wallet'></i>
                    </span>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Result</span>
                <h3 class="card-title text-nowrap mb-1">
                  $0.00
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Hoverable Table rows -->
<div class="card mb-2">
  <div class="card-body">

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Market</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        </tbody>
      </table>
      <div class="d-flex justify-content-center mt-4">
        <?php if (empty($bets)): ?>
            No Bets Found.
        <?php endif; ?>

        <?php if ($pager->getPageCount() > 1): ?>
          <?= $pager->links('default', 'default_pagination'); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!--/ Hoverable Table rows -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

<?= $this->endSection(); ?>