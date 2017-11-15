<template>
    <tr>
        <td>
            <span v-if="!isEditing">{{field.label}}</span>
            <div class="field" v-if="isEditing">
                <div class="control">
                    <input placeholder="Field Label" id="label" name="label" class="input" v-model="field.label" required>
                </div>
            </div>
        </td>
        <td>{{field.default || 'null'}}</td>
        <td>
            <a v-if="!isDeleting && !isEditing" @click="edit()" class="is-primary">
                <i class="material-icons">edit</i>
            </a>
            <a v-if="isEditing" @click="save()" class="button is-primary">
                Save
            </a>
            <a v-if="isEditing" @click="cancel()" class="button">
                Cancel
            </a>
        </td>
    </tr>
</template>

<script type="text/babel">
    module.exports = {
        props: ["field", "themeId", "sectionId"],

        data: function () {
            return {
                isDeleting: false,
                isDeleted: false,
                isEditing: false,
                originalLabel: this.field.label,
            }
        },

        methods: {
            edit: function() {
                this.isEditing = true;
            },
            save: function() {
                this.isEditing = false;
            },
            cancel: function() {
                this.field.label = this.originalLabel;
                this.isEditing = false;
            },
        },
    };
</script>