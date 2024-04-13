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

<div class="row">
  <div class="col-lg-12 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-time text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Period Result</span>
            <h3 class="card-title <?= $reports->result_sum > 0 ? 'text-success' : ''; ?> mb-2">
              $<?= number_format($reports->result_sum, 2); ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-bar-chart text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Average Profit per Bet</span>
            <h3 class="card-title mb-2">
              $<?= number_format($reports->average_profit, 2); ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-dollar text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">ROI</span>
            <h3 class="card-title <?= $reports->roi > 0 ? 'text-success' : ''; ?> mb-2">
              <?= floatval(number_format($reports->roi, 2)); ?>%
            </h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-wallet text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Final Balance</span>
            <h3 class="card-title <?= $reports->current_balance > 0 ? 'text-success' : ''; ?> mb-2">
              $<?= $reports->current_balance ? $reports->current_balance : '0.00'; ?>
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bankroll Evolution -->
  <div class="col-12 col-lg-12 order-2 order-md-2 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-12">
          <h5 class="card-header m-0 me-2 pb-3">Bankroll Evolution</h5>
          <div id="bankrollEvolutionChart" class="px-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Bankroll Evolution -->
  <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
    <div class="row">
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-file-blank text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Settled Bets</span>
            <h3 class="card-title text-nowrap mb-2"><?= $reports->total_bets; ?></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-coin text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Starting Balance</span>
              <h3 class="card-title mb-2">$<?= number_format($reports->initial_balance, 2); ?></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-coin-stack text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Final Balance</span>
            <h3 class="card-title text-nowrap mb-1">
              $<?= $reports->current_balance ? $reports->current_balance : '0.00'; ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-bar-chart text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Bankroll Evolution</span>
            <h3 class="card-title <?= $reports->result_sum  > 0 ? 'text-success' : ''; ?> text-nowrap mb-1">
              <?= $reports->result_sum ? $reports->result_sum : '0'; ?>%
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Total Revenue -->
  <div class="col-12 col-lg-12 order-2 order-md-4 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-12">
          <h5 class="card-header m-0 me-2 pb-3">Profit vs Loss</h5>
          <div id="profitVsLossChart" class="px-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Revenue -->
  <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
    <div class="row">
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-wink-tongue text-primary"></i>
                </span>
              </div>
            </div>
            <span class="d-block mb-1">Total Bets Won</span>
            <h3 class="card-title text-nowrap mb-1">
              <?= $reports->result_sum ? $reports->result_sum : '0'; ?>%
            </h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-happy-heart-eyes text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Biggest Win</span>
            <h3 class="card-title mb-2">$14,857</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-meh text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total Bets Lost</span>
            <h3 class="card-title mb-2">$14,857</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2">
                  <i class="bx bx-dizzy text-primary"></i>
                </span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Biggest Loss</span>
            <h3 class="card-title mb-2">$14,857</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-12 order-4 order-md-3 order-lg-2 mb-4">
    <!-- Hoverable Table rows -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Main Markets</h5>

        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Market</th>
                <th>Sport</th>
                <th>Total</th>
                <th>Stake</th>
                <th>Results</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <?php foreach ($bets as $bet): ?>
                <tr>
                  <td><?= $bet->strategy; ?></td>
                  <td><?= $bet->sport; ?></td>
                  <td><?= $bet->event; ?></td>
                  <td>$<?= $bet->stake; ?></td>
                  <td class="<?= $bet->result > 0 ? 'text-success' : ''; ?>">$<?= $bet->result; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
          <?php if (empty($bets)): ?>
              No Strategies Found.
          <?php endif; ?>

          <?php if ($pager->getPageCount() > 1): ?>
            <?= $pager->links('default', 'default_pagination'); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-12 order-5 order-md-3 order-lg-2 mb-4">
    <!-- Hoverable Table rows -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Last Bets</h5>

        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Date</th>
                <th>Event</th>
                <th>Market</th>
                <th>Stake</th>
                <th>Result</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <?php foreach ($bets as $bet): ?>
                <tr>
                  <td><?= date("F jS, Y", strtotime($bet->date)); ?></td>
                  <td><?= $bet->event; ?></td>
                  <td><?= $bet->strategy; ?></td>
                  <td>$<?= $bet->stake; ?></td>
                  <td class="<?= $bet->result > 0 ? 'text-success' : ''; ?>">$<?= $bet->result; ?></td>
                </tr>
              <?php endforeach; ?>
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
  </div>
</div>

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

<?= $this->endSection(); ?>