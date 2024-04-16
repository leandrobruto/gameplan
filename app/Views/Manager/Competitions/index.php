<?= $this->extend('layout/main'); ?>

<!-- Here we send the title to the main template -->
<?= $this->section('title'); ?>

  <?= $title; ?>

<?= $this->endSection(); ?>

<!-- Here we send the styles to the main template -->
<?= $this->section('styles'); ?>



<?= $this->endSection(); ?>

<!-- Here we send the content to the main template -->
<?= $this->section('content'); ?>

<?= $this->include('Manager/Bankrolls/initial_balance_form'); ?>

<div class="col-md-12">
  <ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('manager/account/profile'); ?>"><i class="bx bx-user me-1"></i> Account</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('manager/account/strategies'); ?>"
        ><i class="bx bx-abacus me-1"></i> Strategies</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="<?= site_url('manager/account/competitions'); ?>"
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
                  <a href="#" class="text-primary" 
                    data-competition-id="<?= $competition->id ?>"
                    data-competition-name="<?= $competition->name ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#transferCompetitionModal" type="button">
                    <i class="bx bx-transfer me-3"></i>
                  </a>

                  <a href="#" class="text-primary" 
                    data-competition-id="<?= $competition->id ?>"
                    data-competition-name="<?= $competition->name ?>"
                    data-sport-id="<?= $competition->sport_id ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#editCompetitionModal" type="button">
                    <i class="bx bx-edit-alt me-3"></i>
                  </a>
                  
                  <a href="#" class="text-danger" 
                    data-competition-id="<?= $competition->id ?>"
                    data-competition-name="<?= $competition->name ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteCompetitionModal" type="button">
                    <i class="bx bx-trash me-3"></i>
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

<!-- Create Competition Modal -->
<div class="modal fade" id="createCompetitionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Competition</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open("manager/competitions/store"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Competitions/form'); ?>

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
<!-- / Create Competition Modal -->

<!-- Hidden Input competition_id to use on update and delete forms -->
<?php $hidden = ['competition_id' => '']; ?>

<!-- Transfer Competition Modal -->
<div class="modal fade" id="transferCompetitionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Transfer Competition</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open("manager/competitions/update"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Competitions/form_transfer'); ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x tf-icons"></i>  
            Close
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bx bx-transfer tf-icons"></i>  
            Migrate
          </button>
        </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Transfer Competition Modal -->

<!-- Edit Competition Modal -->
<div class="modal fade" id="editCompetitionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Edit Competition</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            
      <?= form_open("manager/competitions/update", '', $hidden); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Competitions/form'); ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x tf-icons"></i>  
            Close
          </button>
          <button type="submit" class="btn btn-primary mb-2">
            <i class="bx bx-save tf-icons"></i>  
            Update
          </button>
        </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- / Edit Competition Modal -->

<!-- Delete Competition Modal -->
<div class="modal fade" id="deleteCompetitionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Deleting Competition</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <div class="card">
        <div class="card-body py-2">
            
          <?= form_open("manager/competitions/delete", '', $hidden); ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Attention!</strong> Are you sure about deleting the competition <strong id="competition_name"></strong>
            </div>

            <button type="submit" class="btn btn-danger mb-2">
              <i class="bx bx-trash-alt tf-icons"></i>
              Delete
            </button>

          <?= form_close(); ?>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Delete Competition Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

  <script>
    $('#transferCompetitionModal').on('show.bs.modal', function (event) {console.log(event);
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='competition_id']").val(data.competitionId);
      $("[name='old_name']").val(data.competitionName);
    });
  </script>

  <script>
    $('#editCompetitionModal').on('show.bs.modal', function (event) {console.log(event);
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='competition_id']").val(data.competitionId);
      $("[name='name']").val(data.competitionName);
      $("[name='sport_id']").val(data.sportId);
    });
  </script>

  <script>
    $('#deleteCompetitionModal').on('show.bs.modal', function (event) {console.log(event);
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='competition_id']").val(data.competitionId);
      $("#competition_name").text(data.competitionName);
    });
  </script>

<?= $this->endSection(); ?>