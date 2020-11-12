<template>
    <div class="chat-app">
        <ContactsList :contacts="contacts" :user="user_data"/>    
    </div>
</template>

<script>
    import ContactsList from './ContactsList';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() { 
            return {
                contacts: [],
                user_data: this.user
            };
        },
        mounted() {
            //console.log(this.user);
            axios.get('/contacts')
                .then((response) => {
                    //console.log(response.data);
                    this.contacts = response.data;
                });
        },
        components: {ContactsList}
    }
</script>