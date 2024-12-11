<template>
    <div class="register-container d-flex flex-wrap align-items-center justify-content-center">
        <div class="content">
            <div class="section header d-flex align-items-center justify-content-center">
                {{ $t('register.title') }}
            </div>
            <div class="section body">
                <div id="register-form" data-parsley-validate>
                    <div class="input-group mb-3">
                        <span class="input-group-text">{{ $t('register.name') }}</span>
                        <input type="text" name="name" v-model="name" class="form-control"
                            :aria-label="$t('register.name')" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">{{ $t('register.lastname') }}</span>
                        <input type="text" name="lastname" v-model="lastname" class="form-control"
                            :aria-label="$t('register.lastname')" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" id="username-input" name="username" v-model="username"
                            :placeholder="$t('register.username')" :aria-label="$t('register.username')"
                            aria-describedby="username-input" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">{{ $t('register.email') }}</span>
                        <input type="email" name="email" v-model="email" class="form-control" id="email-input" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">{{ $t('register.password') }}</span>
                        <input type="password" name="password" v-model="password" class="form-control"
                            id="password-input" required data-parsley-minlength="8" data-parsley-uppercase="1"
                            data-parsley-lowercase="1" data-parsley-number="1" data-parsley-required="true"
                            data-parsley-error-message="Password must be at least 8 characters, include at least one number, one letter, and one uppercase letter.">
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <button id="register-btn" class="btn btn-primary" @click="submit">
                            {{ $t('register.submit') }}
                        </button>
                    </div>
                    <span class="ajax-error-message"></span>
                </div>
            </div>
            <!-- <div class="section footer"></div> -->
        </div>
    </div>
</template>

<!-- Parsley.js validation added temprorarily, in future will be changed with the proper solution -->
<script>
import axios from 'axios';

export default {
    data() {
        return {
            name: '',
            lastname: '',
            username: '',
            email: '',
            password: '',
            errorMessage: ''
        }
    },
    methods: {
        setup() {
            $('#register-form').parsley();
        },
        submit() {
            let registerButton = $('#register-btn');
            let errorMessage = $('.ajax-error-message');

            errorMessage.text('');

            registerButton
                .attr('disabled', true)
                .text('Pending...');

            try {
                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('lastname', this.lastname);
                formData.append('username', this.username);
                formData.append('email', this.email);
                formData.append('password', this.password);

                axios({
                    method: 'POST',
                    url: '/register/save',
                    data: formData,
                }).then((response) => {
                    if (response.data.status === 200) {
                        this.$router.push('/');
                    } else {
                        errorMessage.text(response.data.message);
                        registerButton
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