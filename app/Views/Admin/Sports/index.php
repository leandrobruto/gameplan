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

            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#createSportModal">
              <i class="bx bx-plus tf-icons"></i>
              Create
            </button>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>sports</th>
                        <th>created at</th>
                        <th>Updated at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                        foreach ($sports as $key => $sport): ?>
                    <tr>
                        <td>
                            <?= $key + 1; ?>
                        </td>
                        <td>
                            <a href="<?= site_url("admin/sports/show/$sport->id"); ?>">
                                <?= $sport->name; ?>
                            </a>    
                        </td>
                        <td>
                            <?= $sport->created_at->humanize(); ?>
                        </td>
                        <td>
                            <?= $sport->updated_at->humanize(); ?>
                        </td>
                        <td>
                            <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= site_url("admin/sports/edit/$sport->id"); ?>">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item" href="<?= site_url("admin/sports/delete/$sport->id"); ?>">
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

            <div class="d-flex justify-content-center mt-4">
                <?= $pager->links('default', 'default_pagination'); ?>
            </div>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->

<!-- Edit User Modal -->
<div class="modal fade" id="createSportModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Sport</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <?= form_open("admin/sports/create"); ?>
        <div class="modal-body">

            <?= $this->include('Admin/Sports/form'); ?>

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

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?= site_url('assets/vendor/auto-complete/jquery-ui.js') ?>"></script>    

  <script>
    $(function () {
      $( "#query" ).autocomplete({
      source: function (request, response) {      
          $.ajax({
              url: '<?= site_url('admin/sports/search/') ?>',
              dataType: "json",
              data: {
                  term: request.term,
              },
          success: function (data) {
              if (data.length < 1) {
              var data = [
                  {
                  label: 'sport not found.',
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
            window.location.href = '<?php echo base_url('admin/sports/show'); ?>/' + ui.item.id;
          }
        }
      });
    });

  </script>

<?= $this->endSection(); ?>