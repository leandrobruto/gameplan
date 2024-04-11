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

<div class="col-xl-12 col-md-12 col-sm-6 mb-4">

  <h5 class="card-title"><?= $title ?></h5>

  <div class="row">
    <div class="col-6">
    <div class="ui-widget">
      <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input id="query" name="query" placeholder="Search.." class="form-control bg-light">
      </div>
    </div>
    </div>
    <div class="col-6 d-flex justify-content-end">
      <a href="#" type="button" class="btn btn-dark me-2">
        <i class="bx bx-import tf-icons"></i> 
        <strong>Import</strong>
      </a>
      <button 
        type="button" class="btn btn-secondary me-2"
        data-bs-toggle="modal"
        data-bs-target="#simpleBetModal">
        <i class="bx bx-plus tf-icons"></i> 
        <strong>Simple Bet</strong>
      </button>
      <button 
        type="button" class="btn btn-primary me-2"
        data-bs-toggle="modal"
        data-bs-target="#multipleBetModal">
        <i class="bx bx-plus tf-icons"></i> 
        <strong>Multiple Bet</strong>
      </button>
    </div>
  </div>
</div>

<div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
  <div class="row">
      <div class="col-lg-12 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-4 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="<?= site_url('assets/img/icons/unicons/chart-success.png'); ?>"
                      alt="Chart success"
                      class="rounded"
                    />
                  </div>
                </div>
                <span><strong>Bets</strong></span>
                <h3 class="card-title text-nowrap mb-1"><?= $count; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="<?= site_url('assets/img/icons/unicons/wallet.png'); ?>"
                      alt="Credit Card"
                      class="rounded"
                    />
                  </div>
                </div>
                <span><strong>Result</strong></span>
                <h3 class="card-title text-nowrap mb-1">$<?= $result; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="<?= site_url('assets/img/icons/unicons/cc-primary.png'); ?>"
                      alt="Credit Card"
                      class="rounded"
                    />
                  </div>
                </div>
                <span><strong>ROI</strong></span>
                <h3 class="card-title text-nowrap mb-1"><?= $roi; ?>%</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Hoverable Table rows -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title d-flex justify-content-between align-items-center"><?= $title ?></h5>

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Event</th>
            <th>Market</th>
            <th>Stake</th>
            <th>Result</th>
            <th>ROI</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php foreach ($bets as $bet): ?>
            <tr>
              <td><?= $bet->code; ?></td>
              <td><?= date("F jS, Y", strtotime($bet->date)); ?></td>
              <td><?= $bet->event; ?></td>
              <td><?= $bet->strategy; ?></td>
              <td>$<?= $bet->stake; ?></td>
              <td>$<?= $bet->result; ?></td>
              <td><?= number_format($bet->roi, 2); ?>%</td>
              <td class="d-flex justify-content-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#editBetModal" type="button">
                  <i class="bx bx-edit me-3"></i>
                </a>

                <a href="#" data-bs-toggle="modal" data-bs-target="#DeleteBetModal" type="button">
                  <i class="bx bx-trash text-danger me-3"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="d-flex justify-content-center mt-4">
        <?php if ($pager->getPageCount() > 1): ?>
          <?= $pager->links('default', 'default_pagination'); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!--/ Hoverable Table rows -->

<!-- Simple Bet Modal -->
<div class="modal fade" id="simpleBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Bet</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <?= form_open("manager/bets/store"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Bets/form'); ?>

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
<!-- / Simple Bet Modal -->

<!-- Multiple Bet Modal -->
<div class="modal fade" id="multipleBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Multiple Bet</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
        </button>
      </div>
      <?= form_open("manager/bets/store"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Bets/multiple_form'); ?>

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
<!-- / Multiple Bet Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

  <script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div class="row" id="inputFormRow">'
        html += '<div class="col-md-8 col-7 mb-3">'
        html += '<label class="form-label" for="selection">Selection</label>'
        html += '<div class="input-group input-group-merge">'
        html += '<span class="input-group-text"><i class="bx bx-football"></i></span>'
        html += '<input type="text" id="selection" name="event[]" class="form-control" />'
        html += '</div>'
        html += '</div>'

        html += '<div class="col-md-2 col-3 mb-3">'
        html += '<label for="odd" class="form-label">Odd</label>'
        html += '<div class="input-group input-group-merge">'
        html += '<input type="text" id="odd" name="odd[]" class="form-control" value="" />'
        html += '</div>'
        html += '</div>'
        html += '<div class="col-md-2 col-2 px-1 mb-3 d-flex align-self-end">'
        html += '<button id="removeRow" type="button" class="btn btn-danger p-2">'
        html += '<i class="bx bx-trash tf-icons"></i></button>'
        html += '</div>'
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
  </script>

<?= $this->endSection(); ?>