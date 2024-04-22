<div class="row">
    <!-- Hidden fields that we will use in the controller -->
    <input type="hidden" name="bankroll_id" value="<?= $bankroll->id; ?>" />

    <div class="col-md-6 mb-3">
        <label for="date" class="col-md-2 col-2 form-label">Date</label>
        <input type="date" id="date" name="date" value="<?= old('date', date("Y-m-d")); ?>" class="form-control" <?= old('date'); ?>
        />
    </div>

    <div class="col-md-12">
        <label class="form-label" for="value">Value</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <input type="text" id="value" name="value" class="form-control money" value=""
            />
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" ><?= old('description'); ?></textarea>
    </div>
</div>
