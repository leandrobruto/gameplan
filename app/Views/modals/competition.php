<!-- Create Competition Modal -->
<div class="modal fade" id="createCompetitionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
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