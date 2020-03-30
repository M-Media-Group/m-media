<template>
    <ul>
        <li href="#" v-for="user in users" :key="user.id">
            {{ user.name }}
        </li>
    </ul>
</template>

<script>
export default {
    name: 'OnlineList',
    props: ['me', 'channel'],
    data() {
        return {
            users: [],
        };
    },
    mounted() {
        this.users.push(this.me);
        Echo.join(this.channel)
            .here((users) => (this.users = users))
            .joining((user) => this.users.push(user))
            .leaving((user) => (this.users = this.users.filter((u) => u.id !== user.id)));
    },
};
</script>
