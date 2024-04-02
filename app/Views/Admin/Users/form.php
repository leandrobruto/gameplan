<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="username">Username</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-user"></i>
            </span>
            <input 
                type="text" 
                id="username"
                name="username"
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
                name="email"
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
                name="password"
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
                name="password_confirmation"
                class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="active" value="0" />
            <input type="checkbox" class="form-check-input" name="active" id="active" value="1" <?php if (old('active', $user->active)): ?> checked="" <?php endif; ?> />
            <label class="form-label" for="active">Active</label>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="is_admin" value="0" />
            <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" value="1" <?php if (old('is_admin', $user->is_admin)): ?> checked="" <?php endif; ?> />
            <label class="form-label" for="is_admin">Admin</label>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-sm btn-primary mr-2">
    <i class="bx bx-save tf-icons"></i>
    Submit
</button>