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

            <div class="row mb-3">
                <div class="col-6">
                    <div class="ui-widget">
                        <div class="input-group input-group-merge">
                            <input id="query" name="query" placeholder="Search.." class="form-control bg-light">
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="<?= site_url("admin/users/create"); ?>" class="btn btn-primary float-right">
                        <i class="bx bx-plus tf-icons"></i>
                        Create
                    </a>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Name</th>
                            <th>Status</th>
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
                                        <a href="<?= site_url("admin/users/show/$user->id"); ?>">
                                            <?php if($user->avatar): ?>
                                                <img src="<?= site_url("admin/profiles/image/$user->avatar"); ?>" alt="user-avatar" class="rounded-circle" />
                                            <?php else: ?>
                                                <img src="<?= site_url("assets/img/avatars/avatar-default.png"); ?>" alt="user-avatar" class="rounded-circle" />
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <?= $user->first_name . ' ' . $user->last_name; ?>
                            </td>
                            <td>
                                <?= $user->active ?
                                    '<span class="badge bg-label-primary me-1">Active</span>' :
                                    '<span class="badge bg-label-danger me-1">Inactive</span>'
                                ?>
                            </td>
                            <td class="d-flex justify-content-end p-3">
                                <a class="btn" href="<?= site_url("admin/users/edit/$user->id"); ?>">
                                    <i class="bx bx-edit-alt me-1"></i>
                                </a>
                                <a class="btn" href="<?= site_url("admin/users/delete/$user->id"); ?>">
                                    <i class="bx bx-trash text-danger me-1"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">

                </div>
            </div>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
</div>

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