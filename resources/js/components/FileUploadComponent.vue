<template>
    <div>
        <form action="/files" enctype="multipart/form-data" method="post">
            <div class="form-group row">
                <label for="file" class="col-md-4 col-form-label text-md-right">File</label>

                <div class="col-md-6">
                    <input type="file" name="file" id="file" class="input" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                <div class="col-md-6">
                    <input name="title" id="title" class="form-control" type="text" placeholder="Descriptive titles help us tag the file">
                </div>

            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="button button-primary">
                        Upload
                    </button>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12 text-muted">
                    Your file is private by default, which means that each URL generated to your file by M Media is valid only for five minutes. If you want your file public with long-lived URLs, <a href="/contact">contact us</a> after uploading.
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('File Component mounted.')
        }
    }
</script>
