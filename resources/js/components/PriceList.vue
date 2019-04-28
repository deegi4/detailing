<template>
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active"  v-for="carClass in carClasses">
                <a :href="'#carClass'+carClass.id" data-toggle="tab">{{carClass.name}}</a>
            </li>
        </ul>
        <div class="tab-content" >
            <div class="tab-pane" :id="'carClass'+carClass.id" v-for="carClass in priceList">
                <h3>{{carClass.name}}123</h3>
                <div class="card" v-for="service_type in carClass.service_types">
                    <div class="card-header">{{service_type.name}}</div>
                    <div  class="card-body" v-for="job in service_type.jobs">
                        <div data-entity="job" :data-id="job.id">
                            <input type="checkbox">
                            {{job.name}} = {{job.price}} $
                        </div>
                    </div>
                </div>
                <date-list :date-list="dateList"></date-list>
                <button class="btn btn-primary">Register</button>
            </div>

        </div>
    </div>

</template>

<script>
    // import DateList from './DateList.vue';
    export default {
        components: { 'date-list': require('./DateList.vue').default},
        props: [
            'carClasses',
            'priceList',
            'dateList',
        ],
        mounted() {
            console.log('Component mounted.');
            this.update();

        },
        methods: {
            update: function () {
                console.log(this.carClasses);
                console.log(this.priceList);
            }
        }
    }
</script>
