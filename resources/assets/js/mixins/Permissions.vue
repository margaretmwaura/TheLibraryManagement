<script>
    export default {
        methods: {
            $can(permissionName) {
                console.log("The permisions granted are in mixins " , window.perm);
                console.log("Thses is the permission we have been given " , permissionName);
                return window.perm.indexOf(permissionName) !== -1;
            },
        },
    };
</script>
s
