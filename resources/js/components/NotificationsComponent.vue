<template>
    <transition-group name="fade" mode="out-in" tag="div" style="width: 100%">
        <div class="list-group" v-if="notifications.length > 0" key="notifications">
            <article
                v-for="notification in notifications"
                class="list-group-item list-group-item-action action-section round-all-round mt-5"
                style="cursor: pointer;"
                data-aos="fade"
                @click="redirect(notification)"
            >
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 mt-0">{{ notification.data.title }}</h5>
                </div>
                <small class="mt-0"
                    ><span v-bind:class="{ 'text-primary': !notification.read_at }">{{
                        timestamp(notification.created_at)
                    }}</span
                    ><span v-if="notification.data.action_text">
                        · Click to {{ notification.data.action_text }}</span
                    ></small
                >
                <p>{{ notification.data.message }}</p>
            </article>
        </div>
        <div v-else-if="loading" key="loading" class="alert" data-aos="fade">
            Loading...
        </div>
        <div v-else class="alert text-muted" key="error">
            You have no notifications.
        </div>
    </transition-group>
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

    mounted() {
        this.getNotifications();
        Echo.private(`App.User.${this.userid}`).notification(notification => {
            this.notifications.unshift({
                data: {
                    title: notification.title,
                    message: notification.message,
                    action: notification.action,
                    action_text: notification.action_text,
                },
                created_at: moment.now(),
            });
        });
    },
    methods: {
        timestamp: function(timestamp) {
            return moment(timestamp).fromNow();
        },

        redirect: function(notification) {
            location.href = notification.data.action ? notification.data.action : '#';
        },

        getNotifications: function() {
            this.loading = true;
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/users/' + this.userid + '/notifications') // change this to post )
                .then(res => {
                    this.notifications = res.data;
                    this.loading = false;
                    console.log(this.notifications);
                })
                .catch(error => {
                    console.log(error);
                    this.loading = false;
                    this.error = true;
                });
        },
    },
};
</script>
