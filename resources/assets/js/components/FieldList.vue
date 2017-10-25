<template>
    <div>
        <table class="responsive-table highlight">
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Default</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="field in fieldList">
                    <td>{{field.label}}</td>
                    <td>{{field.default}}</td>
                    <td>buttons</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        props: ['fields'],

        data: function() {
            return {
                fieldList: JSON.parse(this.fields),
            }
        },
    };
</script>