<template>
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12 m5">
                    <input type="text" id="newLabel" v-model="newLabel" placeholder="Label">
                    <label for="newLabel">Label</label>
                </div>
                <div class="input-field col s12 m5">
                    <input type="text" id="newDefault" v-model="newDefault" placeholder="Default">
                    <label for="newDefault">Default</label>
                </div>
                <div class="col s12 m2">
                    <button class="btn-large" @click="add()">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        props: ['themeId', 'sectionId'],

        data: function() {
            return {
                newLabel: '',
                newDefault: ''
            }
        },

        methods: {
            add: function() {
                axios.post('/theme/' + this.themeId + '/sections/' + this.sectionId + '/fields', {
                    'label': this.newLabel,
                    'default': this.newDefault,
                })
            }
        }
    }
</script>