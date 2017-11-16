<template>
    <form>
        <div class="field">
            <div class="label">Customizer Type</div>
            <div class="select">
                <select v-model="newType">
                    <option value="" disabled>Choose a Customizer Type</option>
                    <option value="1">Generic</option>
                    <option value="2">Color</option>
                    <option value="3">Upload</option>
                    <option value="4">Image</option>
                </select>
            </div>
        </div>
        <div class="field">
            <div class="label">Label</div>
            <div class="control">
                <input type="text" id="newLabel" v-model="newLabel" placeholder="Label" :disabled="submitting" required
                       autofocus class="input">
            </div>
        </div>
        <div class="field" v-if="newType != 3 && newType != 4">
            <div class="label">Default</div>
            <div class="control">
                <input type="text" id="newDefault" v-model="newDefault" placeholder="Default" :disabled="submitting"
                       required class="input">
            </div>
        </div>
        <div class="field">
            <button class="button is-block is-info is-large is-fullwidth"
                    @click="add()" :disabled="submitting || !newLabel">
                Add
            </button>
        </div>
    </form>
</template>

<script type="text/babel">
    module.exports = {
        props: ['themeId', 'sectionId', 'newFieldCreated'],

        data: function () {
            return {
                newLabel: '',
                newDefault: '',
                submitting: false,
                newType: '',
            };
        },

        methods: {
            add: function () {
                if (!this.newLabel) return;

                this.submitting = true;

                if(this.newType == 3 || this.newType == 4) this.newDefault = null;

                axios.post('/theme/' + this.themeId + '/sections/' + this.sectionId + '/fields', {
                    'label': this.newLabel,
                    'default': this.newDefault,
                    'type_id': this.newType,
                }).then(res => {
                    if (res.status === 200) {
                        this.newFieldCreated(res.data);
                        toast('New Field Created');
                        this.newLabel = '';
                        this.newDefault = '';
                        this.newType = '';
                        this.submitting = false;
                    }
                });
            }
        }
    };
</script>