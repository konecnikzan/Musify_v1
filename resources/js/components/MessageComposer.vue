<template>
    <div class="msger-inputarea"> 
        <input @keydown.enter="send"  @focus="focused" v-model="message" id="send-message" type="text" class="msger-input" placeholder="Enter your message...">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        methods: {
            send(e) {
                e.preventDefault();
                
                if (this.message == '') {
                    return;
                }
                this.$emit('send', this.message);
                this.message = '';
            },
            focused(e){
                this.$emit('focused-input');
            }
        }
    }
</script>