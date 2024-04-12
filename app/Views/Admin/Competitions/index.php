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
            <h5 class="card-title d-flex justify-content-between align-items-center"><?= $title ?>
                <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#createCompetitionModal">
                <i class="bx bx-plus tf-icons"></i>
                Create
                </button>
            </h5>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Sport</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php foreach ($competitions as $competition): ?>
                            <tr>
                                <td><?= $competition->name; ?></td>
                                <td><?= $competition->sport_name; ?></td>
                                <td class="d-flex justify-content-end mr-2">
                                <a href="<?= site_url("admin/strategies/transfer/$competition->id"); ?>">
                                    <i class="bx bx-transfer me-3"></i>
                                </a>

                                <a href="<?= site_url("admin/strategies/edit/$competition->id"); ?>">
                                    <i class="bx bx-edit-alt me-3"></i>
                                </a>
                                
                                <a href="<?= site_url("admin/strategies/edit/$competition->id"); ?>">
                                    <i class="bx bx-trash text-danger me-3"></i>
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

<!-- Edit User Modal -->
<div class="modal fade" id="createCompetitionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Competition</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <?= form_open("admin/competitions/store"); ?>
        <div class="modal-body">

            <?= $this->include('Admin/Competitions/form'); ?>

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
              url: '<?= site_url('admin/competitions/search/') ?>',
              dataType: "json",
              data: {
                  term: request.term,
              },
          success: function (data) {
              if (data.length < 1) {
              var data = [
                  {
                  label: 'competition not found.',
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
            window.location.href = '<?php echo base_url('admin/competitions/show'); ?>/' + ui.item.id;
          }
        }
      });
    });

  </script>

<?= $this->endSection(); ?>