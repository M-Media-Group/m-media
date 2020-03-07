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
                <div class="row mb-3" v-show="avatar_url">
                    <img class="u-center" :src="avatar_url" style="max-height: 100px;" />
                </div>
                <div class="form-group row">
                    <label for="file" class="col-md-4 col-form-label text-md-right">File</label>

                    <div class="col-md-6">
                        <input
                            type="file"
                            @change="newFile"
                            name="file"
                            id="file"
                            ref="fileInput"
                            class="input"
                            required
                            autofocus
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input
                            name="title"
                            v-model="title"
                            id="title"
                            class="form-control"
                            type="text"
                            placeholder="Descriptive titles help us tag the file"
                        />
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="button button-primary">
                            Upload
                        </button>
                    </div>
                </div>
            </form>
            <div class="alert alert-info" role="alert" v-show="loading" key="2">
                Please wait. Your file is uploading...
                <div class="progress">
                    <div
                        class="progress-bar"
                        role="progressbar"
                        :style="'width:' + progress + '%'"
                        :aria-valuenow="progress"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    ></div>
                </div>
            </div>
            <div class="alert alert-success" role="alert" v-show="success" key="3">
                File uploaded!<br />
                <a href="#" class="button button-primary" v-on:click.prevent="success = false">Upload another file</a>
                <a :href="'/files/' + file_url" class="button">Open file</a>
                <a class="button" :href="'/files?user=' + file_user_id">See all files</a>
            </div>
            <div class="alert alert-danger" role="alert" v-show="error" key="4">
                File error! {{ error_msg }}<br />
                <a href="#" class="button button-primary" v-on:click.prevent="error = false">Retry file upload</a>
                <a href="/contact" class="button">Contact us for help</a>
            </div>
            <div class="row" key="5">
                <div class="col-md-8 offset-md-4 text-muted">
                    <span
                        class="label label-default"
                        v-tooltip:top="
                            'Each URL generated to your file is only valid for five minutes. If you want your file public with long-lived URLs, contact us.'
                        "
                        >Your file is private by default.</span
                    >
                    <br />
                    <a href="https://blog.mmediagroup.fr/post/share-files-with-m-media/" target="_BLANK" rel="noopener"
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
            title: '',
            loading: false,
            error: false,
            error_msg: false,
            success: false,
            user: null,
            progress: 0,
            file_url: null,
            file_user_id: null,
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
            this.title = this.avatar.name;
        },
        updateFile: function() {
            let data = new FormData();
            this.loading = true;
            data.append('file', this.avatar);
            data.append('title', this.title);
            let config = {
                onUploadProgress: progressEvent => {
                    this.progress = Math.floor((progressEvent.loaded * 100) / progressEvent.total);
                },
            };
            //data.append('_method', 'put'); // add this
            axios
                .post(this.url, data, config) // change this to post )
                .then(res => {
                    this.success = true;
                    this.error = false;
                    console.log(res);
                    this.loading = false;
                    this.file_url = res.data.id;
                    this.file_user_id = res.data.user_id;
                    this.avatar_url = null;
                    this.title = null;
                    const input = this.$refs.fileInput;
                    input.type = 'text';
                    input.type = 'file';
                })
                .catch(error => {
                    this.error = true;
                    this.success = false;
                    this.error_msg = error.message;
                    console.log(error);
                    this.loading = false;
                }); //
            //console.log(error);
        },
        getUser: function() {
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/user') // change this to post )
                .then(res => {
                    console.log('Go get');

                    console.log(res);
                })
                .catch(error => {
                    console.log(error);
                }); //
            //console.log(error);
        },
    },
};
</script>
