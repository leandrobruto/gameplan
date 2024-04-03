<?= $this->extend('layout/home'); ?>

<!-- Here we send the title to the main template -->
<?= $this->section('title'); ?>

  <?= $title; ?>

<?= $this->endSection(); ?>

<!-- Here we send the styles to the main template -->
<?= $this->section('styles'); ?>



<?= $this->endSection(); ?>

<!-- Here we send the content to the main template -->
<?= $this->section('content'); ?>

<div class="col-lg-8 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
      <div class="col-sm-7">
        <div class="card-body">
          <h5 class="card-title text-primary"><?= $this->renderSection('title'); ?> 🎉🦎⚽</h5>
          <p class="mb-2">
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

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

<?= $this->endSection(); ?>