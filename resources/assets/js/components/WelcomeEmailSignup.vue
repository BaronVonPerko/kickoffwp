<template>
    <div>
        <form v-on:submit.prevent="submit()" v-if="!submitSuccess">
            <input v-model="email" type="email" required placeholder="Your Email Address">
            <button class="waves-effect waves-light btn-large pulse z-depth-3">
                Tell Me When It's Ready!
            </button>
            <p class="center-align">We will only email you when KickOff is ready to use.</p>
        </form>

        <div v-if="submitSuccess">
            <h4 v-if="!error">Email Reminder Set!</h4>
            <p v-if="error" class="red-text">An error occurred: {{error}}</p>
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