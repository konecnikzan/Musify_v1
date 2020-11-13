<template>
    <div class="wrapper d-flex align-items-stretch">
        <ContactsList :contacts="contacts" :user="user_data"/>    
        <Conversation :contact="selectedContact" :messages="messages" :user="user_data" @new="saveNewMessage"/>
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
            var message_user_id = (currentUrl.split('/')[2]).split('&')[1]; 

            axios.get(`/contact/${message_user_id}`)
                    .then((response) => {
                        this.selectedContact = response.data[0];
                }); 

            axios.get(`/conversation/${message_user_id}`)
                    .then((response) => {
                        this.updateUnread(response.data, true);
                        this.messages = response.data;
                });  
        }, 
        methods: {
            saveNewMessage(message) {
                this.messages.push(message);
            },
            handleIncoming(message) {
                if (message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
                //this.updateUnread(message.from_contact, false);
            },
            updateUnread(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }   

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread = 1;
                    return single;
                })
            }
        },
        components: {Conversation, ContactsList}
    }
</script>