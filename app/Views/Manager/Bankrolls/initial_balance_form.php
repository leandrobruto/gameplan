<?php if ($bankroll->initial_balance <= 0): ?>
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Welcome, <?= userLoggedIn()->username; ?> 🎉🦎⚽</h5>
            <p class="mb-4">
              Define your Initial Bankroll.
            </p>

            <?= form_open("manager/bankrolls/update/$bankroll->id"); ?>
              
              <div class="col-md-12 mb-4">
                <small class="form-label" for="initial_balance">Initial Balance</small>
                <div class="input-group input-group-merge">
                    <span id="icon-name" class="input-group-text">
                        <i class="bx bx-dollar"></i>
                    </span>
                    <input type="text" id="inital_balance" name="initial_balance" class="form-control money"value="" />
                </div>
              </div>
              <button type="submit" class="btn btn-outline-primary">Save</button>

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
<?php endif; ?>