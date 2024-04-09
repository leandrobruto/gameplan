<?= $this->extend('Admin/layout/main'); ?>

<!-- Here we send the title to the main template -->
<?= $this->section('title'); ?>

  <?= $title; ?>

<?= $this->endSection(); ?>

<!-- Here we send the styles to the main template -->
<?= $this->section('styles'); ?>



<?= $this->endSection(); ?>

<!-- Here we send the content to the main template -->
<?= $this->section('content'); ?>

<div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
  <!-- User Card -->
  <div class="card mb-4">
    <div class="card-body">
      <div class="user-avatar-section">
        <div class=" d-flex align-items-center flex-column">
          <?php if ($profile->avatar): ?>
            <a href="<?= site_url("admin/profiles/editImage/$user->id"); ?>">
              <img class="img-fluid rounded my-2" src="<?= site_url("admin/profiles/image/{$profile->avatar}") ?>" alt="<?= esc($profile->name) ?>" height="110" width="110" />
            </a>
          <?php else: ?>
            <a href="<?= site_url("admin/profiles/editImage/$user->id"); ?>">
              <img class="img-fluid rounded my-4" src="<?php echo site_url('assets/img/avatars/avatar-default.png') ?>" alt="Avatar default" height="110" width="110" />
            </a>
          <?php endif; ?>
          
          <span>@<?= strtolower(esc($user->username)); ?></span>

          <div class="user-info text-center mt-2">
            <span class="badge bg-label-secondary"><?= $user->is_admin ? 'Admin' : 'Client' ?></span>
          </div>
        </div>
      </div>
      <h6 class="pb-2 border-bottom mb-4 mt-2"></h6>
      <div class="info-container">

        <?php if (session()->has('errors_model')): ?>
          <ul>
            <?php foreach (session('errors_model') as $error): ?>
              <li class="text-danger"><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        
        <ul class="list-unstyled">
          <li class="mb-3">
            <span class="fw-medium me-2">Full Name:</span>
            <span><?= $profile->first_name . ' ' . $profile->last_name; ?></span>
          </li>
          <li class="mb-3">
            <span class="fw-medium me-2">Email:</span>
            <span><?= $user->email; ?></span>
          </li>
          <li class="mb-3">
            <span class="fw-medium me-2">Status:</span>
            <span class="badge <?= $user->active ? 'bg-label-primary' : 'bg-label-danger' ?>"><?= ($user->active ? 'Active' : 'Inactive'); ?></span>
          </li>
          <li class="mb-3">
            <span class="fw-medium me-2">Created:</span>
            <span><?= $user->created_at->humanize(); ?></span>
          </li>
          <li class="mb-3">
            <span class="fw-medium me-2">Updated:</span>
            <span><?= $user->updated_at->humanize(); ?></span>
          </li>
        </ul>
        <div class="justify-content-center mt-4">
          <?php if ($user->deleted_at == null): ?>
            <button
              type="button"
              class="btn btn-dark"
              data-bs-toggle="modal"
              data-bs-target="#editUserModal">
              <i class="bx bx-edit-alt tf-icons"></i>
              Edit
            </button>
            <button
              type="button"
              class="btn btn-danger"
              data-bs-toggle="modal"
              data-bs-target="#deleteUserModal">
              <i class="bx bx-trash-alt tf-icons"></i>
              Delete
            </button>
        
            <a href="<?= site_url("admin/users"); ?>" class="btn btn-outline-primary">
              <i class="bx bx-left-arrow-alt tf-icons"></i>  
              Back
            </a>
          <?php else: ?>
            <a title="Undo deletion" href="<?= site_url("admin/users/undoDelete/$user->id"); ?>" class="btn btn-dark mr-2">
              <i class="bx bx-undo tf-icons"></i>
              Undo
            </a>

            <a href="<?= site_url("admin/users"); ?>" class="btn btn-light">
              <i class="bx bx-left-arrow-alt tf-icons"></i>  
              Back
            </a>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- /User Card -->
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">User Edit</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
        <?= form_open("admin/users/update/$user->id"); ?>
      </div>
      <div class="modal-body">

          <?= $this->include('Admin/Users/form'); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x tf-icons"></i>  
          Close
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="bx bx-save tf-icons"></i>  
          Submit
        </button>
      </div>
        <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Edit User Modal -->

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">User Delete</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <?= form_open("admin/users/delete/$user->id"); ?>

        <div class="modal-body pt-2 pb-0">

          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Attention!</strong> Are you sure about deleting the user <strong><?= esc($user->username) ?>?</strong>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x tf-icons"></i>  
            Close
          </button>
          <button type="submit" class="btn btn-danger">
            <i class="bx bx-trash-alt tf-icons"></i>  
            Delete
          </button>
        </div>
      
      <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Delete User Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>



<?= $this->endSection(); ?>