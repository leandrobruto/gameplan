<div class="row">
    <div class="col-md-12 mb-3">
        <label class="form-label" for="name">Name</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-sport"></i>
            </span>
            <input type="text" id="name" name="name" class="form-control" value="" />
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label" for="description">Description</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-sport"></i>
            </span>
            <input type="text" id="name" name="description" class="form-control" value="" />
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="sport" class="form-label">Currencies</label>
        <select class="form-select" id="curency" name="currency_id" aria-label="Sport">
            <?php foreach($currencies as $currency): ?>
                <option value="<?= $currency->id; ?>" <?= (old('currency_id') == $currency->id ? 'selected' : '') ?>><?= $currency->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>