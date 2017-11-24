<template>
    <div>
        <table v-if="fields.length" class="table is-striped is-fullwidth is-bordered">
            <thead>
            <tr>
                <th>Label</th>
                <th>Default</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <field-list-item v-for="field in fields"
                             :key="field.id"
                             :theme-id="themeId"
                             :section-id="sectionId"
                             :field="field">
            </field-list-item>
            </tbody>
        </table>

        <div v-if="!fields.length" class="col s12 center-align">
            There are currently no fields for this section.
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        props: ['fields', 'themeId', 'sectionId'],
    };
</script>