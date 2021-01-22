<template>
    <swiper ref="mySwiper" :options="swiperOptions">
        <swiper-slide v-for="post in news" >
            <div class="header-section row m-0 text-center u-bg-primary with-bg-dec u-bg-blur" :style="(post['_embedded']['wp:featuredmedia'] ? 'background: url('+post['_embedded']['wp:featuredmedia'][0].source_url+') rgba(36,110,185,0.50);background-blend-mode: multiply;' : '')+' background-position: center top;background-repeat: no-repeat;background-size: cover;height:100%;'">
                <div class="col-md-12">
                    <p class="mb-0 mt-3 m-text-label mx-auto" data-aos="fade" data-aos-delay="150">News</p>
                    <h3 class="mt-0 mx-auto text-title-heading" data-aos="fade">{{post.title.rendered}}</h3>
                    <div data-aos="fade" class="mx-auto m-text-body d-none d-md-block mb-n3" data-aos-delay="300" v-html="post.excerpt.rendered"></div>
                    <a class="button button-secondary mt-0 mb-5" :href="post.link" target="_BLANK" data-aos="fade" data-aos-delay="300">Read the full article</a>
                </div>
            </div>
        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
    </swiper>
</template>
<script>
export default {
    name: 'carrousel',
    data() {
        return {
            swiperOptions: {
                autoHeight: true,
                loop: true,
                preloadImages: false,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable:true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                // Some Swiper option/callback...
            },
            news: [],
            loading: false,
        }
    },
    computed: {
        swiper() {
            return this.$refs.mySwiper.$swiper
        }
    },
    mounted() {
        // console.log('Current Swiper instance object', this.swiper)
        this.getNews()
    },
    methods: {
        getNews: function() {
            this.news = [];
            this.loading = true;
            //data.append('_method', 'put'); // add this
            delete axios.defaults.headers.common['X-Requested-With'];
            delete axios.defaults.headers.common['X-CSRF-TOKEN'];
            delete axios.defaults.headers.common['X-SOCKET-ID'];
            delete axios.defaults.headers.common['x-socket-id'];

            axios
                .get('https://blog.mmediagroup.fr/wp-json/wp/v2/posts?parent_category=52&_embed', {
                    responseType: 'json',
                    // withCredentials: true,
                }) // change this to post )
                .then((res) => {
                    //console.log(res)
                    this.news = res.data;
                    this.loading = false;
                    this.swiper.slideTo(1, 1000, false)
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                    this.error = true;
                });
            //
            //console.log(error);
        },
    }
}

</script>
