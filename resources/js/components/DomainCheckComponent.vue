<template>
    <div>
        <transition-group name="fade" mode="out-in">
            <div class="alert alert-success" role="alert" v-show="success" key="3">
                <strong>{{ domain }}</strong> is available!<br /><br />
                <a href="/contact" class="button button-secondary">Contact M Media</a>
                <a href="#" class="button" v-on:click.prevent="success = false">Try another domain</a>
            </div>
            <div class="alert alert-danger" role="alert" v-show="error" key="4">
                This top-level domain (extension) is unsupported by M Media - {{ error_msg }}<br />
                <a href="#" class="button button-primary" v-on:click.prevent="error = false">Try another domain</a>
                <a
                    href="https://blog.mmediagroup.fr/post/top-level-domains-on-m-media/"
                    target="_BLANK"
                    rel="noopener"
                    class="button"
                    >See the top-level domains we support</a
                >
            </div>
            <form
                @submit.prevent="getDomain"
                action="#"
                method="POST"
                enctype="multipart/form-data"
                v-show="!success && !error"
                key="1"
                class="mb-0"
            >
                <div class="form-group row">
                    <label for="domain" class="col-md-4 col-form-label text-md-right">Domain</label>

                    <div class="col-md-6">
                        <input
                            name="domain"
                            v-model="domain"
                            v-on:input="availability = null"
                            id="domain"
                            class="form-control"
                            type="text"
                            placeholder="example.com"
                            :disabled="loading"
                            required
                        />
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="button button-primary" :disabled="loading">
                            Check availability
                        </button>
                    </div>
                </div>
            </form>
            <div class="alert alert-secondary" v-if="availability && availability !== 'AVAILABLE'" key="availnotice">
                <a :href="'/tools/website-debugger/' + domain">{{ domain }}</a> is {{ availability.toLowerCase() }}
                <span v-if="transferability && transferability == 'TRANSFERABLE'"
                    >, but if you already own it you can transfer it to M Media.</span
                >
            </div>
            <div
                class="table-responsive"
                v-if="suggestions && availability && availability !== 'AVAILABLE'"
                key="suggestions"
            >
                <table class="table">
                    <thead>
                        <tr>
                            <th>Similar available domain</th>
                            <th>Extension (top level domain)</th>
                            <th>Contact us</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="suggestion in suggestions" :key="suggestion['domain']">
                            <td>{{ suggestion['domain'] }}</td>
                            <td class="text-muted">{{ suggestion['tld'] }}</td>
                            <td><a href="/contact">Contact us</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-info" role="alert" v-show="loading" key="2">Checking...</div>
            <div class="row" key="5">
                <div class="col-md-8 offset-md-4 text-muted">
                    <a
                        href="https://blog.mmediagroup.fr/post/check-if-domain-available-on-m-media/"
                        target="_BLANK"
                        rel="noopener"
                        >Need help?</a
                    >
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script>
export default {
    props: ['url'],
    data() {
        return {
            avatar: null,
            avatar_url: null,
            domain: '',
            loading: false,
            error: false,
            availability: '',
            transferability: '',
            success: false,
            user: null,
            progress: 0,
            suggestions: [],
        };
    },
    mounted() {
        //this.getUser()
    },
    methods: {
        newFile(event) {
            let files = event.target.files;
            if (files.length) this.avatar = files[0];
            const data = URL.createObjectURL(this.avatar);
            this.avatar_url = data;
            this.domain = this.avatar.name;
        },
        updateFile: function () {
            let data = new FormData();
            this.loading = true;
            data.append('file', this.avatar);
            data.append('domain', this.domain);
            let config = {
                onUploadProgress: (progressEvent) => {
                    this.progress = Math.floor((progressEvent.loaded * 100) / progressEvent.total);
                },
            };
            //data.append('_method', 'put'); // add this
            axios
                .post(this.url, data, config) // change this to post )
                .then((res) => {
                    this.success = true;
                    this.error = false;
                    console.log(res);
                    this.loading = false;
                    this.file_url = res.data.url;
                    this.avatar_url = null;
                    this.domain = null;
                    const input = this.$refs.fileInput;
                    input.type = 'text';
                    input.type = 'file';
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
        getDomain: function () {
            var text = this.domain.match(/([a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i);
            this.domain = text[0];
            this.availability = '';
            this.loading = true;
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/domains/' + this.domain + '/availability') // change this to post )
                .then((res) => {
                    this.availability = res.data.availability;
                    this.loading = false;
                    if (res.data.availability == 'AVAILABLE') {
                        this.success = true;
                    } else {
                        this.checkIfTransferable();
                        this.getSuggested();
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                    this.error = true;
                });
            //
            //console.log(error);
        },
        checkIfTransferable: function () {
            var text = this.domain.match(/([a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i);
            this.domain = text[0];
            this.transferability = '';
            this.loading = true;
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/domains/' + this.domain + '/transferability') // change this to post )
                .then((res) => {
                    this.transferability = res.data.transferability;
                    this.loading = false;
                    if (res.data.transferability == 'TRANSFERABLE') {
                        this.success = true;
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                    this.error = true;
                });
            //
            //console.log(error);
        },
        getSuggested: function () {
            this.suggestions = [];
            this.loading = true;
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/domains/' + this.domain + '/suggestions') // change this to post )
                .then((res) => {
                    this.suggestions = res.data.suggestions;
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                    this.error = true;
                });
            //
            //console.log(error);
        },
    },
};
</script>
