<template>
    <div>
        <transition-group name="fade" mode="out-in">
            <form
                @submit.prevent="updateFile"
                action="#"
                method="POST"
                enctype="multipart/form-data"
                v-show="!success && !error && !loading"
                key="1"
                class="mb-0"
            >

                <div class="form-group row">
                    <label for="file" class="col-md-4 col-form-label text-md-right">Your first name</label>

                    <div class="col-md-6">
                        <input
                            name="name"
                            v-model="name"
                            id="name"
                            class="form-control mb-0"
                            type="name"
                            placeholder="Name (required)"
                            required
                        />
                    </div>
                </div>
                <div class="form-group row mb-5">
                    <label for="file" class="col-md-4 col-form-label text-md-right">Your surname</label>

                    <div class="col-md-6">
                        <input
                            name="surname"
                            v-model="surname"
                            id="surname"
                            class="form-control mb-0"
                            type="text"
                            placeholder="Last name (required)"
                            required
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file" class="col-md-4 col-form-label text-md-right">Your email address</label>

                    <div class="col-md-6">
                        <input
                            name="email"
                            v-model="email"
                            id="email"
                            class="form-control mb-0"
                            type="email"
                            placeholder="Email address (required)"
                            required
                        />
                    </div>
                </div>
                <div class="form-group row mb-5">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Your phone number</label>

                    <div class="col-md-6">
                        <input
                            name="phone"
                            v-model="phone"
                            id="phone"
                            class="form-control mb-0"
                            type="text"
                            placeholder="Phone number"
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Your message</label>

                    <div class="col-md-6">
                        <textarea-autosize
                            name="message"
                            v-model="message"
                            id="message"
                            class="form-control"
                            placeholder="Message (required)"
                            rows="3"
                            required
                        />
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="button button-primary">
                            Send message
                        </button>
                    </div>
                </div>
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
                Message sent!<br />
<!--                 <a href="#" class="button button-primary" v-on:click.prevent="success = false">Upload another file</a> -->
            </div>
            <div class="alert alert-danger" role="alert" v-show="error" key="4">
                File error! {{ error_msg }}<br />
                <a href="#" class="button button-primary" v-on:click.prevent="error = false">Retry file upload</a>
                <a href="/contact" class="button">Contact us for help</a>
            </div>
        </transition-group>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: '',
            loading: false,
            error: false,
            error_msg: false,
            success: false,
            user: null,
            progress: 0,
            email: null,
            phone: null,
            message: null,
            name: null,
            surname: null,
            use_url: false,
            is_logged_in_user: false,
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
            data.append('message', this.message);

            //data.append('_method', 'put'); // add this
            axios
                .post('/api/contact', data) // change this to post )
                .then((res) => {
                    this.success = true;
                    this.error = false;
                    console.log(res);
                    this.loading = false;
                    this.title = null;
                    dataLayer.push({'event': 'contact'});
                })
                .catch((error) => {
                    this.error = true;
                    this.success = false;
                    this.error_msg = error.message;
                    console.log(error);
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
