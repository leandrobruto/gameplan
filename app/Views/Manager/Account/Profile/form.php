<div class="row">

    <!-- Hidden fields that we will use in the controller -->
    <input type="hidden" name="profile[user_id]" value="<?= $user->id; ?>" />

    <div class="mb-3 col-md-3">
        <label for="first_name" class="form-label">First Name</label>
        <div class="input-group input-group-merge">  
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-user"></i>
            </span>
            <input class="form-control" type="text" id="first_name" name="profile[first_name]" value="<?= $user->first_name; ?>" autofocus />
        </div>
    </div>

    <div class="mb-3 col-md-3">
        <label for="last_name" class="form-label">Last Name</label>
        <div class="input-group input-group-merge">  
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-user"></i>
            </span>
            <input class="form-control" type="text" name="profile[last_name]" id="last_name" value="<?= $user->last_name; ?>" />
        </div>
    </div>
    
    <div class="mb-3 col-md-6">
        <label for="username" class="form-label">Username</label>
        <div class="input-group">  
            <span id="icon-name" class="input-group-text">
                @
            </span>
            <input type="text"class=" form-control" id="username" name="user[username]" value="<?= $user->username; ?>" />
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <label for="email" class="form-label">E-mail</label>
        <div class="input-group input-group-merge">  
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-envelope"></i>
            </span>
        <input class="form-control" type="text" id="email" name="user[email]" value="<?= $user->email; ?>" placeholder="@email.com" />
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label" for="phoneNumber">Phone Number</label>
        <div class="input-group input-group-merge">  
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-phone"></i>
            </span>
            <input type="text" id="phoneNumber" name="profile[phone]" value="<?= $profile->phone; ?>" class="form-control sp_celphones" placeholder="(xx) xxxxx-xxxx" />
        </div>
    </div>
    
    <div class="mb-3 col-md-6">
        <label for="cpf" class="form-label">CPF</label>
        <div class="input-group input-group-merge">  
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-id-card"></i>
            </span>
            <input type="text" class="form-control cpf" name="profile[cpf]" id="cpf" value="<?php echo old('cpf', esc($profile->cpf)); ?>">
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <label for="default_stake" class="form-label">Default Stake</label>
        <div class="input-group input-group-merge">  
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-money"></i>
            </span>
            <input type="text"class=" form-control" id="default_stake" name="profile[default_stake]" value="<?= $user->default_stake; ?>" />
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <label for="default_date_range_id" class="form-label">Default Date Range</label>
        <div class="input-group">  
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-calendar"></i>
            </span>
            <select class="form-select" id="default_date_range_id" name="profile[default_date_range_id]" aria-label="Default Date Range">
                <?php foreach($date_ranges as $range): ?>
                <option value="<?= $range->id; ?>" 
                    <?= (old('profile.default_date_range_id', $profile->default_date_range_id) == $range->id ? 'selected' : '') ?>>
                    <?= old('profile.default_date_range_id', $range->name); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <label for="default_sport_id" class="form-label">Default Sport</label>
        <div class="input-group">  
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-trophy"></i>
            </span>
            <select class="form-select" id="sport" name="profile[default_sport_id]" aria-label="Sport">
                <?php foreach($sports as $sport): ?>
                <option value="<?= $sport->id; ?>" 
                    <?= (old('profile.default_sport_id', $profile->default_sport_id) == $sport->id ? 'selected' : '') ?>>
                    <?= old('profile.default_sport_id', $sport->name); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div class="mt-2">
    <button type="submit" class="btn btn-primary me-2">Save changes</button>
    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
</div>