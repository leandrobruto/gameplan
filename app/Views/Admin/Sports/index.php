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

      <div class="row mb-4">
        <div class="col-6">
          <div class="ui-widget">
            <div class="input-group input-group-merge">
              <input id="query" name="query" placeholder="Search.." class="form-control bg-light">
            </div>
          </div>
        </div>
        <div class="col-6 d-flex justify-content-end">
          <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#createSportModal">
            <i class="bx bx-plus tf-icons"></i>
            Create
          </button>
        </div>
      </div>

      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>sports</th>
              <th>created at</th>
              <th>Updated at</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php foreach ($sports as $key => $sport): ?>
              <tr>
                <td>
                  <?= $sport->name; ?>
                </td>
                <td>
                  <?= $sport->created_at->humanize(); ?>
                </td>
                <td>
                    <?= $sport->updated_at->humanize(); ?>
                </td>
                <td class="d-flex justify-content-end">
                  <?php if ($sport->deleted_at): ?>
                    <span class="badge bg-label-danger me-3">Deleted</span>
                  <?php endif; ?>

                  <a href="#" 
                    data-sport-id="<?= $sport->id ?>"
                    data-sport-name="<?= $sport->name ?>"
                    data-bs-toggle="modal"
                    data-bs-target="#editSportModal">
                    <i class="bx bx-edit-alt me-3"></i>
                  </a>

                  <?php if ($sport->deleted_at): ?>
                    <a href="<?= site_url('admin/sports/undelete/' . $sport->id); ?>">
                      <i class="bx bx-undo text-dark me-3"></i>
                    </a>
                  <?php else: ?>
                    
                    <a href="#"
                      data-sport-id="<?= $sport->id ?>"
                      data-sport-name="<?= $sport->name ?>"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteSportModal">
                      <i class="bx bx-trash text-danger me-3"></i>
                    </a>
                  <?php endif; ?>
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

<!-- Create Sport Modal -->
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
      <?= form_open("admin/sports/store"); ?>
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
                Save
            </button>
        </div>
    <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Create Sport Modal -->


<!-- Hidden Input sport_id to use on update and delete forms -->
<?php $hidden = ['sport_id' => '']; ?>

<!-- Edit Sport Modal -->
<div class="modal fade" id="editSportModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Edit Sport</h5>
            <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close">
            </button>
        </div>
        <?= form_open("admin/sports/update", '', $hidden); ?>
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
                    Save
                </button>
            </div>
        <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Edit Sport Modal -->

<!-- Delete Sport Modal -->
<div class="modal fade" id="deleteSportModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Deleting Sport</h5>
            <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close">
            </button>
        </div>
        <div class="card">
            <div class="card-body py-2">
                
                <?= form_open("admin/sports/delete", '', $hidden); ?>

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Attention!</strong> Are you sure about deleting the sport <strong id="sport_name"></strong>?
                </div>

                <button type="submit" class="btn btn-danger mb-2">
                    <i class="bx bx-trash-alt tf-icons"></i>
                    Delete
                </button>

            </div>
          </div>

        <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Delete Sport Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?= site_url('assets/vendor/auto-complete/jquery-ui.js') ?>"></script>  
  
  <script type="text/javascript">
    
    $('#editSportModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='sport_id']").val(data.sportId);
      $("[name='name']").val(data.sportName);

    });

  </script>

  <script>
    $('#deleteSportModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='sport_id']").val(data.sportId);
      $("#sport_name").text(data.sportName);
    });
  </script>
  
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
            window.location.href = '<?php echo base_url('admin/sports'); ?>';
          }
        }
      });
    });

  </script>

<?= $this->endSection(); ?>