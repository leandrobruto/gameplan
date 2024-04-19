<div class="row">

    <!-- Hidden fields that we will use in the controller -->
    <input type="hidden" name="bet[user_id]" value="<?= $user->id; ?>" />
    
    <div class="col-md-6 mb-3">
        <label for="bankroll" class="form-label">Bankroll</label>
        <select class="form-select" id="bankroll" name="bet[bankroll_id]" aria-label="My Bankroll">
            <?php foreach($bankrolls as $bankroll): ?>
                <option value="<?= $bankroll->id; ?>" <?= (old('bet.bankroll_id') == $bankroll->id ? 'selected' : '') ?>><?= $bankroll->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="col-md-6 mb-3">
        <label class="form-label" for="name">Event</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-football"></i></span>
            <input type="text" id="name" name="event[name]" class="form-control" value="<?= old('event.name'); ?>"
            />
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="date" class="col-md-2 col-2 form-label">Date</label>
        <input type="date" id="date" name="bet[date]" value="<?= old('bet.date', date("Y-m-d")); ?>" class="form-control" <?= old('bet.date'); ?>
        />
    </div>

    <div class="col-md-6 mb-3">
        <label for="sport" class="form-label">Sport</label>
        <select class="form-select" id="sport" name="bet[sport_id]" aria-label="Sport">
            <?php foreach($sports as $sport): ?>
                <option value="<?= $sport->id; ?>" <?= (old('bet.sport_id', $user->default_sport_id) == $sport->id ? 'selected' : '') ?>><?= $sport->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="competition" class="form-label">Competition</label>
        <div class="input-group">
            <select class="form-select" id="competition" name="bet[competition_id]" aria-label="Competition">
                <?php foreach($competitions as $competition): ?>
                    <option value="<?= $competition->id; ?>" <?= (old('bet.competition_id') == $sport->id ? 'selected' : '') ?>>
                        <?= $competition->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span id="icon-name" type="button" class="input-group-text" data-bs-toggle="modal" data-bs-target="#createCompetitionModal" for="competition">
                <i class="bx bx-plus"></i>
            </span>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="strategy" class="form-label">Strategy</label>
        <div class="input-group">
            <select class="form-select" id="strategy" name="bet[strategy_id]" aria-label="Strategy">
                <?php foreach($strategies as $strategy): ?>
                    <option value="<?= $strategy->id; ?>" <?= (old('bet.strategy_id') == $sport->id ? 'selected' : '') ?>>
                        <?= $strategy->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span id="icon-name" type="button" class="input-group-text" data-bs-toggle="modal" data-bs-target="#createStrategyModal" for="competition">
                <i class="bx bx-plus"></i>
            </span>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="stake" class="form-label">Stake</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <input type="text" id="stake" name="bet[stake]" class="form-control money" value="<?= old('bet.stake', $user->default_stake); ?>"
            />
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="result" class="form-label">Result</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <input type="text" id="result" name="bet[result]" class="form-control money" value="<?= old('bet.result'); ?>"
            />
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="odd" class="form-label">Odd</label>
        <div class="input-group input-group-merge">
            <input type="text" id="odd" name="event[odd]" 
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
                class="form-control" value="<?= old('event.odd'); ?>"
            />
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="bet[description]" rows="3" ><?= old('bet.description'); ?></textarea>
    </div>

    <div class="col-md-12 mb-3 select-parent">
        <label for="tags" class="form-label">Tags</label>
        <select class="form-control select2" name="tags[]" multiple="multiple" style="width: 100%;"></select>
    </div>

    <div class="col-md-12 mb-3 select-parent">
        <label for="asd" class="form-label">Tags</label>
        <select class="form-control teste" name="asd[]" style="width: 100%;"></select>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="bet[is_pending]" value="0" />
            <input type="checkbox" class="form-check-input" name="bet[is_pending]" id="is_pending" value="1" />
            <label class="form-label" for="is_pending">Save as pending bet</label>
        </div>
    </div>
</div>
