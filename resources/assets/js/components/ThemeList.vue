<template>
    <div>
        <div v-for="theme in themes">
            <theme-card :theme="theme"></theme-card>
            <br>
        </div>
    </div>
</template>

<script type="text/babel">

    module.exports = {
        props: ['themes'],

        data: function() {
            return {
                themeList: this.themes,
            }
        },

        computed: {
            isDeleted: function(theme) {
                return theme.isDeleted;
            }
        },

        methods: {
            sectionLink: function(theme, section) {
                return "/theme/" + theme.id + "/sections/" + section.id + "/fields";
            },

            markDeleted: function(id) {
                this.themeList.forEach(function(theme) {
                    if(theme.id === id) theme.isDeleted = true;
                });
            },
        },
    };

</script>