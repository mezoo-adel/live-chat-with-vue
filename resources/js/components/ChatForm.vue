<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center  h5">
                Welcome!
                <select class="form-select w-25" v-model="roomId">
                    <option disabled selected>choose the room</option>
                    <option v-for="room in rooms" :key="room.id" name="roomId" :value="room.id">{{ room.name }}</option>
                </select>

            </div>
        </div>
        <div class="card-body">
            <chat-messages :messages="messages"></chat-messages>
        </div>
        <div class="card-footer">
            <chat-input @message_sent="addMessage" :user="user"></chat-input>
        </div>
    </div>
</template>

<script>
import ChatMessages from './ChatMessages.vue';
import ChatInput from './ChatInput.vue';
import moment from 'moment';


export default {
    data() {
        return {
            messages: [],
            rooms: [],
            roomId: 2,
        }
    },
    watch: {
        roomId : function (oldVal, newVal) {
            if(newVal){
                this.fetchMessages();
            }
        }
    },
    components: {
        ChatMessages, ChatInput,
    },
    created() {
        this.fetchMessages();
        this.fetchRooms();

        // Pusher.logToConsole = true;
        let pusher = new Pusher(
            import.meta.env.VITE_PUSHER_APP_KEY, {
            cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
            authEndpoint: '/broadcasting/auth',
        });

        let channel = pusher.subscribe('private-chat-app');
        channel.bind('message.created', (data) => {
            console.log('Message created from ECHO:', data);
            // alert(JSON.stringify(data));
            this.messages.push({
                message: data.message.message,
                user: data.user
            });
        });
    },
    methods: {
        fetchRooms() {
            //GET request to the messages route in our Laravel server to fetch all the messages
            axios.get(`/chat/rooms`, {}).then(response => {
                //Save the response in the messages array to display on the chat view
                this.rooms = response.data;
            }).catch((e) => console.log(e.response.data.message));
        }, fetchMessages() {
            //GET request to the messages route in our Laravel server to fetch all the messages
            axios.get(`/chat/room/${this.roomId}/messages`, {}).then(response => {
                //Save the response in the messages array to display on the chat view
                this.messages = response.data;
            }).catch((e) => console.log(e.response.data.message));
        },
        //Receives the message that was emitted from the ChatForm Vue component
        addMessage(message) {
            //Pushes it to the messages array in case there's an emitted message
            if (message.message) {
                let saveBtn = document.querySelector("#btn-chat");
                saveBtn.classList.add('button--loading');
                //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
                axios.post(`/chat/room/${this.roomId}/messages`, message).then(response => {
                    console.log(response.data);
                    saveBtn.classList.remove('button--loading');
                }).catch((e) => console.log(e.response.data.message));
            }
        }
    },

}
</script>
