<template>
    <div class="card" v-if="!isDeleted">
        <div class="card-header">
            <span v-if="!editing" class="card-header-title">{{section.name}}</span>
            <form v-if="editing" class="column" @submit.prevent="">
                <div class="field">
                    <div class="control">
                        <input type="text" v-if="editing" v-model="section.name" class="input">
                    </div>
                </div>
            </form>

        </div>

        <footer class="card-footer">
            <a v-if="!deleting && !editing"
               :href="'/theme/' + themeId + '/sections/' + section.id + '/fields'"
               class="is-primary card-footer-item">
                Add/Edit Fields
            </a>
            <a v-if="!deleting && !editing" @click="edit()" class="is-primary card-footer-item"><i
                    class="material-icons">edit</i></a>
            <a v-if="!deleting && !editing" :href="downloadLink" class="is-primary card-footer-item">
                <i class="material-icons">file_download</i>
            </a>
            <a v-if="!deleting && !editing" @click="confirmDelete()"
               class="is-primary card-footer-item">
                <i class="material-icons">delete</i>
            </a>

            <a v-if="deleting && !editing" class="card-footer-item" @click="deleteSection()">Delete</a>
            <a v-if="deleting && !editing" class="card-footer-item" @click="cancelDelete()">Cancel</a>

            <a v-if="editing" class="card-footer-item" @click="saveChanges()">
                Save Changes
            </a>
            <a v-if="editing" class="card-footer-item" @click="cancelEdit()">
                Cancel
            </a>
        </footer>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ["section", "themeId"],

        data: function () {
            return {
                editing: false,
                deleting: false,
                isDeleted: false,
            };
        },

        computed: {
            downloadLink: function() {
                return '/theme/' + this.themeId + '/sections/' + this.section.id + '/download';
            }
        },

        methods: {
            edit: function () {
                this.editing = true;
            },

            saveChanges: function () {
                axios.put('/theme/' + this.themeId + '/sections/' + this.section.id, {
                    'name': this.section.name
                }).then(response => {
                    if (response.data.success) {
                        toast('Section Updated');
                    } else {
                        toast(response.data.message, 'red');
                    }

                    this.editing = false;
                });
            },

            cancelEdit: function () {
                this.editing = false;
            },

            confirmDelete: function () {
                this.deleting = true;
            },

            cancelDelete: function () {
                this.deleting = false;
            },

            deleteSection: function () {
                axios.delete('/theme/' + this.themeId + '/sections/' + this.section.id)
                    .then(response => {
                        if (response.data.success) {
                            this.isDeleted = true;
                            toast('Section Deleted');
                        } else {
                            toast(response.data.message);
                        }

                        this.deleting = false;
                    });
            },
        },

    };
</script>