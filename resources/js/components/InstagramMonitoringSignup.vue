<template>
    <div>
        <form method="POST" class="u-center" action="/custom-notifications" key="requestWebsiteForm" v-on:submit.prevent="current_tab == 4 ? updateFile() : (current_tab += 1)" v-show="!success && !error && !loading">
            <!--            <transition-group name="fade">
 -->
            <div v-if="current_tab == 0" key="tab_0" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex">
                    <img src="/images/tabletshop.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
                </div>
                <h1 class="u-center-text">Monitor your Instagram health</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie.</p>
            </div>
            <div v-if="current_tab == 1" key="tab_1" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex">
                    <img src="/images/tabletshop.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
                </div>
                <h2>What's your @?</h2>
                <div class="form-group row">
                    <label for="business_title" class="twelve columns col-form-label">Your business name</label>
                    <div class="twelve columns">
                        <input name="business_title" v-model="business_title" id="business_title" class="form-control" type="text" placeholder="What do customers know you as?" minlength="1" maxlength="78" autocomplete="off" required autofocus data-hj-whitelist />
                    </div>
                </div>
                <div class="form-group row">
                    <div style="width:48%;float:left;">
                        <label for="business_title" class="twelve columns col-form-label">Name</label>
                        <div class="twelve columns">
                            <input name="business_title" v-model="business_title" id="business_title" class="form-control" type="text" placeholder="What do customers know you as?" minlength="1" maxlength="78" autocomplete="off" required autofocus data-hj-whitelist />
                        </div>
                    </div>
                    <div style="width:48%;float:left;margin-left:4%;">
                        <label for="business_title" class="twelve columns col-form-label">Surname</label>
                        <div class="twelve columns">
                            <input name="business_title" v-model="business_title" id="business_title" class="form-control" type="text" placeholder="What do customers know you as?" minlength="1" maxlength="78" autocomplete="off" required autofocus data-hj-whitelist />
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="current_tab == 2" key="tab_2" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex">
                    <img src="/images/tabletshop.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
                </div>
                <h2>Where should we send reports?</h2>
                <div class="form-group row">
                    <label for="email" class="twelve columns col-form-label">Your email</label>
                    <div class="twelve columns">
                        <input name="email" v-model="email" id="email" class="form-control" type="text" placeholder="What do customers know you as?" minlength="1" maxlength="78" autocomplete="off" required autofocus data-hj-whitelist />
                    </div>
                </div>
                <p>You’ll get regular summaries on this email. You’ll also have 24/7 access to your stats online.</p>
            </div>
            <div v-show="current_tab == 3" key="tab_3" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex">
                    <img src="/images/tabletshop.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
                </div>
                <h2>Finish setup and start monitoring insta health</h2>
                <div class="form-control" style="color: inherit;border: 1px solid var(--gray);border-radius: var(--border-radius);padding: .5rem .75rem;margin-bottom: 1rem;background:white;">
                    <div id="card-element"></div>
                </div>
                <div class="twelve columns">
                    <input name="emailtest" v-model="email" id="emaisl" class="form-control" type="text" placeholder="What do customers know you as?" minlength="1" maxlength="78" autocomplete="off"   data-hj-whitelist />
                </div>
                <p>You will be billed 5 EUR per month starting today. You can cancel at any time.</p>
            </div>
            <div v-if="current_tab == 4" key="tab_4" style="display: inline-block;">
                <div style="height: 250px; margin: 0 auto; display: flex">
                    <img src="/images/tabletshop.svg" style="height: 100%; margin: 0 auto" alt="Shop" />
                </div>
                <h2>Hurray! You’re now monitoring your Instagram health</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim</p>
            </div>
            <div class="form-group row invert-columns" key="tab_buttons">
                <div class="six columns order-md-12">
                    <button type="submit" class="button button-primary u-full-width" v-if="current_tab == 3">
                        Start monitoring my insta health
                    </button>
                    <button type="submit" class="button button-primary u-full-width" v-else>Next →</button>
                </div>
                <div class="six columns order-md-6" v-bind:style="{ visibility: current_tab == 0 ? 'hidden' : 'initial' }">
                    <a class="button" @click="current_tab -= 1"> ← </a>
                </div>
            </div>
            <!--             </transition-group>
 -->
        </form>
        <div class="alert alert-info" role="alert" v-show="loading" key="2">
            Please wait. Your message is being sent...
        </div>
        <div class="alert alert-success" role="alert" v-show="success" key="3">
            Message sent! We'll be reaching out to you shortly on your email address.<br />
            <!--                 <a href="#" class="button button-primary" v-on:click.prevent="success = false">Upload another file</a> -->
        </div>
        <div v-show="error" key="4">
            <div class="alert alert-danger" role="alert">
                Uh oh!
                <div class="w-100 mt-5" v-html="error_msg"></div>
                <br />
                <a href="#" class="button button-primary" v-on:click.prevent="error = false">Go back</a>
            </div>
            <br />
            <div class="form-group row mb-0">
                <div class="twelve columns">
                    <label class="mb-0">You can also contact us here</label>
                    <p>06230 Villefranche sur Mer, France</p>
                    <p class="mb-0">+33 4 86 06 08 59</p>
                    <p>contact@mmediagroup.fr</p>
                    <div class="flex" style="flex-wrap: wrap">
                        <a class="button button-primary" href="mailto:contact@mmediagroup.fr">Email</a>
                        <a class="button" href="tel:+33486060859">Call</a>
                    </div>
                </div>
            </div>
        </div>
        <!--         </transition-group>
 -->
    </div>
