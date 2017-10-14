<template>
    <div class="row">
        <div class="col s12 l6" v-for="section in sections">
            <section-card :section="section" :theme-id="themeId"></section-card>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ["sections", "themeId"],

    };
</script>