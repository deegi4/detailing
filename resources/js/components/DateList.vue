<template>
    <div class="container">
        <div class="row-14 week justify-content-center">
            <div class="col-2" v-for="day in dateList">
                <div class="pt-4">{{day.week_day}}</div>
                <ul class="list-group" v-for="hour in day.hours">
                    <li class="list-group-item list-group-item-action" data-entity="hour" :data-disabled="hour.disable" :data-date="hour.date">
                        {{hour.start_time}} - {{hour.end_time}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                dateList: [],
                weekIndex: 0,
                day: null,
                hour: null,
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
                    console.log(this.dateList);
                });
            }
        }
    }
</script>
