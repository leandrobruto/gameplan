<div class="row">

    <!-- Hidden fields that we will use in the controller -->
    <input type="hidden" name="user_id" value="<?= $user->id; ?>" />

    <div class="col-md-12 mb-3">
        <label class="form-label" for="name">Old Competition</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-trophy"></i>
            </span>
            <input type="text" id="old_name" name="old_name" class="form-control" value="<?= old('old_name'); ?>" disabled />
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label for="competition_id" class="form-label">Competition</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-trophy"></i>
            </span>
            <select class="form-select" id="competition_id" name="competition_id" aria-label="Competition">
                <?php foreach($competitions as $competition): ?>
                    <option value="<?= $competition->id; ?>" <?= (old('competition_id') == $competition->id ? 'selected' : '') ?>><?= $competition->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>