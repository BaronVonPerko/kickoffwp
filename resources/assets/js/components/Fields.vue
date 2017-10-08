<template>
    <div>
        <div class="row">
            <div class="card pink darken-1 z-depth-3">
                <div class="card-content white-text">
                    <span class="card-title">Fields for {{this.theme}} {{this.section}}</span>
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
            <create-field-form id="this.id"></create-field-form>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        data: function() {
            return {
                showCreateForm: false,
            }
        },

        props: ['theme', 'section', 'id'],
    }
</script>