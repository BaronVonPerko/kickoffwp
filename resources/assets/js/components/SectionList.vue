<template>
    <div>
        <div v-for="section in sections">
            <section-card :section="section" :theme-id="themeId"></section-card>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ["sections", "themeId"],

    };
</script>