<template>
    <div>
        <!--         <transition-group name="fade">
 -->
        <form
            method="POST"
            action="/custom-notifications"
            key="requestWebsiteForm"
            v-on:submit.prevent="current_tab == 2 ? updateFile() : (current_tab += 1)"
            v-show="!success && !error && !loading"
        >
            <!--             <transition-group name="fade">
 -->
            <div v-if="current_tab == 0" key="tab_0">
                <div style="height: 250px; margin: 0 auto; display: flex;">
                    <img src="/images/tabletshop.svg" style="height: 100%; margin: 0 auto;" alt="Shop" />
                </div>

                <div class="form-group row">
                    <label for="business_title" class="col-md-12 col-form-label">Your business name</label>
                    <div class="col-md-12">
                        <input
                            name="business_title"
                            v-model="business_title"
                            id="business_title"
                            class="form-control"
                            type="text"
                            placeholder="What do customers know you as?"
                            minlength="1"
                            maxlength="78"
                            autocomplete="off"
                            required
                            autofocus
                            data-hj-whitelist
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="business_description" class="col-md-12 col-form-label"
                        >A little about your business</label
                    >
                    <div class="col-md-12">
                        <textarea-autosize
                            id="business_description"
                            v-model="business_description"
                            autocomplete="off"
                            minlength="10"
                            placeholder="What does your business do?"
                            class="form-control"
                            name="business_description"
                            required
                            data-hj-whitelist
                        ></textarea-autosize>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="business_title" class="col-md-12 col-form-label">Your business size</label>
                    <div class="col-md-12">
                        <div class="text-center">{{business_size == 1 ? 'Just me' : business_size >= 99 ? '100 or more people' : business_size+" people"}}</div>
                        <input
                            name="business_title"
                            v-model="business_size"
                            id="business_title"
                            class="custom-range"
                            type="range"
                            placeholder="What do customers know you as?"
                            step="1"
                            min="1"
                            max="100"
                            autocomplete="off"
                            required
                        />
                    </div>
                </div> -->
            </div>

            <div v-if="current_tab == 1" key="tab_1">
                <div style="height: 250px; margin: 0 auto; display: flex;">
                    <img src="/images/people.svg" style="height: 100%; margin: 0 auto;" alt="People" />
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label">Your first name</label>
                    <div class="col-md-12">
                        <input
                            name="name"
                            v-model="name"
                            id="name"
                            class="form-control"
                            type="text"
                            placeholder="Name"
                            maxlength="55"
                            required
                            autofocus
                            data-hj-whitelist
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-md-12 col-form-label">Your surname</label>
                    <div class="col-md-12">
                        <input
                            name="surname"
                            v-model="surname"
                            id="surname"
                            class="form-control"
                            type="text"
                            placeholder="Last name"
                            maxlength="55"
                            required
                            data-hj-whitelist
                        />
                    </div>
                </div>
            </div>

            <div v-if="current_tab == 2" key="tab_2">
                <div style="height: 250px; margin: 0 auto; display: flex;">
                    <img src="/images/emails.svg" style="height: 100%; margin: 0 auto;" alt="Emails" />
                </div>

                <div class="form-group row">
                    <label for="file" class="col-md-12 col-form-label">Your email address</label>

                    <div class="col-md-12">
                        <input
                            name="email"
                            v-model="email"
                            id="email"
                            class="form-control mb-0"
                            type="email"
                            placeholder="Email address"
                            required
                            autofocus
                            data-hj-whitelist
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message" class="col-md-12 col-form-label">Your message</label>

                    <div class="col-md-12">
                        <textarea-autosize
                            name="message"
                            v-model="message"
                            id="message"
                            class="form-control"
                            placeholder="Describe your needs in more detail and send us any questions you may have."
                            minlength="10"
                            required
                            data-hj-whitelist
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-12 col-form-label"
                        >Your phone number <small>(optional)</small></label
                    >

                    <div class="col-md-12">
                        <input
                            name="phone"
                            v-model="phone"
                            id="phone"
                            class="form-control mb-0"
                            type="tel"
                            placeholder="Country code & phone number"
                            maxlength="31"
                            minlength="5"
                            pattern="[\+]*{4,31}"
                            data-hj-whitelist
                        />
                        <span class="text-muted small"
                            >Include your country code starting with a plus sign (+). Your phone number helps us verify
                            who you are. You don't have to provide it, but if you do, we promise not to call you without
                            your consent.</span
                        >
                    </div>
                </div>
            </div>

            <div class="form-group row mt-5 mb-0" key="tab_buttons">
                <div class="col-md-6 order-md-12">
                    <button type="submit" class="button button-primary u-full-width" v-if="current_tab == 2">
                        Send message
                    </button>
                    <button type="submit" class="button button-primary u-full-width" v-else>
                        Next
                    </button>
                </div>
                <div class="col-md-6 order-md-6" v-bind:style="{ visibility: current_tab == 0 ? 'hidden' : 'initial' }">
                    <a class="button u-full-width" @click="current_tab -= 1">
                        Back
                    </a>
                </div>
            </div>
            <!--             </transition-group>
 -->
        </form>
        <div class="alert alert-info" role="alert" v-show="loading" key="2">
            Please wait. Your message is being sent...
            <!-- <div class="progress">
                    <div
                        class="progress-bar"
                        role="progressbar"
                        :style="'width:' + progress + '%'"
                        :aria-valuenow="progress"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    ></div>
                </div> -->
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
                <div class="col-md-12">
                    <label class="mb-0">You can also contact us here</label>
                    <p>06230 Villefranche sur Mer, France</p>

                    <p class="mb-0">+33 4 86 06 08 59</p>
                    <p>contact@mmediagroup.fr</p>

                    <div class="flex" style="flex-wrap: wrap;">
                        <a class="button button-secondary" href="mailto:contact@mmediagroup.fr">Email</a>
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
        };
    },
    mounted() {
        // this.getUser()
    },
    methods: {
        updateFile: function () {
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
        getUser: function () {
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
    },
};
</script>
