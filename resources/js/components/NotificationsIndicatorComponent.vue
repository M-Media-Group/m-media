<template>
<span>
            <span v-if="unreadMessages.length > 0" key="notifications" class="text-primary" >
                ({{unreadMessages.length}})
            </span>
            <span v-else-if="loading" key="loading" class="alert">
              Loading...
            </span>
</span>
</template>


<script>
export default{
    props: ['userid'],
    data(){
        return{
            loading: true,
            error: false,
            success: false,
            notifications: [],
        }
    },
    computed: {
    // a computed getter
    unreadMessages: function () {
      // `this` points to the vm instance
      //return this.notifications.split('').reverse().join('')
         return this.notifications.filter(function(itm){
            return itm.read_at == null;
        });

    }
  },
    mounted() {
        this.getNotifications()
        Echo.private(`App.User.${this.userid}`)
    .notification((notification) => {
         if (!("Notification" in window)) {
            console.log("This browser does not support desktop notification");
          }

          // Let's check whether notification permissions have already been granted
          else if (Notification.permission === "granted") {
            // If it's okay let's create a notification
            new Notification(notification.title, {
                    body: notification.message
                });
          }

          // Otherwise, we need to ask the user for permission
          else if (Notification.permission !== "denied") {
            Notification.requestPermission().then(function (permission) {
              // If the user accepts, let's create a notification
              if (permission === "granted") {
                new Notification(notification.title, {
                    body: notification.message
                });
              }
            });
        }
        this.notifications.unshift({
        data:  {
          title: notification.title,
          message: notification.message,
          action: notification.action,
          action_text: notification.action_text,
        },
        created_at: new Date().toLocaleString()
      })
    });
    },
    methods: {

    getNotifications: function () {
        this.loading = true
        //data.append('_method', 'put'); // add this
        axios.get('/api/users/'+this.userid+'/notifications') // change this to post )
        .then(res =>{
            this.notifications = res.data
            this.loading = false
            //console.log(this.notifications)
        })
        .catch(error => {
            console.log(error)
            this.loading = false
            this.error = true
        });
        }
      }
    }

</script>
