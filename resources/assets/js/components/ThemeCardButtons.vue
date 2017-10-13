<template>
    <div>
        <a :href="sectionsLink" class="btn">Sections</a>
        <a href="#" class="btn-floating"><i class="material-icons">edit</i></a>
        <a href="#" class="btn-floating"><i class="material-icons">content_copy</i></a>
        <a @click="deleteTheme()" class="btn-floating"><i class="material-icons">delete</i></a>
    </div>
</template>

<script type="text/babel">

    module.exports = {

        props: ["id"],

        computed: {
            sectionsLink: function() {
                return "/theme/" + this.id + "/sections";
            },
        },

        methods: {
            deleteTheme: function() {
                axios.delete('/theme/' + this.id);
            },
        },

    }

</script>