<template>
    <div class="login-container d-flex flex-wrap align-items-center justify-content-center">
        <div class="content">
            <div class="section header d-flex align-items-center justify-content-center">
                {{ $t('login.title') }}
            </div>
            <div class="section body">
                <form id="login-form" data-parsley-validate>
                    <div class="input-group mb-3">
                        <span class="input-group-text">{{ $t('login.email') }}</span>
                        <input type="email" name="email" v-model="email" class="form-control" id="email-input" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">{{ $t('login.password') }}</span>
                        <input type="password" name="password" v-model="password" class="form-control"
                            id="password-input" required data-parsley-minlength="8" data-parsley-uppercase="1"
                            data-parsley-lowercase="1" data-parsley-number="1" data-parsley-required="true"
                            data-parsley-error-message="Password must be at least 8 characters, include at least one number, one letter, and one uppercase letter.">
                    </div>
                    <div class="error-message" style="color: red;"></div>
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <button class="btn btn-primary login-submit-btn" @click="submit">
                            {{ $t('login.submit') }}
                        </button>
                    </div>
                    <span class="ajax-error-message"></span>
                </form>
            </div>
            <!-- <div class="section footer"></div> -->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            errorMessage: ''
        }
    },
    methods: {
        setup() {
            $('#login-form').parsley();
        },
        submit() {
            let loginButton = $('.login-submit-btn');
            let errorMessage = $('.ajax-error-message');

            errorMessage.text('');

            loginButton
                .attr('disabled', true)
                .text('Pending...');

            try {
                let formData = new FormData();
                formData.append('email', this.email);
                formData.append('password', this.password);

                axios({
                    method: 'POST',
                    url: '/login/login',
                    data: formData,
                }).then((response) => {
                    if (response.data.status === 200) {
                        this.$router.push('/');
                    } else {
                        errorMessage.text(response.data.message);
                        loginButton
                            .attr('disabled', false)
                            .text('Submit');
                    }
                }).catch((error) => {
                    this.errorMessage = error.message;
                });
            } catch (error) {
                this.errorMessage = error;
            }
        }
    }
}
</script>

<style lang="scss">
.content {
    max-width: 1045px;
    border: 1px solid black;
    padding: 10px;

    & .section {
        padding: 5px;
        margin: 15px;
    }
}
</style>