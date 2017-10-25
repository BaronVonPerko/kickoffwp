<template>
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12 m5">
                    <input type="text" id="newLabel" v-model="newLabel" placeholder="Label" :disabled="submitting" required>
                    <label for="newLabel">Label</label>
                </div>
                <div class="input-field col s12 m5">
                    <input type="text" id="newDefault" v-model="newDefault" placeholder="Default" :disabled="submitting" required>
                    <label for="newDefault">Default</label>
                </div>
                <div class="col s12 m2">
                    <button class="btn-large" @click="add()" :disabled="submitting || !newLabel || !newDefault">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        props: ['themeId', 'sectionId', 'newFieldCreated'],

        data: function() {
            return {
                newLabel: '',
                newDefault: '',
                submitting: false,
            }
        },

        methods: {
            add: function() {
                if(!this.newLabel || !this.newDefault) return;

                this.submitting = true;

                axios.post('/theme/' + this.themeId + '/sections/' + this.sectionId + '/fields', {
                    'label': this.newLabel,
                    'default': this.newDefault,
                }).then(res => {
                    if(res.status === 200) {
                        this.newFieldCreated(res.data);
                        toast('New Field Created');
                        this.newLabel = '';
                        this.newDefault = '';
                        this.submitting = false;
                    }
                });
            }
        }
    }
</script>