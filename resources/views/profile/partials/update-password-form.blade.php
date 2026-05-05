<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="row g-4">
            <div class="col-md-12">
                <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
                <input id="update_password_current_password" name="current_password" type="password" class="form-control form-control-custom" autocomplete="current-password" />
                @if($errors->updatePassword->get('current_password'))
                    <div class="text-danger small mt-1">{{ $errors->updatePassword->get('current_password')[0] }}</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
                <input id="update_password_password" name="password" type="password" class="form-control form-control-custom" autocomplete="new-password" />
                @if($errors->updatePassword->get('password'))
                    <div class="text-danger small mt-1">{{ $errors->updatePassword->get('password')[0] }}</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control form-control-custom" autocomplete="new-password" />
                @if($errors->updatePassword->get('password_confirmation'))
                    <div class="text-danger small mt-1">{{ $errors->updatePassword->get('password_confirmation')[0] }}</div>
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center gap-4 mt-5">
            <button type="submit" class="btn-save-custom">{{ __('Update Security') }}</button>

            @if (session('status') === 'password-updated')
                <div class="text-success small d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ __('Password updated successfully.') }}
                </div>
            @endif
        </div>
    </form>
</section>

