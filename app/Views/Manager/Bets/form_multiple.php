<div id="newRow"></div>
    
<div class="row">
    <div class="col-6">
        <button id="addRow" type="button" class="btn btn-primary mb-3">
            <i class="bx bx-add-to-queue tf-icons"></i></button>
        </button>
    </div>
    <div class="col-6 p-2">
        <div class="text-dark" id="odd_amount"></div>
    </div>
</div>

<div class="row">
    <!-- Hidden fields that we will use in the controller -->
    <input type="hidden" name="bet[user_id]" value="<?= $user->id; ?>" />


    <div class="col-md-12 mb-3">
        <label class="form-label" for="description">Description</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-pencil"></i></span>
            <input type="text" id="description" name="bet[description]" class="form-control" />
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="bankroll" class="form-label">Bankroll</label>
        <select class="form-select" id="bankroll" name="bet[bankroll_id]" aria-label="My Bankroll">
            <?php foreach($bankrolls as $bankroll): ?>
                <option value="<?= $bankroll->id; ?>" <?= (old('bet.bankroll_id') == $bankroll->id ? 'selected' : '') ?>><?= $bankroll->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="col-md-6 mb-3">
        <label for="date" class="col-md-2 col-form-label">Date</label>
        <input type="date" id="date" name="bet[date]" value="<?= old('bet.date', date("Y-m-d")); ?>" class="form-control" <?= old('bet.date'); ?>
        />
    </div>

    <div class="col-md-6 mb-3">
        <label for="stake" class="form-label">Stake</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <input type="text" id="stake" name="bet[stake] "class="form-control money" value="" />
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="result" class="form-label">Result</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <input type="text" id="result" name="bet[result]" class="form-control money" value="" />
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="justification" class="form-label">Justification</label>
        <textarea class="form-control" id="justification" name="bet[description]" rows="3"></textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select class="form-select" id="tags" name="tags" aria-label="Tags">
            <option value="1">The list is empty</option>
        </select>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="bet[pending]" value="0" />
            <input type="checkbox" class="form-check-input" name="bet[pending]" id="pending" value="1" />
            <label class="form-label" for="pending">Save as pending bet</label>
        </div>
    </div>
</div>