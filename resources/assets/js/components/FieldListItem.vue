<template>
    <tr>
        <td>{{field.label}}</td>
        <td>{{field.default || 'null'}}</td>
        <td>
            <a v-if="!isDeleting && !isEditing" @click="edit()" class="is-primary">
                <i class="material-icons">edit</i>
            </a>
        </td>
    </tr>
</template>

<script type="text/babel">
    module.exports = {
        props: ["field"],

        data: function () {
            return {
                isDeleting: false,
                isDeleted: false,
                isEditing: false,
            }
        },

        methods: {
            edit: function() {
                this.isEditing = true;
            },
        },
    };
</script>