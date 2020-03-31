<template>
    <ul>
        <!-- <a class="action-section card mb-5 mt-5 round-all-round action-section-hover" :href="post.link" target="_BLANK" rel="noopener" v-for="post in posts">
          <div class="row no-gutters">
            <div v-if="post._embedded['wp:featuredmedia']" class="col-md-12 p-5">
              <img :src="post._embedded['wp:featuredmedia']['0'].source_url" class="card-img" style="max-height: 200px;object-fit: scale-down;" alt="">
            </div>
            <div class="col-md-12">
              <div class="card-body">
                <h5 class="card-title" v-html="post.title.rendered"></h5>
                <p class="card-text" v-html="post.excerpt.rendered"></p>
                <p class="card-text"><small class="text-muted">{{post.modified}}</small></p>
              </div>
            </div>
          </div>
        </a> -->
        <li v-for="post in posts">
            <a :href="post.link" target="_BLANK" rel="noopener noreferrer" v-html="post.title.rendered"></a>
        </li>
    </ul>
</template>

<script>
export default {
    props: ['category'],
    data() {
        return {
            loading: false,
            error: false,
            posts: [],
        };
    },
    mounted() {
        //this.getUser()
        this.getPosts();
    },
    methods: {
        getPosts: function() {
            this.posts = [];
            this.loading = true;
            //data.append('_method', 'put'); // add this
            delete axios.defaults.headers.common['X-Requested-With'];
            delete axios.defaults.headers.common['X-CSRF-TOKEN'];

            axios
                .get('https://blog.mmediagroup.fr/wp-json/wp/v2/posts?categories=' + this.category + '&_embed', {
                    responseType: 'json',
                    // withCredentials: true,
                }) // change this to post )
                .then((res) => {
                    //console.log(res)
                    this.posts = res.data;
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
