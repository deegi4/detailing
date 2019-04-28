<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div v-for="carClass in priceList">
                        <h3>{{carClass.name}}</h3>
                        <div class="card" v-for="service_type in carClass.service_types">
                            <div class="card-header">{{service_type.name}}</div>
                            <div  class="card-body" v-for="job in service_type.jobs">
                                <div data-entity="job" :data-id="job.id">
                                    {{job.name}} = {{job.price}} $
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'carClasses', 'priceList'
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
