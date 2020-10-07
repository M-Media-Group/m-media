<template>
    <transition-group name="fade" mode="out-in" tag="div" style="width: 100%">
        <div class="list-group" v-if="ads.length > 0" key="notifications">
            <article
                v-for="ad in ads"
                class="list-group-item list-group-item-action action-section round-all-round mt-5"
                style="cursor: pointer"
                data-aos="fade"
            >
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 mt-0">{{ ad.name }}</h5>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div>{{ ad.impressions }}</div>
                        <div>Impressions</div>
                    </div>
                    <div class="col-md">
                        <div>{{ ad.clicks }}</div>
                        <div>Clicks</div>
                    </div>
                    <div class="col-md">
                        <div>{{ ad.conversions }}</div>
                        <div>Conversions</div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md">
                        <div>{{ ad.cost }}</div>
                        <div>Cost</div>
                    </div>
                    <div class="col-md"></div>
                    <div class="col-md">
                        <div>{{ ad.conversion_rate }}</div>
                        <div>Conversion rate</div>
                    </div>
                </div>
            </article>
        </div>
        <div v-else-if="loading" key="loading" class="alert" data-aos="fade">Loading...</div>
        <div v-else class="alert text-muted" key="error">You have no ad accounts.</div>
    </transition-group>
</template>

<script>
export default {
    props: ['adaccountid'],
    data() {
        return {
            loading: true,
            error: false,
            success: false,
            ads: [],
        };
    },

    mounted() {
        this.getAds();
    },
    methods: {
        timestamp: function (timestamp) {
            return moment(timestamp).fromNow();
        },

        getAds: function () {
            this.loading = true;
            //data.append('_method', 'put'); // add this
            axios
                .get('/api/ad-accounts/' + this.adaccountid) // change this to post )
                .then((res) => {
                    this.ads = res.data.ads;
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.loading = false;
                    this.error = true;
                });
        },
    },
};
</script>
