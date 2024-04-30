<?= $this->extend('layout/main'); ?>

<!-- Here we send the title to the main template -->
<?= $this->section('title'); ?>

  <?= $title; ?>

<?= $this->endSection(); ?>

<!-- Here we send the styles to the main template -->
<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= site_url('assets/vendor/select2/select2.min.css'); ?>" rel="stylesheet"/>

<?= $this->endSection(); ?>

<!-- Here we send the content to the main template -->
<?= $this->section('content'); ?>

<?= $this->include('Manager/Account/Bankrolls/initial_balance_form'); ?>

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
      <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12 mb-4">
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
                <span class="fw-semibold d-block mb-1">Bets</span>
                <h3 class="card-title text-nowrap mb-1"><?= $reports->total_bets; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12 mb-4">
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
                <span class="fw-semibold d-block mb-1">Result</span>
                <h3 class="card-title text-nowrap mb-1 <?= $reports->result_sum > 0 ? 'text-success' : 'text-dark'; ?>">
                  $<?= number_format($reports->result_sum, 2); ?>
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12 mb-4">
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
                <span class="fw-semibold d-block mb-1">ROI</span>
                <h3 class="card-title text-nowrap mb-1 <?= $reports->roi > 0 ? 'text-success' : 'text-dark'; ?>">
                  <?= floatval(number_format($reports->roi, 2)); ?>%
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $request = \Config\Services::request(); ?>
  
<ul class="nav nav-pills flex-column flex-md-row mb-3">
  <li class="nav-item">
    <a class="nav-link <?= $request->uri->getQuery() == 'pending=0' ? 'active' : ''; ?>" href="<?= site_url('manager/bets?pending=0'); ?>">
      <i class="bx bx-trophy me-1"></i> Completed
      <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-info">
        <?= $countCompleted ?>
      </span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $request->uri->getQuery() == 'pending=1' ? 'active' : ''; ?>" href="<?= site_url('manager/bets?pending=1'); ?>">
      <i class="bx bx-hourglass me-1"></i> Pending
      <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-warning">
        <?= $countPending ?>
      </span>
    </a>
  </li>
</ul>

<!-- Hoverable Table rows -->
<div class="card mb-2">
  <div class="card-body">

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Event</th>
            <th>Market</th>
            <th>Stake</th>
            <?php if (!$pending): ?>
              <th>Result</th>
              <th>ROI</th>
            <?php else: ?>
              <th>ODD</th>
              <th>Potential Profit</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php foreach ($bets as $bet): ?>
            <tr>
              <td><?= $bet->code; ?></td>
              <td><?= date("F jS, Y", strtotime($bet->date)); ?></td>
              <td><?= $bet->event; ?></td>
              <td><?= isset($bet->strategy) ? $bet->strategy : ''; ?></td>
              <td>$<?= $bet->stake; ?></td>

              <?php if (!$pending): ?>
                <td class="<?= $bet->result > 0 ? 'text-success' : 'text-dark'; ?>">$<?= $bet->result; ?></td>
                <td class="<?= $bet->roi > 0 ? 'text-success' : 'text-dark'; ?>"><?= number_format($bet->roi, 2); ?>%</td>    
              <?php else: ?>
                <td><?= $bet->odd; ?></td>
                <td>$<?= number_format($bet->result, 2); ?></td>
              <?php endif; ?>
            
              <td class="d-flex justify-content-end">
                <a href="#" class="text-primary" 
                    data-id="<?= $bet->id ?>"
                    data-event="<?= $bet->event ?>"
                    data-date="<?= $bet->date ?>"
                    data-sport-id="<?= $bet->sport_id ?>"
                    data-competition-id="<?= $bet->competition_id ?>"
                    data-strategy-id="<?= $bet->strategy_id ?>"
                    data-stake="<?= $bet->stake ?>"
                    data-result="<?= $bet->result ?>"
                    data-odd="<?= $bet->odd ?>"
                    data-description="<?= $bet->description ?>"
                    data-is-pending="<?= $bet->is_pending ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#editSimpleBetModal" type="button">
                    <i class="bx bx-edit-alt me-3"></i>
                  </a>

                <a href="#" class="text-danger" 
                    data-bet-id="<?= $bet->id ?>"
                    data-bet-event="<?= $bet->event ?>"
                    data-bs-toggle="modal" data-bs-target="#deleteBetModal" type="button">
                  <i class="bx bx-trash text-danger me-3"></i>
                </a>

                <?php if ($pending): ?>
                  <a href="#" 
                    data-bet-id="<?= $bet->id ?>"
                    data-bet-result="<?= $bet->result ?>"
                    data-is-pending="0"
                    data-bs-toggle="modal" data-bs-target="#updateBetModal" type="button">
                  <i class="bx bx-check text-success me-3"></i>
                  </a>
                  
                  <a href="#" 
                      data-bet-id="<?= $bet->id ?>"
                      data-bet-result="<?= $bet->stake * -1 ?>"
                      data-bs-toggle="modal" data-bs-target="#updateBetModal" type="button">
                    <i class="bx bx-x text-danger me-3"></i>
                  </a>
                  
                  <a href="#" 
                      data-bet-id="<?= $bet->id ?>"
                      data-bet-result="0"
                      data-bs-toggle="modal" data-bs-target="#updateBetModal" type="button">
                    <i class="bx bx-pause text-primary me-3"></i>
                  </a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="d-flex justify-content-center mt-4">
        <?php if (empty($bets)): ?>
            No Bets Found.
        <?php endif; ?>

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
  <div class="modal-dialog modal-md" role="document">
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


