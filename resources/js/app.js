import './bootstrap';

window.Vue = require('vue').default;
import Vue from 'vue'

//for autoscroll
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

//For notifications
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import axios from 'axios';
Vue.use(Toaster, { timeout: 5000 })

Vue.component('message', require('./components/message.vue').default);



const app = new Vue({
    el: '#app',
    data: {
        message: '',
        chat: {
            message: [],
            user: [],
            color: [],
            time: []
        },
        typing: '',
        numberOfUsers: 0
    },
    watch: {
        message() {
            Echo.private('chat')
                .whisper('typing', {
                    name: this.message
                });
        }
    },
    methods: {
        send() {
            if (this.message.length != 0) {
                this.chat.message.push(this.message);
                this.chat.user.push('you');
                this.chat.color.push('success');
                this.chat.time.push(this.getTime());
                axios.post('/send', {
                        message: this.message,
                        chat: this.chat
                    })
                    .then(response => {
                        console.log(response);
                        this.message = '';
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        getTime() {
            let time = new Date();
            return time.getHours() + ':' + time.getMinutes();
        },
        getOldMessage() {
            axios.post('/getOldMessage')
                .then(response => {
                    console.log(response.data);
                    if (response.data != '') {
                        this.chat = response.data;
                    }
                })
        },
        deleteSession() {
            axios.post('/deleteSession')
                .then(response => this.$toaster.success('chat history is deleted'))
        }
    },
    mounted() {
        this.getOldMessage();
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message);
                this.chat.user.push(e.user);
                this.chat.color.push('warning');
                this.chat.time.push(this.getTime());
                axios.post('/saveToSession', {
                        chat: this.chat
                    })
                    .then(response => {})
                    .catch(error => {
                        console.log(error)
                    });

                // console.log(e);
            })
            .listenForWhisper('typing', (e) => {
                if (e.name != '') {
                    this.typing = "typing...";
                } else { this.typing = ""; }

            })
        Echo.join('chat')
            .here((users) => {
                this.numberOfUsers = users.length;
                // console.log(users)
            })
            .joining((user) => {
                this.numberOfUsers += 1;
                this.$toaster.success(user.name + ' is joined to chat room')
                    // console.log(user.name);
            })
            .leaving((user) => {
                this.numberOfUsers -= 1;
                this.$toaster.warning(user.name + ' is leaved to chat room')
                    // console.log(user.name);
            })
            .error((error) => {
                console.error(error);
            });
    }
});