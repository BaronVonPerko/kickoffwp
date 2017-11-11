<template>
    <div class="card">
        <div class="card-header">
            <span v-if="!editing" class="card-header-title">{{section.name}}</span>
            <form v-if="editing" class="column" @submit.prevent="">
                <div class="field">
                    <div class="control">
                        <input type="text" v-if="editing" v-model="section.name" class="input">
                    </div>
                </div>
                <button @click="saveChanges()" class="btn">Save Changes</button>
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
            <a v-if="!deleting && !editing" href="#" class="is-primary card-footer-item"><i class="material-icons">content_copy</i></a>
            <a v-if="!deleting && !editing" @click="confirmDelete()"
               class="is-primary card-footer-item">
                <i class="material-icons">delete</i>
            </a>

            <a v-if="deleting && !editing" class="card-footer-item" @click="deleteTheme()">Delete</a>
            <a v-if="deleting && !editing" class="card-footer-item" @click="cancelDelete()">Cancel</a>

            <a v-if="editing" class="card-footer-item" @click="saveChanges()">
                Save Changes
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
            };
        },

        methods: {
            edit: function () {
                this.editing = true;
            },

            saveChanges: function () {
                this.editing = false;
            },

            confirmDelete: function () {
                this.deleting = true;
            },

            cancelDelete: function () {
                this.deleting = false;
            },
        },

    };
</script>