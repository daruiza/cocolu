<template>
    
</template>

<script>
    export default {
        props: ['user'],
        mounted() {
            Echo.join(`neworder.${this.user.rel_store_id}`)
            /*
            .here((users) => {
                console.log(users)
            })
            .joining((user) => {
                console.log(`${user.name} joined`);
            })
            .leaving((user) => {
                console.log(`${user.name} leaved`);
            })
            */
            .listen('NewOrder', (e) => {
                if(!("events" in sessionStorage)){
                    //creamos evenst
                    var events = [];
                    sessionStorage.setItem('events', JSON.stringify(events));
                }
                //agrega un nuevo evento
                alert_events.addEvent(e);                
            });            
        }
    }
</script>
