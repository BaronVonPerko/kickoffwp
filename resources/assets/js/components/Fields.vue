<template>
    <div>
        <div class="row">
            <div class="card blue darken-1 z-depth-3">
                <div class="card-content white-text">
                    <span class="card-title">Fields for {{this.themeName}} {{this.sectionName}}</span>
                    <p>
                        Create the fields you would like to display
                        within this Customizer's section.
                    </p>
                </div>
                <div class="card-action">
                    <a @click="showCreateForm = true" href="#">Create New Field</a>
                </div>
            </div>
        </div>

        <div v-if="showCreateForm">
            <create-field-form :section-id="sectionId" :theme-id="themeId" :newFieldCreated="newFieldCreated"></create-field-form>
        </div>

        <field-list :fields="fieldList"></field-list>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        data: function() {
            return {
                showCreateForm: false,
                fieldList: JSON.parse(this.fields),
            }
        },

        props: ['themeId', 'themeName', 'sectionId', 'sectionName', 'fields'],

        methods: {
            newFieldCreated: function(field) {
                this.fieldList.push(field);
                this.showCreateForm = false;
            },
        },
    }
</script>