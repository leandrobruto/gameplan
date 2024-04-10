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
    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img
                src="<?= site_url('assets/img/icons/unicons/chart-success.png'); ?>"
                alt="Chart success"
                class="rounded"
              />
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="cardOpt6"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <span>Period Result</span>
          <h3 class="card-title text-nowrap mb-1">$<?= $result; ?></h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0.00%</small>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img
                src="<?= site_url('assets/img/icons/unicons/wallet.png'); ?>"
                alt="Credit Card"
                class="rounded"
              />
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="cardOpt6"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <span>Average Profit per Bet</span>
          <h3 class="card-title text-nowrap mb-1">$<?= $averageProfit; ?></h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0.00%</small>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img
                src="<?= site_url('assets/img/icons/unicons/cc-primary.png'); ?>"
                alt="Credit Card"
                class="rounded"
              />
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="cardOpt6"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <span>ROI</span>
          <h3 class="card-title text-nowrap mb-1"><?= $roi; ?>%</h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0.00%</small>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img
                src="<?= site_url('assets/img/icons/unicons/wallet.png'); ?>"
                alt="Credit Card"
                class="rounded"
              />
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="cardOpt6"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <span>Final Balance</span>
          <h3 class="card-title text-nowrap mb-1">$<?= $balance; ?></h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0.00%</small>
        </div>
      </div>
    </div>

    <!-- Bankroll Evolution -->
    <div class="col-lg-8 col-md-12 col-12 mb-4">
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

  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt4"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="d-block mb-1">Settled Bets</span>
            <h3 class="card-title text-nowrap mb-2"><?= $count; ?></h3>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?= site_url('assets/img/icons/unicons/cc-primary.png'); ?>" alt="Credit Card" class="rounded" />
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt1"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Starting Balance</span>
            <h3 class="card-title mb-2">$<?= $bankroll ? $bankroll->initial_balance : 0; ?></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt4"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="d-block mb-1">Bankroll Evolution</span>
            <h3 class="card-title text-nowrap mb-2">$0</h3>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?= site_url('assets/img/icons/unicons/cc-primary.png'); ?>" alt="Credit Card" class="rounded" />
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt1"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Biggest Loss</span>
            <h3 class="card-title mb-2">$0</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Profit vs Loss -->
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-12">
          <h5 class="card-header m-0 me-2 pb-3">Profit vs Loss</h5>
          <div id="profitVsLossChart" class="px-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Profit vs Loss -->

  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt4"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="d-block mb-1">Total Bets Won</span>
            <h3 class="card-title text-nowrap mb-2">$<?= $result; ?></h3>
            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?= site_url('assets/img/icons/unicons/cc-primary.png'); ?>" alt="Credit Card" class="rounded" />
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt1"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Bigest Win</span>
            <h3 class="card-title mb-2">$<?= $biggest_win; ?></h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt4"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="d-block mb-1">Total Bets Lost</span>
            <h3 class="card-title text-nowrap mb-2">$0</h3>
            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?= site_url('assets/img/icons/unicons/cc-primary.png'); ?>" alt="Credit Card" class="rounded" />
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="cardOpt1"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Biggest Loss</span>
            <h3 class="card-title mb-2">$0</h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <!-- Hoverable Table rows -->
    <div class="card mb-4">
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
                <th>Result</th>
              </tr>
            </thead>
          <tbody class="table-border-bottom-0">
            <?php foreach ($bets as $bet): ?>
              <tr>
                <td><?= $bet->strategy; ?></td>
                <td><?= $bet->sport; ?></td>
                <td><?= $bet->event; ?></td>
                <td><?= $bet->stake; ?></td>
                <td>$<?= $bet->result; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php if ($pager->getPageCount() > 1): ?>
        <div class="d-flex justify-content-center mt-4">
          <?= $pager->links('default', 'default_pagination'); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
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
                      <td>$<?= $bet->result; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
          <?php if ($pager->getPageCount() > 1): ?>
            <div class="d-flex justify-content-center mt-4">
                <?= $pager->links('default', 'default_pagination'); ?>
            </div>
          <?php endif; ?>
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