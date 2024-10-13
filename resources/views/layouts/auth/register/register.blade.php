@include('layouts.partials.head')

<div class="register-container d-flex flex-wrap align-items-center justify-content-center">
    <div class="content">
        <div class="section header d-flex align-items-center justify-content-center">
            {{ __('register.title') }}
        </div>
        <div class="section body">
            <form id="register-form" action="{{ route('register.save') }}" method="POST" data-parsley-validate>
                @method('POST')
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text">{{ __('register.name') }}</span>
                    <input type="text" name="name" class="form-control" aria-label="{{ __('register.name') }}"
                        required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">{{ __('register.lastname') }}</span>
                    <input type="text" name="lastname" class="form-control"
                        aria-label="{{ __('register.lastname') }}" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" id="username-input" name="username"
                        placeholder="{{ __('register.username') }}" aria-label="{{ __('register.username') }}"
                        aria-describedby="username-input" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">{{ __('register.email') }}</span>
                    <input type="email" name="email" class="form-control" id="email-input" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">{{ __('register.password') }}</span>
                    <input type="password" name="password" class="form-control" id="password-input" required
                        data-parsley-minlength="8" data-parsley-uppercase="1" data-parsley-lowercase="1"
                        data-parsley-number="1" data-parsley-required="true"
                        data-parsley-error-message="Password must be at least 8 characters, include at least one number, one letter, and one uppercase letter.">
                </div>
                <div class="error-message" style="color: red;"></div>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary">{{ __('register.submit') }}</button>
                </div>
            </form>
        </div>
        {{-- <div class="section footer"></div> --}}
    </div>
</div>

{{-- Parsley.js validation added temprorarily, in future will be changed with the proper solution --}}
<script>
    $(document).ready(function() {
        $('#register-form').parsley();
    });
</script>

<style>
    html,
    body {
        font-family: monospace;
    }

    .content {
        max-width: 1045px;
        border: 1px solid black;
        padding: 10px;
    }

    .content .section {
        padding: 5px;
        margin: 15px;
    }
</style>