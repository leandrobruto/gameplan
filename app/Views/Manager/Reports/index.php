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

<div class="col-12 col-lg-12 order-0 order-md-3 order-lg-2">
  <div class="row">
      <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-line-chart text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Bankroll Evolution</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-calendar text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Daily Results</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-coin-stack text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Accumulated Results</span>
                  <h3 class="card-title text-nowrap mb-1">
                  </h3>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-line-chart text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Odds</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-calendar text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Tags</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-coin-stack text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Profit and Loss</span>
                  <h3 class="card-title text-nowrap mb-1">
                  </h3>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-line-chart text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Multiples</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-calendar text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Sports</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-coin-stack text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Losses Analysis</span>
                  <h3 class="card-title text-nowrap mb-1">
                  </h3>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-line-chart text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Markets</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-calendar text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Market Details</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-coin-stack text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Competitions</span>
                  <h3 class="card-title text-nowrap mb-1">
                  </h3>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-line-chart text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Competitions Details</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="<?= site_url('manager/reports/bankroll-evolution'); ?>" class="text-reset">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <span class="badge bg-label-primary p-2">
                        <i class="bx bx-calendar text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Daily Results</span>
                </div>
              </div>
            </a>
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