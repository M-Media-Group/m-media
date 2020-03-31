<template>
    <div id="app">
        <!--     <h1>Please give us your payment details:</h1>
 -->
        <card
            v-if="stripe_key"
            class="stripe-card form-control"
            :class="{ complete }"
            :stripe="stripe_key"
            :options="stripeOptions"
            @change="complete = $event.complete"
        />
        <button class="pay-with-stripe button button-secondary" @click="pay" :disabled="!complete">
            Pay with credit card
        </button>
    </div>
</template>

<script>
import { Card, createToken } from 'vue-stripe-elements-plus';

export default {
    props: ['user_id'],
    data() {
        return {
            stripe_key: process.env.MIX_STRIPE_SECRET,
            complete: false,
            stripeOptions: {
                // see https://stripe.com/docs/stripe.js#element-options for details
            },
        };
    },
    components: { Card },

    methods: {
        pay() {
            // createToken returns a Promise which resolves in a result object with
            // either a token or an error key.
            // See https://stripe.com/docs/api#tokens for the token object.
            // See https://stripe.com/docs/api#errors for the error object.
            // More general https://stripe.com/docs/stripe.js#stripe-create-token.
            createToken().then((data) => {
                axios
                    .post('/api/users/' + this.user_id + '/update-card', {
                        card_token: data.token.id,
                    })
                    .then((response) => {})
                    .catch((e) => {
                        console.log(e.response.data);
                    });
            });
        },
    },
};
</script>

<style></style>
