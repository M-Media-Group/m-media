<template>
    <div>
        <transition-group name="fade" mode="out-in">
            <div class="table-responsive" v-if="subscription" key="subscriptions">
                <div></div>
                <div class="table-responsive" v-if="subscription.items.data" key="items">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product / service</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in subscription.items.data" :key="item['id']">
                                <td>{{ item.plan.product.name }}</td>
                                <td class="text-muted">{{ item.quantity }}</td>
                                <td>
                                    {{ item.quantity ? (item.plan.amount * item.quantity) / 100 : 0 }}
                                    {{ item.plan.currency.toUpperCase() }} / {{ item.plan.interval }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script>
export default {
    props: ['subid'],
    data() {
        return {
            loading: false,
            error: false,
            success: false,
            subscription: null,
        };
    },
    mounted() {
        this.getSub();
    },
    methods: {
        getSub: function () {
            this.loading = true;
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/subscriptions/' + this.subid) // change this to post )
                .then((res) => {
                    this.subscription = res.data;
                    this.loading = false;
                    console.log(this.subscription);
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                    this.error = true;
                });
        },
    },
};
</script>
