<template>
    <swiper ref="mySwiper" :options="swiperOptions">
        <swiper-slide v-for="(post, index) in news" :key="index">
            <div class="header-section row bg-secondary bg-blur" :style="(post['_embedded']['wp:featuredmedia'] ? 'background: url('+post['_embedded']['wp:featuredmedia'][0].source_url+') rgba(36,110,185,0.55);background-blend-mode: multiply;' : '')+' background-position: center top;background-repeat: no-repeat;background-size: cover;height:100%;'">
                <div class="twelve columns u-center-text">
                    <span class="u-center" data-aos="fade" data-aos-delay="150">{{post['_embedded']['wp:term'][0][0].name}}</span>
                    <h2 class="u-center" data-aos="fade">{{post.title.rendered}}</h2>
                    <div data-aos="fade" class="u-center" data-aos-delay="300" v-html="post.excerpt.rendered"></div>
                    <a class="button button-primary" :href="post.link" target="_BLANK" >Read the full article</a>
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
    props: {
        category: {
            type: Number,
            default: 52
        },
    },
    data() {
        return {
            swiperOptions: {
                // autoHeight: true,
                loop: true,
                cssMode: true,
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
                mousewheel: {
                    forceToAxis: true,
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
        // this.swiper.pagination.update()
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
                .get('https://blog.mmediagroup.fr/wp-json/wp/v2/posts?parent_category=' + this.category + '&_embed', {
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
<style>
.swiper-slide {
    height: auto;
}
</style>