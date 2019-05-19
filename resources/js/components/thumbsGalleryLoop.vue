<template>
        <div class="container" :style="'height: '+sliderHeight+'px'">
            <!-- swiper1 -->
            <swiper :options="swiperOptionTop" class="gallery-top" ref="swiperTop">
                <swiper-slide
                        v-for="(img, i) in images"
                        :key="i"
                        :class="'slide-'+i"
                        :style="'background-image:url('+img.src+');'"
                >
                </swiper-slide>

                <div class="swiper-button-next swiper-button-white" slot="button-next">></div>
                <div class="swiper-button-prev swiper-button-white" slot="button-prev"><</div>
            </swiper>
            <!-- swiper2 Thumbs -->
            <swiper :options="swiperOptionThumbs" class="gallery-thumbs" ref="swiperThumbs">
                <swiper-slide
                        v-for="(img, i) in images"
                        :key="i"
                        :class="'slide-'+i"
                        :style="'background-image:url('+img.src+');'"
                ></swiper-slide>
            </swiper>
        </div>
</template>


<script>

    export default {
        props: [
            'images',
            'height',

        ],
        computed:{
            sliderHeight: function () {
                debugger;
                return this.windowHeight*this.height;
            }
        },
        data() {
            return {
                windowWidth: 0,
                windowHeight: 0,
                swiperOptionTop: {
                    spaceBetween: 10,
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
                    loopedSlides: this.images.length, //looped slides should be the same
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    }
                },
                swiperOptionThumbs: {
                    spaceBetween: 10,
                    // centeredSlides: true,
                    slidesPerView: this.images.length,
                    // slidesPerView: 'auto',
                    touchRatio: 0.2,
                    loop: true,
                    loopedSlides: this.images.length, //looped slides should be the same
                    slideToClickedSlide: true,
                }
            }
        },
        mounted() {
            debugger;
            this.$nextTick(() => {
                window.addEventListener('resize', this.updateWindowWidth);
                window.addEventListener('resize', this.updateWindowHeight);
                this.updateWindowWidth();
                this.updateWindowHeight();

                const swiperTop = this.$refs.swiperTop.swiper;
                const swiperThumbs = this.$refs.swiperThumbs.swiper;
                swiperTop.controller.control = swiperThumbs;
                swiperThumbs.controller.control = swiperTop;
            })
        },
        methods: {
            updateWindowWidth(event) {
                this.windowWidth = document.documentElement.clientWidth;
            },

            updateWindowHeight(event) {
                this.windowHeight = document.documentElement.clientHeight;
            }
        },
        beforeDestroy() {
            window.removeEventListener('resize', this.updateWindowWidth);
            window.removeEventListener('resize', this.updateWindowHeight);
        }
    }
</script>

<style lang="scss" scoped>
    .swiper-container {
        /*padding: 10px 0;*/
        /*background-color: #212529;*/
    }
    .swiper-button-white{
        background: none;
        font-family: 'Rubik Mono One', cursive;
        //color: #FFFFFF;
        //background: #FFFFFF;
        //text-shadow: $shadow-size-header $shadow-size-header 0 $shadow-color-base, $shadow-size-header $shadow-size-header-inverse 0 $shadow-color-base, $shadow-size-header-inverse $shadow-size-header 0 $shadow-color-base, $shadow-size-header-inverse $shadow-size-header-inverse 0 $shadow-color-base, $shadow-size-header 0px 0 $shadow-color-base, 0px $shadow-size-header 0 $shadow-color-base, $shadow-size-header-inverse 0px 0 $shadow-color-base, 0px $shadow-size-header-inverse 0 $shadow-color-base;
        text-align: center;
        font-size: 2rem;
        color: #212529;
    }
    .swiper-slide {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    .gallery-top {
        height: 80%!important;
        width: 100%;
    }
    .gallery-thumbs {
        height: 20%!important;
        box-sizing: border-box;
        padding: 10px 0;
    }
    .gallery-thumbs .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
    }
    .gallery-thumbs .swiper-slide-active {
        opacity: 1;
    }
</style>