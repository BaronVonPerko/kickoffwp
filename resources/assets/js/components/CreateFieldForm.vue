<template>
    <form>
        <div class="field">
            <div class="label">Customizer Type</div>
            <div class="select">
                <select>
                    <option value="" disabled selected>Choose a Customizer Type</option>
                    <option value="1">Generic</option>
                    <option value="1">Color</option>
                    <option value="1">Upload</option>
                    <option value="1">Image</option>
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
        <div class="field">
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
            };
        },

        methods: {
            add: function () {
                if (!this.newLabel) return;

                this.submitting = true;

                axios.post('/theme/' + this.themeId + '/sections/' + this.sectionId + '/fields', {
                    'label': this.newLabel,
                    'default': this.newDefault,
                }).then(res => {
                    if (res.status === 200) {
                        this.newFieldCreated(res.data);
                        toast('New Field Created');
                        this.newLabel = '';
                        this.newDefault = '';
                        this.submitting = false;
                    }
                });
            }
        }
    };
</script>