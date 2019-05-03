<template>
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li v-for="carClassItem in carClassList"
                :class="{'active': carClassId == carClassItem.id}"
                @click="selectCarClass(carClassItem.id)"
            >
                <a :href="'#carClass'+carClassItem.id" data-toggle="tab">{{carClassItem.name}}</a>
            </li>
        </ul>
        <div class="tab-content" >
<!--            <div class="tab-pane" :id="'carClass'+carClass.id" v-for="carClass in priceList">-->
            <div>
                <h3>{{carClass.name}}</h3>
                <price-list
                        :price="price"
                ></price-list>
                <date-list></date-list>
                <button class="btn btn-primary">Register</button>
            </div>

        </div>
    </div>

</template>

<script>
    // import axios from 'axios';
    import DateList from './DateList.vue';
    import PriceList from './PriceList.vue';
    export default {
        components: {
            PriceList: PriceList,
            DateList: DateList,
        },
        data() {
            return {
                carClassList: [],
                priceList: [],
                price: [],
                carClassId: 1,
                carClass: [],
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {

                window.axios.get('/appointments/price-list').then((response) => {
                    this.priceList = response.data;
                    this.price = this.priceList[this.carClassId];
                    console.log(this.priceList);
                });

                window.axios.get('/appointments/car-class-list').then((response) => {
                    this.carClassList = response.data;
                    this.carClass = this.carClassList[this.carClassId];
                    console.log(this.carClassList);
                });
            },
            selectCarClass: function (carClassId) {
                this.carClassId = carClassId;
                this.carClass = this.carClassList[this.carClassId];
                this.price = this.priceList[this.carClassId];
            },
        }
    }
</script>
