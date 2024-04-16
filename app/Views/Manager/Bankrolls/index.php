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
      <a class="nav-link" href="<?= site_url('manager/account/competitions'); ?>"
        ><i class="bx bx-trophy me-1"></i> Competitions</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="<?= site_url('manager/account/bankrolls'); ?>"
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
          data-bs-target="#createBabkrollsModal">
          <i class="bx bx-plus tf-icons"></i>
          Create
        </button>
      </h5>

      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Initial Balance</th>
              <th>Actual Balance</th>
              <th>Currency</th>
              <th>Initial Date</th>
              <th>Comission</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php foreach ($bankrolls as $bankroll): ?>
              <tr>
                <td><?= $bankroll->name; ?></td>
                <td>$<?= $bankroll->initial_balance; ?></td>
                <td>$<?= $bankroll->initial_balance; ?></td>
                <td><?= $bankroll->currency; ?></td>
                <td><?= $bankroll->created_at->humanize(); ?></td>
                <td><?= $bankroll->comission; ?>%</td>
                <td class="d-flex justify-content-end">
                  <a href="#" class="text-primary" 
                    data-bankroll-id="<?= $bankroll->id ?>"
                    data-bankroll-name="<?= $bankroll->name ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#resetBankrollModal" type="button">
                    <i class="bx bx-refresh me-3"></i>
                  </a>

                  <a href="#" class="text-primary" 
                    data-id="<?= $bankroll->id ?>"
                    data-name="<?= $bankroll->name ?>"
                    data-currency-id="<?= $bankroll->currency_id ?>"
                    data-initial-balance="<?= $bankroll->initial_balance ?>"
                    data-initial-date="<?= $bankroll->initial_date ?>"
                    data-comission="<?= $bankroll->comission ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#editBankrollModal" type="button">
                    <i class="bx bx-edit-alt me-3"></i>
                  </a>
                  
                  <a href="#" class="text-danger" 
                    data-bankroll-id="<?= $bankroll->id ?>"
                    data-bankroll-name="<?= $bankroll->name ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteBankrollModal" type="button">
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

<!-- Create Bankrolls Modal -->
<div class="modal fade" id="createBabkrollsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Bankroll</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open("manager/bankrolls/store"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Bankrolls/form'); ?>

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
<!-- / Create Bankrolls Modal -->

<!-- Hidden Input bankroll to use on update and delete forms -->
<?php $hidden = ['bankroll_id' => '']; ?>

<!-- Reset Bankroll Modal -->
<div class="modal fade" id="resetBankrollModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Reset Bankroll</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <div class="card">
        <div class="card-body py-2">
            
          <?= form_open("manager/bankrolls/reset", '', $hidden); ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Attention!</strong> Are you sure about reset the bankroll <strong id="bankroll_name"></strong>
            </div>

            <button type="submit" class="btn btn-danger mb-2">
              <i class="bx bx-refresh tf-icons"></i>
              Reset
            </button>

          <?= form_close(); ?>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Reset Bankroll Modal -->

<!-- Edit Bankroll Modal -->
<div class="modal fade" id="editBankrollModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Edit Competition</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            
      <?= form_open("manager/bankrolls/update", '', $hidden); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Bankrolls/form'); ?>

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
<!-- / Edit Bankroll Modal -->

<!-- Delete Bankroll Modal -->
<div class="modal fade" id="deleteBankrollModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Deleting Bankroll</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <div class="card">
        <div class="card-body py-2">
            
          <?= form_open("manager/bankrolls/delete", '', $hidden); ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Attention!</strong> Are you sure about deleting the bankroll <strong id="bankroll_name"></strong>
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
<!-- / Delete Bankroll Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

  <script>
    $('#resetBankrollModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();
console.log(data);
      $("[name='bankroll_id']").val(data.bankrollId);
      $("#bankroll_name").text(data.bankrollName);
    });
  </script>

  <script>
    $('#editBankrollModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='bankroll_id']").val(data.id);
      $("[name='name']").val(data.name);
      $("[name='currency_id']").val(data.currencyId);
      $("[name='initial_balance']").val(data.initialBalance);
      $("[name='initial_date']").val(data.initialDate);
      $("[name='comission']").val(data.comission);
    });
  </script>

  <script>
    $('#deleteBankrollModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='bankroll_id']").val(data.bankrollId);
      $("#bankroll_name").text(data.bankrollName);
    });
  </script>

<?= $this->endSection(); ?>