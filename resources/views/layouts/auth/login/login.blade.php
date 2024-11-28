@include('layouts.partials.head')

<div class="login-container d-flex flex-wrap align-items-center justify-content-center">
    <div class="content">
        <div class="section header d-flex align-items-center justify-content-center">
            {{ __('login.title') }}
        </div>
        <div class="section body">
            <form id="login-form" data-parsley-validate>
                @method('POST')
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text">{{ __('login.email') }}</span>
                    <input type="email" name="email" class="form-control" id="email-input" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">{{ __('login.password') }}</span>
                    <input type="password" name="password" class="form-control" id="password-input" required
                        data-parsley-minlength="8" data-parsley-uppercase="1" data-parsley-lowercase="1"
                        data-parsley-number="1" data-parsley-required="true"
                        data-parsley-error-message="Password must be at least 8 characters, include at least one number, one letter, and one uppercase letter.">
                </div>
                <div class="error-message" style="color: red;"></div>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary login-submit-btn">{{ __('login.submit') }}</button>
                </div>
                <span class="ajax-error-message hidden"></span>
            </form>
        </div>
        {{-- <div class="section footer"></div> --}}
    </div>
</div>

{{-- Parsley.js validation added temprorarily, in future will be changed with the proper solution --}}
<script>
    $(document).ready(function() {
        $('#login-form').parsley();

        $('#login-form').on('submit', function(e) {
            e.preventDefault();
            let errorMessage = $('.ajax-error-message');
            let loginButton = $('.login-submit-btn');

            loginButton
                .attr('disabled', true)
                .text('Pending...');

            errorMessage
                .addClass('hidden')
                .text('');

            const formData = $(this).serialize();
            $.ajax({
                method: "POST",
                url: "{{ route('auth.login') }}",
                data: formData,
            }).done(function(response) {
                loginButton.text('{{ __('login.submit') }}');

                if (response.status === 200) {
                    window.location.href = "{{ route('dashboard') }}"
                }

                errorMessage
                    .removeClass('hidden')
                    .text(response.message);

                loginButton
                    .text('{{ __('login.submit') }}');
            });
        });
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
