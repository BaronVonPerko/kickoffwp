<template>
    <div class="container">
        <div class="content">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-title">
                                Fields for {{this.themeName}} {{this.sectionName}}
                            </span>
                        </div>
                        <div class="card-content">
                            <p>
                                Create the fields you would like to display
                                within this Customizer's section.
                            </p>

                            <create-field-form :section-id="sectionId"
                                               :theme-id="themeId"
                                               :newFieldCreated="newFieldCreated">
                            </create-field-form>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <field-list :fields="fieldList" :theme-id="themeId" :section-id="sectionId"></field-list>
                </div>

            </div>
        </div>

    </div>
</template>

<script type="text/babel">
    module.exports = {
        data: function () {
            return {
                fieldList: JSON.parse(this.fields),
            };
        },

        props: ['themeId', 'themeName', 'sectionId', 'sectionName', 'fields'],

        methods: {
            newFieldCreated: function (field) {
                this.fieldList.push(field);
            },
        },
    };
</script>