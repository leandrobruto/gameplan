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

    <div class="col-md-6 mb-3">
        <label for="sport" class="form-label">Currencies</label>
        <select class="form-select" id="curency" name="currency_id" aria-label="Sport">
            <?php foreach($currencies as $currency): ?>
                <option value="<?= $currency->id; ?>" <?= (old('currency_id') == $currency->id ? 'selected' : '') ?>><?= $currency->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="initial_balance">Initial Balance</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-sport"></i>
            </span>
            <input type="text" id="initial_balance" name="initial_balance" class="form-control" value="" />
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="date" class="col-md-2 col-6 form-label">Date</label>
        <input type="date" id="date" name="date" value="<?= old('date'); ?>" class="form-control" <?= old('date'); ?>
        />
    </div>

    <div class="col-md-6 mb-3">
        <label for="comission" class="form-label">Comission(%)</label>
        <div class="input-group input-group-merge">
            <input type="text" id="comission" name="comission" class="form-control money" value="<?= old('comission'); ?>"
            />
        </div>
    </div>
</div>