</template>
<script>
export default {
    props: ['stripe_key', 'stripe_secret'],
    data() {
        return {
            loading: false,
            error: false,
            error_msg: false,
            success: false,
            user: null,
            progress: 0,
            business_title: '',
            business_description: '',
            business_size: 1,
            email: '',
            phone: '',
            message: '',
            name: '',
            surname: '',
            is_logged_in_user: false,
            current_tab: 0,
            stripe: null,
            cardElement: null
        };
    },
    mounted() {
     this.setupStripe()
    },
    methods: {
        updateFile: function() {
            let data = new FormData();
            this.loading = true;
            data.append('name', this.name);
            data.append('surname', this.surname);
            data.append('email', this.email);
            data.append('phone', this.phone);
            var message_to_send =
                'Business name: ' +
                this.business_title +
                '\n\n Business description: ' +
                this.business_description +
                '\n\n Message: ' +
                this.message;
            data.append('message', message_to_send);
            window.scrollTo(0, 0);

            //data.append('_method', 'put'); // add this
            axios
                .post('/api/contact', data) // change this to post )
                .then((res) => {
                    this.success = true;
                    this.error = false;
                    console.log(res);
                    this.loading = false;
                    dataLayer.push({ event: 'contact' });
                })
                .catch((error) => {
                    this.error = true;
                    this.success = false;
                    this.error_msg = Object.entries(error.response.data.errors)
                        .map(([error_name, error_value], i) => `<p class="mb-0">${error_name}: ${error_value[0]}</p>`)
                        .join('\n');
                    console.log(this.error_msg);
                    //console.log(error.response.data.errors);
                    this.loading = false;
                }); //
            //console.log(error);
        },
        getUser: function() {
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/user') // change this to post )
                .then((res) => {
                    console.log('Go get');
                    this.is_logged_in_user = res;
                    console.log(res);
                })
                .catch((error) => {
                    console.log(error);
                }); //
            //console.log(error);
        },
        setupStripe: function() {
            var style = {
                base: {
                    // color: '#32325d',
                    lineHeight: '1.8',
                    fontFamily: '"Roboto", "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '18px',
                    '::placeholder': {
                        // color: '#aab7c4'
                    }
                },
                invalid: {
                    // color: '#fa755a',
                    // iconColor: '#fa755a'
                }
            };

            this.stripe = Stripe(this.stripe_key);

            const elements = this.stripe.elements();
            this.cardElement = elements.create('card', { style: style });
            this.cardElement.mount('#card-element');

        },
        submitForm: async function() {

                const { setupIntent, error } = await this.stripe.confirmCardSetup(
                    this.stripe_secret, {
                        payment_method: {
                            card: this.cardElement,
                            //billing_details: { name: cardHolderName.value }
                        }
                    }
                );
                if (error) {
                    // Display "error.message" to the user...
                    alert(error.message)

                } else {
                    axios.post('/api/users/{{$user->id}}/update-card', {
                        card_token: setupIntent.payment_method,
                    }).then(response => {
                        console.log(response)
                        location.reload();
                    }).catch(e => {
                        console.log(e)
                    })
                }
            }
    },
};

</script>
