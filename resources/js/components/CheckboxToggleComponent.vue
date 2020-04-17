<template>
    <div>
        <input
            id="dynamic_checkbox"
            @change="newInput"
            v-model="is_servicable"
            type="checkbox"
            autocomplete="off"
            class="form-control"
            name="dynamic_checkbox"
        />
    </div>
</template>

<script>
export default {
    props: ['checked', 'url', 'column_title'],
    data() {
        return {
            is_servicable: true,
            title: 'is_servicable',
        };
    },
    mounted() {
        this.is_servicable = this.checked;
        this.title = this.column_title;
    },
    methods: {
        newInput(event) {
            this.is_servicable = event.target.checked;
            this.updateInput();
        },
        updateInput: function () {
            let data = new FormData();
            data.append(this.title, this.is_servicable ? 1 : 0);
            let config = {
                onUploadProgress: (progressEvent) => {
                    //this.progress = Math.floor((progressEvent.loaded * 100) / progressEvent.total);
                },
            };
            data.append('_method', 'patch'); // add this
            axios
                .post(this.url, data, config) // change this to post )
                .then((res) => {
                    console.log(res);
                })
                .catch((error) => {
                    console.log(error);
                    this.is_servicable = !this.is_servicable;
                }); //
            //console.log(error);
        },
    },
};
</script>
