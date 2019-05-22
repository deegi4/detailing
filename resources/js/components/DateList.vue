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
                <div class="list-group" >
                    <div class="mx-2 my-1 date" v-for="hour in day.hours">
                        <div class="p-1 list-group-item list-group-item-action pointer" data-entity="hour"
                            :data-disabled="hour.disable"
                            :data-date="hour.date"
                            :disabled="isDisabled(hour.disable)"
                            :class="{selected: isDisabled(hour.selected), disabled: isDisabled(hour.disable)}"
                            @click="checkDate(hour.date, hour.hour, day.day, day.week_number)"
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
        props: [
            'dates',
            'hoursCount',
        ],
        data() {
            return {
                dateList: [],
                date: '',
                weekIndex: 0,
                selectedDay: null,
                selectedHour: null,
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
        watch: {
            hoursCount: function(newVal, oldVal) { // watch it
                this.checkDate(this.date, this.selectedHour, this.selectedDay, this.weekIndex);
                // console.log('Prop changed: ', newVal, ' | was: ', oldVal)
            },
            dates: function(newVal, oldVal) { // watch it
                this.dateList = this.dates;
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                this.dateList = this.dates;
                this.resetSelectedDates();
            },
            isDisabled(disable){
                return disable;
            },
            checkDate(date, selectedHour, selectedDay, weekIndex){

                this.resetSelectedDates(date, selectedHour, selectedDay, weekIndex);
                if(!this.isFreeTime(date, selectedHour, selectedDay, weekIndex)
                ){
                    // || this.dateList[selectedDay]['hours'][selectedHour-10]['disable'] == 1){
                    this.weekIndex = 0;
                    this.selectedDay = null;
                    this.selectedHour = null;
                    this.date = '';
                    this.$emit('return', this.date);
                    return;
                }
                this.weekIndex = weekIndex;
                this.selectedDay = selectedDay;
                this.selectedHour = selectedHour;
                this.date = date;

                let hoursCount = 0;
                for ( let iterDay = selectedDay; iterDay < this.dateList.length; iterDay++){

                    for ( let iterHour = 0; iterHour < this.dateList[iterDay].hours.length; iterHour++){
                        if(!hoursCount && iterHour < selectedHour - 10) continue;
                        hoursCount++;
                        if(hoursCount > this.hoursCount ) break;
                        if(!this.dateList[iterDay]['hours'][iterHour]['disable'])
                            this.$set(this.dateList[iterDay]['hours'][iterHour], 'selected', 1);
                            // this.dateList[iterDay]['hours'][iterHour]['selected'] = 1;


                    }
                    if(hoursCount > this.hoursCount ) break;
                }
                this.$emit('return', this.date);
            },
            resetSelectedDates(){
                for ( let iterDay = 0; iterDay < this.dateList.length; iterDay++){
                    for ( let iterHour = 0; iterHour < this.dateList[iterDay].hours.length; iterHour++){
                        this.$set(this.dateList[iterDay]['hours'][iterHour], 'selected', 0);
                    }
                }
            },
            isFreeTime(selectedDate, selectedHour, selectedDay, selectedWeekIndex){
                let hoursCount = 0;
                for ( let iterDay = selectedDay; iterDay < this.dateList.length; iterDay++){
                    for ( let iterHour = 0; iterHour < this.dateList[iterDay].hours.length; iterHour++){
                        if(!hoursCount && iterHour < selectedHour - 10) continue;

                        hoursCount++;
                        if(hoursCount > this.hoursCount )  return true;
                        if(this.dateList[iterDay]['hours'][iterHour]['disable']) return false;
                    }
                    if(hoursCount > this.hoursCount )  return true;
                }
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
    }
    .disabled {
        background: #cdd6de;
    }
    .swiper-scrollbar{
        top: 3px;
    }
    .swiper-container {
        text-align: center;
    }
</style>