<template>
    <div class="p-4 p-md-5 pt-5" style="width: 60vw;margin: 0 auto;height: 1000px;" id="messages_view"> 
        <section class="msger">
            <MessagesFeed :contact="contact" :messages="messages" :user="user"/>
            <MessageComposer @send="sendMessage" @focused-input="focused"/>
        </section>    
    </div>    
</template>

<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

    export default {
         props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            },
            user: {
                type: Object,
                required: true
            }
        },
        methods: {
            sendMessage(text) {
                var currentUrl = window.location.pathname;
                var message_user_id = (currentUrl.split('/')[2]).split('&')[1]; 

                axios.post('/conversation/send', {
                    contact_id: message_user_id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                })
            },
            focused(id){
                var currentUrl = window.location.pathname;
                var message_user_id = (currentUrl.split('/')[2]).split('&')[1]; 
                
                this.$emit('focused-input',message_user_id);
            }
        },
        components: {MessagesFeed, MessageComposer}
    }
</script>