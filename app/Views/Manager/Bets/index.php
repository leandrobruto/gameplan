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

<div class="col-lg-12 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
      <div class="col-sm-7">
        <div class="card-body">
          <h5 class="card-title text-primary">Welcome, <?= userLoggedIn()->username; ?> 🎉🦎⚽</h5>
          <p class="mb-4">
            Define your Initial Bankroll.
          </p>

          <?= form_open("admin/users/register"); ?>
            <div class="col-md-12 mb-4">
              <small class="form-label" for="bank_roll">Initial Balance</small>
              <div class="input-group input-group-merge">
                  <span id="icon-name" class="input-group-text">
                    <i class="bx bx-dollar"></i>
                  </span>
                  <input 
                    type="text" 
                    id="bank_roll"
                    name="bank_roll"
                    class="form-control money"
                    value=""
                  />
              </div>
            </div>
            <a href="javascript:;" class="btn btn-sm btn-outline-primary">Save</a>
          <?= form_close(); ?>

        </div>
      </div>
      <div class="col-sm-5 text-center text-sm-left">
        <div class="card-body pb-0 px-0 px-md-4">
          <img
            src="<?= site_url('assets/img/illustrations/man-with-laptop-light.png'); ?>"
            height="140"
            alt="View Badge User"
            data-app-dark-img="illustrations/man-with-laptop-dark.png"
            data-app-light-img="illustrations/man-with-laptop-light.png"
          />
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
  <div class="demo-inline-spacing">
    <div class="input-group input-group-merge">
      <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
      <input
        type="text"
        class="form-control"
        placeholder="Search..."
        aria-label="Search..."
        aria-describedby="basic-addon-search31"
      />
    </div>
    <a href="#" type="button" class="btn btn-dark">
      <i class="bx bx-import tf-icons"></i> 
      <strong>Import</strong>
    </a>
    <button 
      type="button" class="btn btn-secondary"
      data-bs-toggle="modal"
      data-bs-target="#simpleBetModal">
      <i class="bx bx-plus tf-icons"></i> 
      <strong>Simple Bet</strong>
    </button>
    <button 
      type="button" class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#multipleBetModal">
      <i class="bx bx-plus tf-icons"></i> 
      <strong>Multiple Bet</strong>
    </button>
  </div>
</div>
<!-- Total Revenue -->
<div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
  <div class="card">
    <div class="row row-bordered g-0">
      <div class="col-md-8">
        <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
        <div id="totalRevenueChart" class="px-2"></div>
      </div>
      <div class="col-md-4">
        <div class="card-body">
          <div class="text-center">
            <div class="dropdown">
              <button
                class="btn btn-sm btn-outline-primary dropdown-toggle"
                type="button"
                id="growthReportId"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                2022
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                <a class="dropdown-item" href="javascript:void(0);">2021</a>
                <a class="dropdown-item" href="javascript:void(0);">2020</a>
                <a class="dropdown-item" href="javascript:void(0);">2019</a>
              </div>
            </div>
          </div>
        </div>
        <div id="growthChart"></div>
        <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
          <div class="d-flex">
            <div class="me-2">
              <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
            </div>
            <div class="d-flex flex-column">
              <small>2022</small>
              <h6 class="mb-0">$32.5k</h6>
            </div>
          </div>
          <div class="d-flex">
            <div class="me-2">
              <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
            </div>
            <div class="d-flex flex-column">
              <small>2021</small>
              <h6 class="mb-0">$41.2k</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Total Revenue -->
<div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
  <div class="row">
    <div class="col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="<?= site_url('assets/img/icons/unicons/paypal.png'); ?>" alt="Credit Card" class="rounded" />
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
          <span class="d-block mb-1">Payments</span>
          <h3 class="card-title text-nowrap mb-2">$2,456</h3>
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
          <span class="fw-semibold d-block mb-1">Transactions</span>
          <h3 class="card-title mb-2">$14,857</h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="card-title">
                <h5 class="text-nowrap mb-2">Profile Report</h5>
                <span class="badge bg-label-warning rounded-pill">Year 2021</span>
              </div>
              <div class="mt-sm-auto">
                <small class="text-success text-nowrap fw-semibold"
                  ><i class="bx bx-chevron-up"></i> 68.2%</small
                >
                <h3 class="mb-0">$84,686k</h3>
              </div>
            </div>
            <div id="profileReportChart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Simple Bet Modal -->
<div class="modal fade" id="simpleBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Bet</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
        <?= form_open("admin/users/update/"); ?>
      </div>
      <div class="modal-body">

        <?= $this->include('Manager/Bets/form'); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x tf-icons"></i>  
          Close
        </button>
        <button type="submit" class="btn btn-sm btn-primary">
          <i class="bx bx-save tf-icons"></i>  
          Create
        </button>
      </div>
        <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Simple Bet Modal -->

<!-- Multiple Bet Modal -->
<div class="modal fade" id="multipleBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Multiple Bet</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
        <?= form_open("admin/users/update/"); ?>
      </div>
      <div class="modal-body">

        <?= $this->include('Manager/Bets/multiple_form'); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x tf-icons"></i>  
          Close
        </button>
        <button type="submit" class="btn btn-sm btn-primary">
          <i class="bx bx-save tf-icons"></i>  
          Create
        </button>
      </div>
        <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Multiple Bet Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

<?= $this->endSection(); ?>