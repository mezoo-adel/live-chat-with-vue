<template>
    <div class="input-group">
        <input required id="btn-input" type="text" name="message" class="form-control input-sm"
            placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage" />
        <span class="input-group-btn">

            <button type="button" class="button" id="btn-chat" @click="sendMessage">
                <span class="button__text">Send</span>
            </button>

        </span>
    </div>
</template>
<script>
export default {
    //Takes the "user" props from <chat-form> … :user="{{ Auth::user() }}"></chat-form> in the parent chat.blade.php.
    props: ["user"],
    data() {
        return {
            newMessage: "",
        };
    },
    methods: {
        sendMessage() {
            //Emit a "messagesent" event including the user who sent the message along with the message content
            this.$emit("messagesent", {
                user: this.user,
                //newMessage is bound to the earlier "btn-input" input field
                message: this.newMessage,
            });
            //Clear the input
            this.newMessage = "";
        },
    },
};
</script>
<style>
.button {
    position: relative;
    padding: 8px 16px;
    background: #01866e;
    border: none;
    outline: none;
    border-radius: 2px;
    cursor: pointer;
}

.button:active {
    background: #177564;
}

.button__text {
    font: bold 20px "Quicksand", san-serif;
    color: #ffffff;
    transition: all 0.2s;
}

.button--loading .button__text {
    visibility: hidden;
    opacity: 0;
}

.button--loading::after {
    content: "";
    position: absolute;
    width: 16px;
    height: 16px;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    border: 4px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: button-loading-spinner 1s ease infinite;
}

@keyframes button-loading-spinner {
    from {
        transform: rotate(0turn);
    }

    to {
        transform: rotate(1turn);
    }
}
</style>
