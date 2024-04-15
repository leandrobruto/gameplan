<?= $this->extend('Admin/layout/main'); ?>

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

<div class="col-md-12">
  <ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
      <a class="nav-link active" href="<?= site_url('admin/account/profile'); ?>"
        ><i class="bx bx-user me-1"></i> Account</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('manager/account/notifications'); ?>"
        ><i class="bx bx-bell me-1"></i> Notifications</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/account/connections'); ?>"
        ><i class="bx bx-link me-1"></i> Notifications</a
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
              <img class="profilepic__image" src="<?= site_url("admin/profiles/image/{$user->avatar}") ?>" alt="user-avatar"
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
                <i class="bx bx-camera me-1"></i>
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
      <?= form_open('manager/account/update') ?>
        <div class="row">

          <!-- Hidden fields that we will use in the controller -->
          <input type="hidden" name="user_id" value="<?= $user->id; ?>" />

          <div class="mb-3 col-md-6">
            <label for="first_name" class="form-label">First Name</label>
            <input class="form-control" type="text" id="first_name" name="first_name" value="<?= $profile->first_name; ?>" autofocus />
          </div>

          <div class="mb-3 col-md-6">
            <label for="last_name" class="form-label">Last Name</label>
            <input class="form-control" type="text" name="last_name" id="last_name" value="<?= $profile->last_name; ?>" />
          </div>
          
          <div class="mb-3 col-md-6">
            <label for="username" class="form-label">Username</label>
            <input type="text"class=" form-control" id="username" name="user[username]" value="<?= $user->username; ?>" />
          </div>

          <div class="mb-3 col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input class="form-control" type="text" id="email" name="user[email]" value="<?= $user->email; ?>" placeholder="@email.com" />
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label" for="phoneNumber">Phone Number</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">(+55)</span>
              <input type="text" id="phoneNumber" name="profile[phone]" value="<?= $profile->phone; ?>" class="form-control sp_celphones" placeholder="(xx) xxxxx-xxxx" />
            </div>
          </div>
          
          <div class="mb-3 col-md-6">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo old('cpf', esc($profile->cpf)); ?>">
          </div>

          <div class="mb-3 col-md-6">
            <label for="default_stake" class="form-label">Default Stake</label>
            <input type="text"class=" form-control" id="default_stake" name="profile[default_stake]" value="<?= $user->default_stake; ?>" />
          </div>

          <div class="mb-3 col-md-6">
            <label for="sport" class="form-label">Default Date Range</label>
            <select class="form-select" id="sport" name="bet[sport_id]" aria-label="Sport">
              <?php foreach($date_ranges as $range): ?>
                <option value="<?= $range->id; ?>" <?= (old('profile.default_date_range_id') == $range->id ? 'selected' : '') ?>><?= $range->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3 col-md-6">
            <label for="sport" class="form-label">Sport</label>
            <select class="form-select" id="sport" name="bet[sport_id]" aria-label="Sport">
              <?php foreach($sports as $sport): ?>
                <option value="<?= $sport->id; ?>" <?= (old('profile.default_sport_id') == $sport->id ? 'selected' : '') ?>><?= $sport->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="mt-2">
          <button type="submit" class="btn btn-primary me-2">Save changes</button>
          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
        </div>
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
        <?= form_open('manager/account/delete'); ?>
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

          <?= form_open_multipart("admin/profiles/uploadImage/$profile->user_id"); ?>

            <div class="mb-3">
              <label for="formFile" class="form-label">File input</label>
              <input class="form-control" name="photo_user" type="file" id="formFile" />
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