<template>
    <main class="msger-chat" ref="msgerchat">
        <div v-for="message in messages" :key="message.id" class="msg" :class="`message${message.from == user.id ? ' right-msg' : ' left-msg'}`">
            <div v-if="user.id == message.from" class="msg-img" v-bind:style="{'background-image': 'url(' + user.avatar  + ')'}"></div>
            <div v-if="contact.id == message.from" class="msg-img" v-bind:style="{'background-image': 'url(' + contact.avatar  + ')'}"></div>

            <div class="msg-bubble">
                <div class="msg-info">
                    <div v-if="user.id == message.from" class="msg-info-name">{{ user.name }}</div>
                    <div v-if="contact.id == message.from" class="msg-info-name">{{ contact.name }}</div>

                    <div class="msg-info-time">{{ message.created_at | formatDate }}</div>
                </div>

                <div class="msg-text">
                    {{ message.message }}
                </div>
            </div>    
        </div> 
    </main>
</template>

<script>
    export default { 
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            },
            user: {
                type: Object,
                required: true
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.msgerchat.scrollTop = this.$refs.msgerchat.scrollHeight - this.$refs.msgerchat.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        },
        mounted() {

        }
    }
</script>