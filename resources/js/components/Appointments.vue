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
        <div class="tab-content"
             v-if="carClassId > 0"
        >
<!--            <div class="tab-pane" :id="'carClass'+carClass.id" v-for="carClass in priceList">-->
            <div>
                <h3>{{carClass.name}}</h3>
                <price-list
                        v-if="price.service_types !== undefined"
                        :price="price"
                        @return="returnPriceList"
                ></price-list>
                <date-list
                        @return="returnDateList"
                ></date-list>
                    Client:
                    <input type="text"
                           v-model="client"
                    >
                    Contact:
                    <input type="text"
                           v-model="contact"
                    >
                    <button class="btn btn-primary"
                            :disabled="isDisabledRegister()"
                            @click="registerAppointment"
                    >
                        Register
                    </button>
            </div>

        </div>
    </div>

</template>

<script>
    import axios from 'axios';
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
                carClassId: 0,
                carClass: [],
                checkJobs: {},
                checkJobIds: [],
                cost: 0,
                client: '',
                contact: '',
                date: '',
                errors: [],
            }
        },
        computed() {

        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {

                axios.get('/appointments/price-list').then((response) => {
                    this.priceList = response.data;
                    if(this.carClassId){
                        this.price = this.priceList[this.carClassId];
                    }
                    // console.log(this.priceList);
                });

                axios.get('/appointments/car-class-list').then((response) => {
                    this.carClassList = response.data;
                    if(this.carClassId){
                        this.carClass = this.carClassList[this.carClassId];
                    }
                    // console.log(this.carClassList);
                });
            },
            selectCarClass: function (carClassId) {
                this.carClassId = carClassId;
                this.carClass = this.carClassList[this.carClassId];
                this.price = this.priceList[this.carClassId];
            },
            reset(){
                this.carClassId = 0;
                this.carClass = [];
                this.price = [];
                this.checkJobs = {};
                this.checkJobIds = [];
                this.cost = 0;
                this.client = '';
                this.contact = '';
                this.date = '';
            },
            isDisabledRegister(){
                debugger;
                let isDisabledRegister =
                    this.date.length == 0 ||
                    this.client.length == 0 ||
                    this.contact.length == 0 ||
                    this.checkJobIds.length == 0;
                return isDisabledRegister;
            },
            returnPriceList(cost, checkJobIds, checkJobs){
                this.cost = cost;
                this.checkJobIds = checkJobIds;
                this.checkJobs = checkJobs;
            },
            returnDateList(date){
                this.date = date;
            },
            registerAppointment(){

                debugger;
                console.log(this.cost);
                console.log(this.checkJobIds);
                console.log(this.checkJobs);
                console.log(this.client);
                console.log(this.contact);
                axios.post('/appointments/register', {

                    date: this.date,
                    cost: this.cost,
                    checkJobIds: this.checkJobIds,
                    checkJobs: this.checkJobs,
                    client: this.client,
                    contact: this.contact,
                })
                    .then(response => {})
                    .catch(e => {
                        this.errors.push(e)
                    });
                this.reset();

            }
        }
    }
</script>
