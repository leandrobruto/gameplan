<div class="row">
    <div class="col-6 mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input
            type="text"
            id="first_name"
            name="profile[first_name]"
            class="form-control"
            placeholder="First Name"
            value="<?= old('first_name', esc($profile->first_name)); ?>"
            autofocus
        />
    </div>

    <div class="col-6 mb-3">
        <label for="username" class="form-label">Last Name</label>
        <input
            type="text"
            id="last_name"
            name="profile[last_name]"
            class="form-control"
            placeholder="Last Name"
            value="<?= old('last_name', esc($profile->last_name)); ?>"
            autofocus
        />
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="username">Username</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-user"></i>
            </span>
            <input 
                type="text" 
                id="username"
                name="user[username]"
                class="form-control" 
                value="<?= old('username', esc($user->username)); ?>"
            />
        </div>
    </div>
    
    <div class="col-md-6 mb-3">
        <label class="form-label" for="email">Email</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
            <input
                type="text"
                id="email"
                name="user[email]"
                class="form-control"
                value="<?= old('email', esc($user->email)); ?>"
            />
        </div>
        <div class="form-text">You can use letters, numbers & periods</div>
    </div>

    <div class="col-md-6 form-password-toggle mb-3">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
            <input
                type="password"
                id="password"
                name="user[password]"
                class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>

    <div class="col-md-6 form-password-toggle mb-3">
        <label class="form-label" for="password_confirmation">Password confirmation</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
            <input
                type="password"
                id="password_confirmation"
                name="user[password_confirmation]"
                class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>

    <div class="col-6 mb-3">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="user[active]" value="0" />
            <input type="checkbox" class="form-check-input" name="user[active]" id="active" value="1" <?php if (old('active', $user->active)): ?> checked="" <?php endif; ?> />
            <label class="form-label" for="active">Active</label>
        </div>
    </div>

    <div class="col-6 mb-3">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="user[is_admin]" value="0" />
            <input type="checkbox" class="form-check-input" name="user[is_admin]" id="is_admin" value="1" <?php if (old('is_admin', $user->is_admin)): ?> checked="" <?php endif; ?> />
            <label class="form-label" for="is_admin">Admin</label>
        </div>
    </div>
</div>
