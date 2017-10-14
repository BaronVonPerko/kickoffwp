<template>
    <div class="card green lighten-3 z-depth-3">
        <div class="card-content">
            <span v-if="!editing" class="card-title">{{section.name}}</span>
            <form v-if="editing" @submit.prevent="">
                <input type="text" v-if="editing" v-model="section.name">
                <button @click="saveChanges()" class="btn">Save Changes</button>
            </form>
        </div>
        <div class="card-action">
            <div v-if="!editing && !deleting">
                <a :href="'/theme/' + themeId + '/sections/' + section.id + '/fields'" class="btn">Fields</a>
                <a @click="edit()" class="btn-floating"><i class="material-icons">edit</i></a>
                <a href="#" class="btn-floating"><i class="material-icons">content_copy</i></a>
                <a @click="confirmDelete()" class="btn-floating"><i class="material-icons">delete</i></a>
            </div>
        </div>
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

            },
        },

    };
</script>