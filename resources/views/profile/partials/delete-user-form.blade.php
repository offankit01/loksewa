<section>
    <button class="btn btn-danger rounded-pill px-4 py-2 fw-bold"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        <i class="bi bi-exclamation-triangle me-2"></i> {{ __('Permanently Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-5">
            @csrf
            @method('delete')

            <h4 class="fw-bold text-dark mb-3">
                {{ __('Confirm Account Deletion') }}
            </h4>

            <p class="text-muted small mb-4">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mb-4">
                <label for="password" class="form-label sr-only">{{ __('Password') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control form-control-custom"
                    placeholder="{{ __('Enter your password') }}"
                />

                @if($errors->userDeletion->get('password'))
                    <div class="text-danger small mt-1">{{ $errors->userDeletion->get('password')[0] }}</div>
                @endif
            </div>

            <div class="d-flex justify-content-end gap-3">
                <button type="button" class="btn btn-light rounded-pill px-4" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn btn-danger rounded-pill px-4">
                    {{ __('Delete My Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

