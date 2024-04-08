<div class="row">
    <div class="col-md-12 mb-3">
        <label class="form-label" for="name">Name</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-sport"></i>
            </span>
            <input type="text" id="name"name="name"class="form-control" value="" />
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label" for="name">Description</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-sport"></i>
            </span>
            <input type="text" id="name"name="name"class="form-control" value="" />
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="sport" class="form-label">Sport</label>
        <select class="form-select" id="sport" name="sport_id" aria-label="Sport">
            <?php foreach($sports as $sport): ?>
                <option value="<?= $sport->id; ?>" <?= (old('sport_id') == $sport->id ? 'selected' : '') ?>><?= $sport->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>