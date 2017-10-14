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
            <ul class="row">
                <li class="col s6" v-for="section in theme.sections">
                    <a :href="sectionLink(section)">
                        {{section.name}}
                    </a>
                </li>
                <li class="col s12" v-if="!theme.sections.length"><em>No sections created</em></li>
            </ul>
        </div>
        <div class="card-action">
            <div v-if="!editing">
                <a :href="sectionsLink" class="btn">Sections</a>
                <a @click="edit()" class="btn-floating"><i class="material-icons">edit</i></a>
                <a href="#" class="btn-floating"><i class="material-icons">content_copy</i></a>
                <a @click="deleteTheme()" class="btn-floating"><i class="material-icons">delete</i></a>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ["theme"],

        data: function () {
            return {
                "isDeleted": false,
                "editing": false,
            };
        },

        computed: {
            sectionsLink: function () {
                return "/theme/" + this.id + "/sections";
            },
        },

        methods: {
            sectionLink: function (section) {
                return "/theme/" + this.theme.id + "/sections/" + section.id + "/fields";
            },

            deleteTheme: function () {
                axios.delete('/theme/' + this.theme.id)
                    .then(response => {
                        if (response.data.success) this.isDeleted = true;
                    });
            },

            edit: function () {
                this.editing = true;
            },

            saveChanges: function () {
                axios.put('/theme/' + this.theme.id, {name: this.theme.name})
                    .then(response => {
                        if (response.data.success) this.editing = false;
                    });
            },
        }

    };
</script>