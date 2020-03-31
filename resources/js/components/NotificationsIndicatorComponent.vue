<template>
    <span
        v-if="unreadMessages.length > 0"
        key="notifications"
        class="text-primary"
        style="background: #246EBA;
  border-radius: 50%;
  color: #ffffff !important;
  display: inline-block;
  line-height: 1.6em;
  margin-right: 5px;
  text-align: center;
  width: 1.6em; "
    >
        {{ unreadMessages.length }}
    </span>
    <!-- <span v-else-if="loading" key="loading" class="alert text-muted">
        Loading...
    </span> -->
</template>

<script>
export default {
    props: ['userid'],
    data() {
        return {
            loading: true,
            error: false,
            success: false,
            notifications: [],
        };
    },
    computed: {
        // a computed getter
        unreadMessages: function() {
            // `this` points to the vm instance
            //return this.notifications.split('').reverse().join('')
            return this.notifications.filter(function(itm) {
                return itm.read_at == null;
            });
        },
    },
    mounted() {
        this.getNotifications();
        Echo.private(`App.User.${this.userid}`).notification((recieved_notification) => {
            if (!('Notification' in window)) {
                console.log('This browser does not support desktop notification');
            }

            // Let's check whether notification permissions have already been granted
            else if (Notification.permission === 'granted') {
                // If it's okay let's create a notification
                this.displayNotification(recieved_notification);
            }

            // Otherwise, we need to ask the user for permission
            else if (Notification.permission !== 'denied') {
                Notification.requestPermission().then(function(permission) {
                    // If the user accepts, let's create a notification
                    if (permission === 'granted') {
                        this.displayNotification(recieved_notification);
                    }
                });
            }

            this.notifications.unshift({
                data: {
                    title: recieved_notification.title,
                    message: recieved_notification.message,
                    action: recieved_notification.action,
                    action_text: recieved_notification.action_text,
                },
                created_at: new Date().toLocaleString(),
            });
            this.playSound();
        });
    },
    methods: {
        playSound() {
            var audio = new Audio('/sounds/bell.mp3');
            audio.play();
        },
        getNotifications: function() {
            this.loading = true;
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/users/' + this.userid + '/notifications') // change this to post )
                .then((res) => {
                    this.notifications = res.data;
                    this.loading = false;
                    //console.log(this.notifications)
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                    this.error = true;
                });
        },
        displayNotification: function(recieved_notification) {
            new Notification(recieved_notification.title, {
                body: recieved_notification.message,
                icon: '/images/logo.png',
            });
        },
    },
};
</script>
