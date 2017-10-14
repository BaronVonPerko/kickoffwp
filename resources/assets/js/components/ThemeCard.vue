<template>
    <div class="card green lighten-3 z-depth-3" v-if="!isDeleted">
        <div class="card-content black-text">
            <span class="card-title">
                <span v-if="!editing">{{theme.name}}</span>
                <form v-if="editing" @submit.prevent="">
                    <input type="text" v-if="editing" v-model="theme.name">
                    <button @click="saveChanges()" class="btn">Save Changes</button>
                </form>
            </span>
            <ul class="row" v-if="!editing">
                <li class="col s6" v-for="section in theme.sections">
                    <a :href="sectionLink(section)">
                        {{section.name}}
                    </a>
                </li>
                <li class="col s12" v-if="!theme.sections.length"><em>No sections created</em></li>
            </ul>
        </div>
        <div class="card-action">
            <div v-if="!editing && !deleting">
                <a :href="sectionsLink" class="btn">Sections</a>
                <a @click="edit()" class="btn-floating"><i class="material-icons">edit</i></a>
                <a href="#" class="btn-floating"><i class="material-icons">content_copy</i></a>
                <a @click="confirmDelete()" class="btn-floating"><i class="material-icons">delete</i></a>
            </div>
            <div v-if="deleting">
                <button class="btn red" @click="deleteTheme()">Delete</button>
                <button class="btn" @click="cancelDelete()">Cancel</button>
            </div>
        </div>
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

            confirmDelete: function() {
                this.deleting = true;
            },

            cancelDelete: function() {
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