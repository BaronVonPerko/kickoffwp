<template>
    <transition name="fade">
        <div class="card z-depth-5 alert-flash" v-show="show" :class="level" role="alert">
            <div class="card-content black-text">
                <span class="card-title">{{body}}</span>
            </div>
        </div>
    </transition>
</template>

<script type="text/babel">
    module.exports = {
        props: ['message'],
        data() {
            return {
                body: this.message,
                level: 'light-green lighten-s',
                show: false
            }
        },
        created() {
            if (this.message) {
                this.toast();
            }
            window.events.$on(
                'toast', data => this.toast(data)
            );
        },
        methods: {
            toast(data) {
                if (data) {
                    this.body = data.message;
                    this.level = data.level;
                }
                this.show = true;
                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 2000);
            }
        }
    };
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        top: 25px;
        opacity: 1;
    }

    .fade-enter-active, .fade-leave-active {
        transition: all 500ms ease-in-out;
    }
    .fade-enter {
        opacity: 0
    }
    .fade-leave-to {
        transform: translateX(1000px);
    }
</style>