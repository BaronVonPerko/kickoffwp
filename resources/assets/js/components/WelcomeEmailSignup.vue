<template>
    <div>
        <form v-on:submit.prevent="submit()" v-if="!submitSuccess">
            <div class="field">
                <div class="control">
                    <input v-model="email" type="email" class="input" required placeholder="Your Email Address">
                </div>
            </div>
            <div class="field">
                <div class="control has-text-centered">
                    <button class="button is-large is-primary">
                        Tell Me When It's Ready!
                    </button>
                </div>
            </div>

            <p class="has-text-centered">We will only email you when KickoffWP is ready to use, and promise not to spam your inbox.</p>
        </form>

        <div v-if="submitSuccess" class="notification has-text-centered">
            <h4 v-if="!error" class="subtitle">Thank you! We will email you when KickoffWP is ready to use!</h4>
            <p v-if="error" class="subtitle has-text-danger">An error occurred: {{error}}</p>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        data: function () {
            return {
                email: '',
                submitSuccess: false,
                error: '',
            };
        },

        methods: {
            submit: function () {
                axios.post('/remindme', {email: this.email})
                    .then((res) => {
                        console.log(res);
                        this.submitSuccess = true;
                        if(res.data && res.data.error) {
                            this.error = res.data.error;
                        }
                    });
            }
        },
    };
</script>