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
                  <input type="text" id="bank_roll" name="bank_roll" class="form-control money"value="" />
              </div>
            </div>
            <a href="javascript:;" class="btn btn-outline-primary">Save</a>

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

<div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
  <div class="row">
      <div class="col-lg-12 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
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
                </div>
                <span><strong>Bets</strong></span>
                <h3 class="card-title text-nowrap mb-1"><?= $count; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
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
                </div>
                <span><strong>Result</strong></span>
                <h3 class="card-title text-nowrap mb-1">$<?= $result; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
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
                </div>
                <span><strong>ROI</strong></span>
                <h3 class="card-title text-nowrap mb-1"><?= $roi; ?>%</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-12 col-md-12 col-sm-6">
    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= $title ?></h5>

          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Date</th>
                      <th>Event</th>
                      <th>Market</th>
                      <th>Stake</th>
                      <th>Result</th>
                      <th>ROI</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                        foreach ($bets as $bet): ?>
                          <tr>
                              <td><?= $bet->code; ?></td>
                              <td><?= date("F jS, Y", strtotime($bet->date)); ?></td>
                              <td><?= $bet->event; ?></td>
                              <td><?= $bet->strategy; ?></td>
                              <td>$<?= $bet->stake; ?></td>
                              <td>$<?= $bet->result; ?></td>
                              <td><?= $roi; ?>%</td>
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
<!--/ Hoverable Table rows -->

<!-- Simple Bet Modal -->
<div class="modal fade" id="simpleBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Bet</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <?= form_open("manager/bets/store"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Bets/form'); ?>

        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x tf-icons"></i>  
            Close
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bx bx-save tf-icons"></i>  
            Save
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
      </div>
      <?= form_open("admin/users/update/"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Bets/multiple_form'); ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x tf-icons"></i>  
            Close
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bx bx-save tf-icons"></i>  
            Save
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