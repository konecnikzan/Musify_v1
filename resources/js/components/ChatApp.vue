<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" />
        <ContactsList :contacts="contacts" :user="user_data"/>    
    </div>
</template>

<script>
    import Conversation from './Conversation';
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
                selectedContact: null,
                messages: [],
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
        components: {Conversation, ContactsList}
    }
</script>