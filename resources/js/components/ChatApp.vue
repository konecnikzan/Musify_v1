<template>
    <div class="wrapper d-flex align-items-stretch">
        <ContactsList :contacts="contacts" :user="user_data"/>    
        <Conversation :contact="selectedContact" :messages="messages" :user="user_data" @new="saveNewMessage" @focused-input="focusedInput"/>
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
                selectedContact: {},
                messages: [],
                contacts: [],
                user_data: this.user
            };
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message);
                });

            axios.get('/contacts')
                .then((response) => {    
                    this.contacts = response.data;
                });    
                
            var currentUrl = window.location.pathname;
            var message_from_user_id = (currentUrl.split('/')[2]).split('&')[0]; 
            var message_user_id = (currentUrl.split('/')[2]).split('&')[1]; 

            axios.get(`/contact/${message_user_id}`)
                    .then((response) => {
                        this.selectedContact = response.data[0];
                }); 

            axios.get(`/conversation/${message_user_id}`)
                    .then((response) => {
                        this.messages = response.data;
                }); 
                
            this.contacts = this.contacts.map(function(contact){
                if(contact.sender_id == this.user.id){
                    contact.is_read = 1;
                    axios.post(`/conversation_update/${contact.message_id}`, {
                        id: contact.id
                    })
                }
            });    
                
        }, 
        methods: {
            saveNewMessage(message) {
                this.contacts = this.contacts.map(function(contact){
                    if(contact.sender_id == message.to){
                        contact.message = message.message;
                        contact.created_at = message.created_at;

                        contact.is_read = (this && this.user);
                    }
                    return contact;
                });
                this.messages.push(message);
            },
            focusedInput(id){
                this.contacts = this.contacts.map(function(contact){
                    if(contact.sender_id == id){
                        contact.is_read = 1;
                        axios.post(`/conversation_update/${contact.message_id}`, {
                            id: contact.id
                        })
                    }
                    return contact;
                });
            },
            handleIncoming(message) {
                axios.get('/contacts')
                .then((response) => {             
                    this.contacts = response.data;
                });
                if (message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
                this.updateUnread(message, false);
            },
            updateUnread(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }   

                    if (reset)
                        single.is_read = 0;
                    else
                        single.is_read = 1;
                    return single;
                })
            }
        },
        components: {Conversation, ContactsList}
    }
</script>