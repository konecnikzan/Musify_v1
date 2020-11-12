<template>
    <nav id="sidebar">
        <div class="custom-menu">
        </div>
        <div class="p-4">
            <div class="avatar_profile">
                <a href="/home"><img class="user_avatar" :src="user.avatar" width="50" height="50"></a>
                <h4><a v-bind:href="'/profile/' + user.id" class="avatar_text">My Profile</a></h4>
                <form id="logout-form" action="/logout" method="POST">
                        <input type="image" src="/images/logout.png" alt="" width="25" height="25">
                </form>
            </div>
            <div class="messages_text_div">
                <h6 id="messages_text"><b>Messages</b></h6>
            </div>
            <div class="main_messages">
                <div v-for="(contact, i) in contacts" class="messages_bg" :key="contact.id" v-on:click="redirect(i)">  
                    <div v-if="contact.sender_id == user.id">
                        <img class="match-profile-image" :src="contact.recipient_avatar" alt="">
                        <span v-if="contact.is_read == 0 && contact.recipient_id == user.id" class="pending dot"></span>
                        <div class="text">
                            <h6><b>{{ contact.recipient_name }}</b></h6>                             
                            <p class="text-muted">{{ contact.message }}</p>
                        </div>  
                    </div>
                    <div v-else-if="contact.recipient_id == user.id">
                        <img class="match-profile-image" :src="contact.sender_avatar" alt="">
                        <span v-if="contact.is_read == 0 && contact.recipient_id == user.id" class="pending dot"></span>
                        <div class="text">
                            <h6><b>{{ contact.sender_name }}</b></h6>                             
                            <p class="text-muted">{{ contact.message }}</p>
                        </div>
                    </div>    
                </div>    
            </div>    
        </div>            
    </nav>
</template>

<script>
    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
            contacts: {
                type: Array,
                default: []
            }
        },
        methods: {
            redirect: function (contact_id) {
                for (var item in this.contacts) {
                    if(item == contact_id) {
                        if(this.contacts[item].recipient_id == this.user.id) {
                            window.location.href = '/chat/' + this.user.id + '&' +this.contacts[item].sender_id;
                        } else if (this.contacts[item].sender_id == this.user.id) {
                            window.location.href = '/chat/' + this.user.id + '&' +this.contacts[item].recipient_id;
                        }
                    }
                }
            }
        }
    }
</script>