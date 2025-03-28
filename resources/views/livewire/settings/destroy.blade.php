<div class="">
    <form action="./" method="POST">
        <p class="text-body-secondary">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
            your account, please download any data or information that you wish to retain.
        </p>

        <div class="form-footer">
            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modal">Delete</button>
        </div>
    </form>

    @teleport('body')
        <div class="modal modal-blur fade" id="modal" tabindex="-1" style="display: none" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-title">Are you sure?</div>

                        <p class="text-body-secondary">
                            If you proceed, you will lose all your personal data. Please enter your password to confirm
                            that you would like to permanently delete your personal data.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label">Current password</label>
                            <input
                                class="form-control"
                                id="password"
                                type="password"
                                minlength="8"
                                maxlength="20"
                                autocomplete="current-password"
                            />
                            @error('password')
                                <p class="invalid-feedback d-block">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="button" class="btn btn-danger">Yes, delete all my data</button>
                    </div>
                </div>
            </div>
        </div>
    @endteleport
</div>
