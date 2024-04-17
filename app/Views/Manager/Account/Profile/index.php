<?= $this->extend('layout/main'); ?>

<!-- Here we send the title to the main template -->
<?= $this->section('title'); ?>

  <?= $title; ?>

<?= $this->endSection(); ?>

<!-- Here we send the styles to the main template -->
<?= $this->section('styles'); ?>

<style>
  .profilepic {
  position: relative;
  width: 100px;
  height: 100px;
  border-radius: 7%;
  overflow: hidden;
  background-color: #111;
  }

  .profilepic:hover .profilepic__content {
    opacity: 1;
  }

  .profilepic:hover .profilepic__image {
    opacity: .5;
  }

  .profilepic__image {
    object-fit: cover;
    opacity: 1;
    transition: opacity .2s ease-in-out;
  }

  .profilepic__content {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    opacity: 0;
    transition: opacity .2s ease-in-out;
  }

  .profilepic__icon {
    color: white;
    padding-bottom: 8px;
  }

  .fas {
    font-size: 20px;
  }

  .profilepic__text {
    text-transform: uppercase;
    font-size: 10px;
    width: 50%;
    text-align: center;
  }

</style>

<?= $this->endSection(); ?>

<!-- Here we send the content to the main template -->
<?= $this->section('content'); ?>

<?= $this->include('Manager/Account/Bankrolls/initial_balance_form'); ?>

<div class="col-md-12">
  <ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
      <a class="nav-link active" href="<?= site_url('manager/account/profile'); ?>"><i class="bx bx-user me-1"></i> Account</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('manager/payments'); ?>"
        ><i class="bx bx-credit-card me-1"></i> Billing & Plans</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('manager/account/strategies'); ?>"
        ><i class="bx bx-abacus me-1"></i> Strategies</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('manager/account/competitions'); ?>"
        ><i class="bx bx-trophy me-1"></i> Competitions</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('manager/account/bankrolls'); ?>"
        ><i class="bx bx-dollar me-1"></i> Bankrolls</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('manager/account/integrations'); ?>"
        ><i class="bx bx-link me-1"></i> Integrations</a
      >
    </li>
  </ul>
  <div class="card mb-4">
    <h5 class="card-header">Profile Details</h5>
    <!-- Account -->
    <div class="card-body">
      <div class="d-flex align-items-start align-items-sm-center gap-4">
        <a href="#" data-bs-toggle="modal"
          data-bs-target="#uploadPhotoModal">
          <div class="profilepic">
            <?php if ($user->avatar): ?>
              <img class="profilepic__image" src="<?= site_url("manager/account/profile/image/$user->avatar") ?>" alt="user-avatar"
                class="d-block rounded"
                height="100"
                width="100"
                id="uploadedAvatar" />
            <?php else: ?>
              <img class="profilepic__image" src="<?= site_url("assets/img/avatars/avatar-default.png") ?>" alt="user-avatar"
                class="d-block rounded"
                height="100"
                width="100"
                id="uploadedAvatar" />
            <?php endif; ?>
            <div class="profilepic__content">
              <span class="profilepic__icon">
                <i class="bx bx-image-add"></i>
              </span>
              <span class="profilepic__text">Change Photo</span>
            </div>
          </div>
        </a>
        <div class="button-wrapper">
          <label for="upload" class="btn btn-primary me-2 mb-4" 
            data-bs-toggle="modal"
            data-bs-target="#uploadPhotoModal" tabindex="0">
            <span class="d-none d-sm-block">Upload new photo</span>
            <i class="bx bx-upload d-block d-sm-none"></i>
          </label>

          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
          <div class="col-lg-12">
            <span class="fw-semibold d-block">@<?= userLoggedIn()->username; ?></span>
          </div>
        </div>
      </div>
    </div>
    <hr class="my-0" />
    <div class="card-body">

      <?php if (session()->has('errors_model')): ?>
        <ul>
            <?php foreach (session('errors_model') as $error): ?>
                <li class="text-danger"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <?= form_open('manager/account/profile/update') ?>

        <?= $this->include('Manager/Account/Profile/form'); ?>

      <?= form_close(); ?>

    </div>
    <!-- /Account -->
  </div>
  <div class="card">
    <h5 class="card-header">Delete Account</h5>
    <div class="card-body">
      <div class="mb-3 col-12 mb-0">
        <div class="alert alert-warning">
          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
        </div>
      </div>
        <?= form_open('manager/account/profile/delete'); ?>
          <div class="form-check mb-3">
            <input
              class="form-check-input"
              type="checkbox"
              name="accountActivation"
              id="accountActivation"
            />
            <label class="form-check-label" for="accountActivation"
              >I confirm my account deactivation</label
            >
          </div>
        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
      <?= form_close(); ?>

    </div>
  </div>
</div>

<!-- Upload Photo Modal -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Upload photo</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <div class="card">
        <div class="card-body py-2">

          <?= form_open_multipart("manager/account/profile/uploadImage/$profile->user_id"); ?>

            <div class="mb-3">
              <label for="formFile" class="form-label">File input</label>
              <input class="form-control" name="user_avatar" type="file" id="formFile" />
            </div>

            <button type="submit" class="btn btn-primary mr-2">
              <i class="bx bx-image-add tf-icons"></i>
              Save
            </button>

          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Upload Photo Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

<?= $this->endSection(); ?>