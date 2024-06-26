<div class="row">
        
    <!-- Hidden fields that we will use in the controller -->
    <input type="hidden" name="user_id" value="<?= $user->id; ?>" />

    <div class="col-md-12 mb-3">
        <label class="form-label" for="name">Name</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-wallet"></i>
            </span>
            <input type="text" id="name" name="name" class="form-control" value="<?= old('name'); ?>" required />
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="currency_id" class="form-label">Currencies</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <select class="form-select" id="currency_id" name="currency_id" aria-label="Sport">
                <?php foreach($currencies as $currency): ?>
                    <option value="<?= $currency->id; ?>" <?= (old('currency_id') == $currency->id ? 'selected' : '') ?>><?= $currency->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="initial_balance">Initial Balance</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-money"></i>
            </span>
            <input type="text" id="initial_balance" name="initial_balance" class="form-control" value="" />
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="initial_date" class="form-label">Initial Date</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-calendar"></i>
            </span>
            <input type="date" id="initial_date" name="initial_date" value="<?= old('initial_date', date("Y-m-d")); ?>" class="form-control" <?= old('date'); ?>/>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="comission" class="form-label">Comission(%)</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <input type="text" id="comission" name="comission" class="form-control money" value="<?= old('comission'); ?>" />
        </div>
    </div>
</div>