<template>
    <div class="card" v-if="!isDeleted">
        <span class="card-header">
            <span v-if="!editing" class="card-header-title">{{theme.name}}</span>
            <form class="column" v-if="editing" @submit.prevent="">
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" v-if="editing" v-model="theme.name">
                    </div>
                </div>
            </form>
        </span>
        <div class="card-content">
            <div class="columns is-multiline" v-if="!deleting">
                <div v-for="section in theme.sections" class="column is-4">
                    <a :href="sectionLink(section)" class="box notification is-dark">
                        {{section.name}}
                    </a>
                </div>
            </div>
            <div class="has-text-centered" v-if="!theme.sections.length"><em>No sections created</em></div>
            <div v-if="deleting" class="has-text-centered subtitle">Are you sure you wish to delete this theme?</div>
        </div>
        <footer class="card-footer">
            <a v-if="!deleting && !editing" :href="sectionsLink" class="is-primary card-footer-item">Add/Edit Sections</a>
            <a v-if="!deleting && !editing" @click="edit()" class="is-primary card-footer-item"><i
                    class="material-icons">edit</i></a>
            <a v-if="!deleting && !editing" href="#" class="is-primary card-footer-item"><i class="material-icons">content_copy</i></a>
            <a v-if="!deleting && !editing" @click="confirmDelete()" class="is-primary card-footer-item"><i class="material-icons">delete</i></a>

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

        props: ["theme"],

        data: function () {
            return {
                isDeleted: false,
                editing: false,
                deleting: false,
            };
        },

        computed: {
            sectionsLink: function () {
                return "/theme/" + this.theme.id + "/sections";
            },
        },

        methods: {
            sectionLink: function (section) {
                return "/theme/" + this.theme.id + "/sections/" + section.id + "/fields";
            },

            confirmDelete: function () {
                this.deleting = true;
            },

            cancelDelete: function () {
                this.deleting = false;
            },

            deleteTheme: function () {
                axios.delete('/theme/' + this.theme.id)
                    .then(response => {
                        if (response.data.success) {
                            this.isDeleted = true;
                            toast('Theme Deleted');
                        } else {
                            toast(response.data.message, 'red');
                        }

                        this.deleting = false;
                    });
            },

            edit: function () {
                this.editing = true;
            },

            saveChanges: function () {
                axios.put('/theme/' + this.theme.id, {name: this.theme.name})
                    .then(response => {
                        if (response.data.success) {
                            this.editing = false;
                            toast('Theme Updated');
                        } else {
                            toast(response.data.message, "red");
                        }
                    });
            },
        }

    };
</script>