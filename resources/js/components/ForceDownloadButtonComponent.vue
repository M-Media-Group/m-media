<template>
    <div style="display: inline;">
        <button type="submit" class="button" v-on:click="downloadWithAxios">
            Download
        </button>
    </div>
</template>

<script>
export default {
    props: ['url'],
    data() {
        return {
            //url: null,
        };
    },
    mounted() {
        //this.getUser()
    },
    methods: {
        forceFileDownload(response) {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'file.png'); //or any other extension
            document.body.appendChild(link);
            link.click();
        },
        downloadWithAxios() {
            axios
                .get(this.url, {
                    responseType: 'arraybuffer',
                })
                .then((response) => {
                    this.forceFileDownload(response);
                })
                .catch((e) => console.log(e));
        },
    },
};
</script>
