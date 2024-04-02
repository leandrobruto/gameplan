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
          <?php if ($user->profile->avatar): ?>
            <a href="<?= site_url("admin/profiles/editImage/$user->id"); ?>">
              <img class="img-fluid rounded my-2" src="<?= site_url("admin/profiles/image/{$user->profile->avatar}") ?>" alt="<?= esc($user->profile->name) ?>" height="110" width="110" />
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
        <ul class="list-unstyled">
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
            <a href="<?= site_url("admin/users/edit/$user->id"); ?>" class="btn btn-sm btn-dark mr-2">
              <i class="bx bx-edit-alt tf-icons"></i>
              Edit
            </a>

            <a href="<?= site_url("admin/users/delete/$user->id"); ?>" class="btn btn-sm btn-danger mr-2">
              <i class="bx bx-trash-alt tf-icons"></i>
              Delete
            </a>
        
            <a href="<?= site_url("admin/users"); ?>" class="btn btn-sm btn-light">
              <i class="bx bx-left-arrow-alt tf-icons"></i>  
              Back
            </a>
          <?php else: ?>
            <a title="Undo deletion" href="<?= site_url("admin/users/undoDelete/$user->id"); ?>" class="btn btn-sm btn-dark mr-2">
              <i class="bx bx-undo tf-icons"></i>
              Undo
            </a>

            <a href="<?= site_url("admin/users"); ?>" class="btn btn-sm btn-light">
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

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>



<?= $this->endSection(); ?>