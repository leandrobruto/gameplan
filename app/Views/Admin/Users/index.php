<?= $this->extend('Admin/layout/main'); ?>

<!-- Here we send the title to the main template -->
<?= $this->section('title'); ?>

  <?= $title; ?>

<?= $this->endSection(); ?>

<!-- Here we send the styles to the main template -->
<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= site_url('assets/vendor/auto-complete/jquery-ui.css'); ?>"/>

<?= $this->endSection(); ?>

<!-- Here we send the content to the main template -->
<?= $this->section('content'); ?>

<div class="col-xl-12 col-md-12 col-sm-6">
    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $title ?></h5>

            <div class="ui-widget">
                <input id="query" name="query" placeholder="Search.." class="form-control bg-light mb-4">
            </div>

        <a href="<?= site_url("admin/users/create"); ?>" class="btn btn-success btn-sm float-right">
            <i class="bx bx-plus tf-icons"></i>
          Create
        </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th>Client</th>
                    <th>Users</th>
                    <th>Status</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li
                                        data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom"
                                        data-bs-placement="top"
                                        class="avatar avatar-md pull-up"
                                        title="@<?= $user->username; ?>"
                                    >
                                    <?php if($user->avatar): ?>
                                        <img src="<?= site_url("admin/profiles/image/$user->avatar"); ?>" alt="user-avatar" class="rounded-circle" />
                                    <?php else: ?>
                                        <img src="<?= site_url("assets/img/avatars/avatar-default.png"); ?>" alt="user-avatar" class="rounded-circle" />
                                    <?php endif; ?>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <a href="<?= site_url("admin/users/show/$user->id"); ?>">
                                    <?= $user->first_name . ' ' . $user->last_name; ?>
                                </a>    
                            </td>
                            <td>
                                <?= $user->active ?
                                    '<span class="badge bg-label-primary me-1">Active</span>' :
                                    '<span class="badge bg-label-danger me-1">Inactive</span>'
                                ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= site_url("admin/users/edit/$user->id"); ?>">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit
                                        </a>
                                        <a class="dropdown-item" href="<?= site_url("admin/users/delete/$user->id"); ?>">
                                            <i class="bx bx-trash me-1"></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
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

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?= site_url('assets/vendor/auto-complete/jquery-ui.js') ?>"></script>    

  <script>
    $(function () {
      $( "#query" ).autocomplete({
      source: function (request, response) {      
          $.ajax({
              url: '<?= site_url('admin/users/search/') ?>',
              dataType: "json",
              data: {
                  term: request.term,
              },
          success: function (data) {
              if (data.length < 1) {
              var data = [
                  {
                  label: 'User not found.',
                  value: -1
                  }
              ];
              }

              response(data); // Here we have no data
          },
          }); // End of ajax
        },
        minLength: 1,
        select: function (event, ui) {
          if (ui.item.value == -1) {
            $this.val("");
            return false;
          } else {
            window.location.href = '<?php echo base_url('admin/users/show'); ?>/' + ui.item.id;
          }
        }
      });
    });

  </script>

<?= $this->endSection(); ?>