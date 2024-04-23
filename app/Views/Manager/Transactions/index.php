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

<?= $this->include('Manager/Account/Bankrolls/initial_balance_form'); ?>

<div class="col-xl-12 col-md-12 col-sm-6 mb-4">

  <h5 class="card-title"><?= $title ?></h5>
  
  <div class="row">
    <div class="col-12 d-flex justify-content-start">
      <button 
        type="button" class="btn btn-primary me-2"
        data-bs-toggle="modal"
        data-bs-target="#withdrawalModal">
        <i class="bx bx-up-arrow-alt tf-icons"></i> 
        <strong>Add Withdrawal</strong>
      </button>
      <button 
        type="button" class="btn btn-secondary me-2"
        data-bs-toggle="modal"
        data-bs-target="#depositModal">
        <i class="bx bx-down-arrow-alt tf-icons"></i> 
        <strong>Add deposit</strong>
      </button>
    </div>
  </div>
</div>

<div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
  <div class="row">
      <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2">
                      <i class='bx bx-money'></i>
                    </span>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Withdrawals</span>
                <h3 class="card-title text-nowrap mb-1">$<?= number_format($reports->withdrawal, 2); ?></h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2">
                      <i class='bx bx-credit-card'></i>
                    </span>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Deposits</span>
                <h3 class="card-title text-nowrap mb-1">
                  $<?= number_format($reports->deposit, 2); ?>
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="badge bg-label-primary p-2">
                      <i class='bx bx-wallet'></i>
                    </span>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Result</span>
                <h3 class="card-title text-nowrap mb-1 <?= $reports->deposit < $reports->withdrawal ? 'text-success' : 'text-danger'; ?>">
                  $<?= number_format($reports->result, 2); ?>
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Hoverable Table rows -->
<div class="card mb-2">
  <div class="card-body">

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php foreach ($transactions as $transaction): ?>
            <tr>
              <td>
                <?php if ($transaction->type == 'Deposit'): ?>
                  <i class='bx bx-sm bx-down-arrow-alt text-success'></i>
                <?php else: ?>
                  <i class='bx bx-sm bx-up-arrow-alt text-danger'></i>
                <?php endif; ?>
                <?= date("F jS, Y", strtotime($transaction->date)); ?>
              </td>
              <td><?= $transaction->type; ?></td>
              <td class="<?= $transaction->type == 'Deposit' ? 'text-success' : ''; ?>">
                $<?= $transaction->value; ?></td>
              <td class="d-flex justify-content-end">
                <a href="#" 
                  data-transaction-id="<?= $transaction->id ?>"
                  data-transaction-date="<?= $transaction->date ?>"
                  data-transaction-value="<?= $transaction->value ?>"
                  data-transaction-type="<?= $transaction->transaction_type_id ?>"
                  data-description="<?= $transaction->description; ?>"
                  data-bs-toggle="modal"
                  data-bs-target="#editTransactionModal">
                  <i class="bx bx-edit-alt me-3"></i>
                </a>

                <a href="#"
                  data-transaction-id="<?= $transaction->id ?>"
                  data-transaction-type="<?= $transaction->transaction_type_id ?>"
                  data-bs-toggle="modal"
                  data-bs-target="#deleteTransactionModal">
                  <i class="bx bx-trash text-danger me-3"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="d-flex justify-content-center mt-4">
        <?php if (empty($transactions)): ?>
            No Transactions Found.
        <?php endif; ?>

        <?php if ($pager && $pager->getPageCount() > 1): ?>
          <?= $pager->links('default', 'default_pagination'); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!--/ Hoverable Table rows -->

<!-- Create Deposit Modal -->
<div class="modal fade" id="depositModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">New Deposit</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
        <?= form_open("manager/transactions/store", '', ['transaction_type_id' => 1]); ?>
          <div class="modal-body">

            <?= $this->include('Manager/Transactions/form'); ?>

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
<!-- / Create Deposit Modal -->

<!-- Create Withdrawal Modal -->
<div class="modal fade" id="withdrawalModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">New Withdrawal</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
        <?= form_open("manager/transactions/store", '', ['transaction_type_id' => 2]); ?>
          <div class="modal-body">

            <?= $this->include('Manager/Transactions/form'); ?>

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
<!-- / Create Withdrawal Modal -->

<!-- Hidden Input transaction_id to use on update and delete forms -->
<?php $hidden = ['transaction_id' => '']; ?>

<!-- Edit Transaction Modal -->
<div class="modal fade" id="editTransactionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Edit Transaction</h5>
          <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
          </button>
        </div>
        <?= form_open("manager/transactions/update", '', $hidden); ?>
            <div class="modal-body">

                <?= $this->include('Manager/Transactions/form'); ?>

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
<!-- / Edit Transaction Modal -->

<!-- Delete Transaction Modal -->
<div class="modal fade" id="deleteTransactionModal" tabindex="-1" aria-hidden="true">
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
              
            <?= form_open("manager/transactions/delete", '', $hidden); ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Attention!</strong> Are you sure about deleting the Transaction <strong id="transaction_type"></strong>?
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
<!-- / Delete Transaction Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

  <script type="text/javascript">
    
    $('#editTransactionModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();
      console.log(data);

      $("[name='transaction_id']").val(data.transactionId);
      $("[name='date']").val(data.transactionDate);
      $("[name='value']").val(data.transactionValue);
      $("[name='transaction_type_id']").val(data.transactionType);
      $("[name='description']").val(data.description);

    });

  </script>

  <script>
    $('#deleteTransactionModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='transaction_id']").val(data.transactionId);
      $("#transaction_type").text(data.transactionType);
    });
  </script>

<?= $this->endSection(); ?>