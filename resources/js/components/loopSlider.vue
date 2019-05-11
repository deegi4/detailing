<template>
        <div >
            <!-- swiper -->
            <swiper :options="swiperOption">
                <swiper-slide
                        v-for="(img, key) in images"
                        :key="key"
                >
                    <div class="swiper-zoom-container img-height">
                        <img :src="img.src">
                    </div>
                </swiper-slide>
                <div class="swiper-pagination" slot="pagination"></div>
                <div class="swiper-button-prev" slot="button-prev"></div>
                <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </div>
</template>

<script>
    // require styles
    import 'swiper/dist/css/swiper.css'

    import { swiper, swiperSlide } from 'vue-awesome-swiper'
    export default {
        components: {
            swiper,
            swiperSlide
        },
        props: [
            'images',
        ],
        data() {
            return {
                swiperOption: {
                    autoHeight: true, //enable auto height
                    zoom: true,
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        // dynamicBullets: true,
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    }
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .swiper-container {
        background-color: #000;
    }
    .img-height{
        height: 576px;
    }
</style>