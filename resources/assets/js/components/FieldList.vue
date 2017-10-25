<template>
    <div class="row">
        <table v-if="fields.length" class="responsive-table highlight">
            <thead>
            <tr>
                <th>Label</th>
                <th>Default</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="field in fields">
                <td>{{field.label}}</td>
                <td>{{field.default || 'null'}}</td>
                <td>buttons</td>
            </tr>
            </tbody>
        </table>
        <div v-if="!fields.length" class="col s12 center-align">
            There are currently no fields for this section.
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        props: ['fields'],
    };
</script>