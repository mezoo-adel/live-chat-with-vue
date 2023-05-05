/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {
    createApp
} from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */
import ExampleComponent from './components/ExampleComponent.vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';

const app = createApp({
    components: {
        ExampleComponent,
        ChatMessages,
        ChatForm
    },
    data() {
        return {
            messages: [],
            roomId: 1,
        }
    },
    created() {
        this.fetchMessages();

        Pusher.logToConsole = true;

        window.Echo.private('chat-app')
        .listen('message-created', (e) => {
            console.log('Message created from ECHO:', data);
            alert(data);
            this.messages.push({
                message: data.message.message,
                user: data.user
            });
        });


    },
    methods: {
        fetchMessages() {
            //GET request to the messages route in our Laravel server to fetch all the messages
            axios.get(`/chat/room/${this.roomId}/messages`, {}).then(response => {
                //Save the response in the messages array to display on the chat view
                this.messages = response.data;
            }).catch((e) => console.log(e.response.data.message));
        },
        //Receives the message that was emitted from the ChatForm Vue component
        addMessage(message) {
            //Pushes it to the messages array
            this.messages.push(message);
            //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
            axios.post(`/chat/room/${this.roomId}/messages`, message).then(response => {
                console.log(response.data);
            }).catch((e) => console.log(e.response.data.message));
        }
    },
});


app.mount('#app');