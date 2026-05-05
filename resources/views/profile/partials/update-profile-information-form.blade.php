<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="row g-4">
            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('Full Name') }}</label>
                <input id="name" name="name" type="text" class="form-control form-control-custom" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @if($errors->get('name'))
                    <div class="text-danger small mt-1">{{ $errors->get('name')[0] }}</div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" name="email" type="email" class="form-control form-control-custom" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @if($errors->get('email'))
                    <div class="text-danger small mt-1">{{ $errors->get('email')[0] }}</div>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 p-3 bg-warning bg-opacity-10 rounded-3">
                        <p class="text-sm text-warning-emphasis mb-0">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-none fw-bold">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Mocked Fields for completeness -->
            <div class="col-md-6">
                <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                <input id="phone" name="phone" type="text" class="form-control form-control-custom" placeholder="+977 98XXXXXXXX" value="9841234567" />
            </div>

            <div class="col-md-6">
                <label for="location" class="form-label">{{ __('Location') }}</label>
                <input id="location" name="location" type="text" class="form-control form-control-custom" placeholder="City, Country" value="Kathmandu, Nepal" />
            </div>

            <div class="col-12">
                <label for="bio" class="form-label">{{ __('Bio / Professional Summary') }}</label>
                <textarea id="bio" name="bio" rows="4" class="form-control form-control-custom" placeholder="Tell us about yourself...">A dedicated aspirant preparing for the LokSewa Administrative Service exams. Focused on General Knowledge and Current Affairs.</textarea>
            </div>
        </div>

        <div class="d-flex align-items-center gap-4 mt-5">
            <button type="submit" class="btn-save-custom">{{ __('Save Changes') }}</button>

            @if (session('status') === 'profile-updated')
                <div class="text-success small d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ __('Saved successfully.') }}
                </div>
            @endif
        </div>
    </form>
</section>

