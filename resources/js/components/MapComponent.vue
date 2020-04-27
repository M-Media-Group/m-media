<template>
    <v-map
        :zoom="13"
        :center="initialLocation"
        style="width: 100%; height: 70vh; border-radius: var(--border-radius); z-index: 1;"
    >
        <img src="/images/vendor/leaflet/dist/marker-icon-2x.png" class="map-marker-centered" />
        <v-tilelayer url="https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png"></v-tilelayer>
        <v-locatecontrol :options="allLocateOptions"></v-locatecontrol>
        <v-geosearch :options="geosearchOptions"></v-geosearch>
    </v-map>
</template>

<script>
import { LMap, LTileLayer } from 'vue2-leaflet';
import { latLng, Icon, icon } from 'leaflet';
import { OpenStreetMapProvider } from 'leaflet-geosearch';
import Vue2LeafletLocatecontrol from 'vue2-leaflet-locatecontrol/Vue2LeafletLocatecontrol';
import VGeosearch from 'vue2-leaflet-geosearch';

var greenIcon = L.icon({
    iconUrl: '/images/logo.png',
    // iconSize:     [38, 95], // size of the icon
    iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
    popupAnchor: [-3, -76], // point from which the popup should open relative to the iconAnchor
});

export default {
    components: {
        'v-map': LMap,
        'v-tilelayer': LTileLayer,
        'v-locatecontrol': Vue2LeafletLocatecontrol,
        'v-geosearch': VGeosearch,
    },
    data() {
        return {
            initialLocation: [43.704, 7.3111],
            allLocateOptions: {
                locateOptions: {
                    enableHighAccuracy: true,
                },
            },
            geosearchOptions: {
                // Important part Here
                provider: new OpenStreetMapProvider(),
                style: 'button',
                autoClose: true,
                showPopup: true,
                showMarker: false,
                keepResult: true,
                marker: {
                    icon: greenIcon,
                    draggable: false,
                },
            },
        };
    },
};
</script>
<style scoped>
@import 'https://unpkg.com/leaflet-geosearch@2.6.0/assets/css/leaflet.css';
img.map-marker-centered {
    width: 25px;
    height: 41px;
    position: absolute;
    z-index: 999;
    left: calc(50% - 12.5px);
    top: calc(50% - 41px);
    transition: all 0.4s ease;
    object-fit: contain;
}
</style>
