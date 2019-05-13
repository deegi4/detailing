<template>
    <div>
        <swiper :options="swiperOption">
            <div class="swiper-scrollbar" slot="scrollbar"></div>
            <swiper-slide class=""
                          v-for="(day, key) in dateList"
                          :key="key"
            >

                <div class="date pt-3">{{day.week_day}}</div>
                <hr class="my-1 mx-4">
                <div class="list-group" v-for="hour in day.hours">
                    <div class="mx-2 my-1 date">
                        <div class="px-3 py-1 list-group-item list-group-item-action" data-entity="hour"
                            :data-disabled="hour.disable"
                            :data-date="hour.date"
                            :disabled="isDisabled(hour.disable)"
                            :class="{selected: isCheckDate(hour.date), disabled: isDisabled(hour.disable)}"
                            @click="checkDate(hour.date)"
                        >
                            {{hour.start_time}}
                            <!--                        - {{hour.end_time}}-->
                        </div>
                    </div>

                </div>
            </swiper-slide>
        </swiper>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                dateList: [],
                date: '',
                weekIndex: 0,
                day: null,
                hour: null,
                swiperOption: {
                    slidesPerView: 7,
                    spaceBetween: 0,
                    slidesPerGroup: 7,
                    loop: true,
                    loopFillGroupWithBlank: true,
                    scrollbar: {
                        el: '.swiper-scrollbar',
                        // hide: true
                    },
                },
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                window.axios.get('/appointments/date-list').then((response) => {
                    debugger;

                    this.dateList = response.data;
                    // console.log(this.dateList);
                });
            },
            isDisabled(disable){
                return ( disable == 1 );
            },
            checkDate(date){
                debugger;
                this.date = date;
                // console.log(this.date);
                this.$emit('return', this.date);
            },
            isCheckDate(date){
                return this.date == date;
            },
        }
    }
</script>

<style scoped>
    .selected {
        background: #545b62;
        color: white;
        border: lightgray 1px;
    }
    .disabled {
        background: lightgray;
    }
    .swiper-scrollbar{
        top: 3px;
    }
    .swiper-container {
        text-align: center;
    }
</style>