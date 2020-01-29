<script>
    export default {
        methods: {
            $canedit(permissionName,status) {
                console.log("The permisions granted are in mixins " , window.perm);
                console.log("This is the status of the book " , status);
                console.log("Thses is the permission we have been given " , permissionName);
                let permstat =  window.perm.indexOf(permissionName) !== -1;
                console.log("This is the status of the availability of the permission " , permstat);

                if(permstat === true && status === 6)
                {
                    return true
                }
            },
            $candelete(permissionName,status) {
                console.log("The permisions granted are in mixins " , window.perm);
                console.log("This is the status of the book " , status);
                console.log("Thses is the permission we have been given " , permissionName);
                let permstat =  window.perm.indexOf(permissionName) !== -1;
                console.log("This is the status of the availability of the permission " , permstat)

                if(permstat === true && status === 6)
                {
                    return true
                }
            },
            $canborrow(permissionName,status) {
                console.log("The permisions granted are in mixins " , window.perm);
                console.log("This is the status of the book " , status);
                console.log("Thses is the permission we have been given " , permissionName);
                let permstat =  window.perm.indexOf(permissionName) !== -1;
                console.log("This is the status of the availability of the permission " , permstat)

                if(permstat === true && status === 6)
                {
                    return true
                }
            },
            $canreserve(permissionName,status) {
                console.log("The permisions granted are in mixins " , window.perm);
                console.log("This is the status of the book " , status);
                console.log("Thses is the permission we have been given " , permissionName);
                let permstat =  window.perm.indexOf(permissionName) !== -1;
                console.log("This is the status of the availability of the permission " , permstat)

                if(permstat === true && status === 7)
                {
                    return true
                }
            },
        },
    };
</script>
s
