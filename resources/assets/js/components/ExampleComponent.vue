<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" v-if="$can('edit posts')">
                        Example Component This is because you can edit the page</div>

                    <div class="panel-body" v-if="$can('edit posts')" >
                        I'm an example component! This is because you can only and I say only delete the page
                    </div>

                    <div>This is the permission</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
             permission : ' '
            }
        },
        mounted() {
            console.log('Component mounted.');
            console.log("These are the permisions ")
        }
    }
</script>