<!-- Hidden Input bet_id to use on update and delete forms -->
<?php $hidden = ['bet_id' => '']; ?>

<!-- Edit Bet Modal -->
<div class="modal fade" id="editSimpleBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Edit Bet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            
      <?= form_open("manager/bets/update", '', $hidden); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Bets/form_update'); ?>

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
<!-- / Edit Bet Modal -->

<!-- Update Bet Modal -->
<div class="modal fade" id="updateBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Final Result</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            
      <?= form_open("manager/bets/updateResult", '', $hidden); ?>
        <div class="modal-body">

          <div class="row">
            <!-- Hidden fields that we will use in the controller -->
            <input type="hidden" name="is_pending" value="" />

            <div class="col-md-12 mb-3">
              <label for="result" class="form-label">Result</label>
              <div class="input-group input-group-merge">
                <span id="icon-name" class="input-group-text">
                    <i class="bx bx-dollar"></i>
                </span>
                <input type="text" id="result" name="result" class="form-control money" value="<?= old('bet.result'); ?>"/>
              </div>
            </div>
          </div>

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
<!-- / Update Bet Modal -->


<!-- Multiple Bet Modal -->
<div class="modal fade" id="multipleBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
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
      <?= form_open("manager/bets/storeMultiple"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Bets/form_multiple'); ?>

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

<!-- Create Competition Modal -->
<div class="modal fade" id="createCompetitionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Competition</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open("manager/account/competitions/store"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Account/Competitions/form'); ?>

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

<!-- Store Strategy Modal -->
<div class="modal fade" id="createStrategyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create New Strategy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open("manager/account/strategies/store"); ?>
        <div class="modal-body">

          <?= $this->include('Manager/Account/Strategies/form'); ?>

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
<!-- / Store Strategy Modal -->

<!-- Delete Bet Modal -->
<div class="modal fade" id="deleteBetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Deleting Bet</h5>
          <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close">
          </button>
      </div>
      <div class="card">
        <div class="card-body py-2">
            
          <?= form_open("manager/bets/delete", '', $hidden); ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Attention!</strong> Are you sure about deleting the bet <strong id="bet_event"></strong>?
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
<!-- / Delete Bet Modal -->

<?= $this->endSection(); ?>

<!-- Here we send the scripts to the main template -->
<?= $this->section('scripts'); ?>

  <script src="<?php echo site_url('assets/vendor/mask/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo site_url('assets/vendor/mask/app.js') ?>"></script>

  <script src="<?php echo site_url('assets/vendor/select2/select2.min.js') ?>"></script>

  <script type="text/javascript">
    
    var index = 0;
    var countSelections = 1;

    var html = '';
    html += '<div class="row" id="inputFormRow-' + index + '">'

    html += '<div class="col-lg-6 col-6 mb-3">'
    html += '<label class="form-label" for="name">Selection</label>'
    html += '<div class="input-group input-group-merge">'
    html += '<span class="input-group-text"><i class="bx bx-football"></i></span>'
    html += '<input type="text" name="event[' + index + '][name]" class="form-control" />'
    html += '</div>'
    html += '</div>'

    html += '<div class="col-lg-4 col-4 mb-3">'
    html += '<label for="odd" class="form-label">Odd</label>'
    html += '<div class="input-group input-group-merge">'
    html += '<input type="text" name="event[' + index + '][odd]" class="form-control target" value="" onkeyup="oddsCalculator()" />'
    html += '</div>'
    html += '</div>'

    html += '<div class="col-lg-2 col-2 mb-3 d-flex justify-content-center align-self-end">---'
    html += '</div>'

    html += '</div>';

    $('#newRow').append(html);

    function oddsCalculator() {
      var amount = 1;

      $('.target').each(function(){
        var value = Number($(this).val());

        if (!isNaN(value) && value >= 1) amount = (amount * value);

      });

      if (amount >= 1)
        $("#odd_amount").html(amount.toFixed(2));
    }

    // add row
    $("#addRow").click(function () {

      index += 1;

      var html = '';
      html += '<div class="row" id="inputFormRow-' + index + '">'

      html += '<div class="col-lg-6 col-6 mb-3">'
      html += '<label class="form-label" for="name">Selection</label>'
      html += '<div class="input-group input-group-merge">'
      html += '<span class="input-group-text"><i class="bx bx-football"></i></span>'
      html += '<input type="text" name="event[' + index + '][name]" class="form-control" />'
      html += '</div>'
      html += '</div>'

      html += '<div class="col-lg-4 col-4 mb-3">'
      html += '<label for="odd" class="form-label">Odd</label>'
      html += '<div class="input-group input-group-merge">'
      html += '<input type="text" id="input-' + index + '" name="event[' + index + '][odd]" class="form-control target" value="" onkeyup="oddsCalculator()" />'
      html += '</div>'
      html += '</div>'

      html += '<div class="col-lg-2 col-2 mb-3 d-flex justify-content-center align-self-end">'
      html += '<a id="removeRow" type="button" onclick="removeRow(' + index + ')" class="text-danger p-2">'
      html += '<i class="bx bx-trash tf-icons"></i></a>'
      html += '</div>'

      html += '</div>';

      $('#newRow').append(html);

    });

    // remove row
    function removeRow(rowIndex) {

      $('#inputFormRow-' + rowIndex).remove();

      // Recalculate odds
      oddsCalculator();

    };
  </script>

  <script>

  $(".teste").select2({
    minimumInputLength: 2,
    ajax: {
      url: '<?= site_url('manager/bets/tags'); ?>',
      dataType: 'json',
      data: function (term) {
        return {
          term: term
        };
      },
      processResults: function (data) {
        console.log(data);
        return {
          results: $.map(data, function (item) {
            return {
              text: 'so tiene mancos',
              id: 1,
            }
          })
        };
      }
    }
  })

    $('.select2').select2({
      dropdownParent: $('.select-parent'),
      data: ["Piano", "Flute", "Guitar", "Drums", "Photography"],
      tags: true,
      maximumSelectionLength: 10,
      tokenSeparators: [',', ' '],
      placeholder: "Select or type keywords",
      minimumInputLength: 1,
      ajax: {
        url: '<?= site_url('manager/bets/tags'); ?>',
        dataType: 'json',
        data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;
// console.log(data);
        // return {
        //   results: '[{"id": 1,"text": "Option 1"},{"id": 2,"text": "Option 2"}]',
        //   pagination: {
        //     more: (params.page * 30) < data.total_count
        //   }
        // };
        $.map(data, function (item) {
          return {
              text: 'item.name',
              id: 'item.id',
          }
        })
      },
      cache: true
    }
  });
  </script>

  <script>
    $('#editSimpleBetModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='bet_id']").val(data.id);
      $("[name='event[name]']").val(data.event);
      $("[name='bet[date]']").val(data.date);
      $("[name='bet[competition_id]']").val(data.competitionId);
      $("[name='bet[strategy_id]']").val(data.strategyId);
      $("[name='bet[stake]']").val(data.stake);
      $("[name='bet[result]']").val(data.result);
      $("[name='event[odd]']").val(data.odd);
      $("[name='bet[description]']").val(data.description);
      $("[name='bet[is_panding]']").val(data.isPending);
    });
  </script>

  <script>
    $('#updateBetModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();
console.log(data.betResult);
      $("[name='bet_id']").val(data.betId);
      $("[name='result']").val(data.betResult);
      $("[name='is_pending']").val(data.isPending);
    });
  </script>
  
  <script>
    $('#deleteBetModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      var data = button.data();

      $("[name='bet_id']").val(data.betId);
      $("#bet_event").text(data.betEvent);
    });
  </script>

<?= $this->endSection(); ?>