<template>
    <div class="container">
        <div class="row">

<!--            <template  v-if="canRegisterAppointment">-->
                <div class="col-12 col-xl-5">
                    <div class="m-1 lead">
                        Заполните контактную информацию
                    </div>
                    <div class="mb-3 input-group input-group-lg">
                        <input v-model="client" type="text" class="form-control" placeholder="Имя" aria-label="Client">
                        <masked-input v-model="contact" mask="\+\7 (111) 111-11-11" class="form-control" placeholder="Контакт" aria-label="Contact"/>
                    </div>
                    <div class="m-1 lead"  v-if="carClassId == 0">
                        Выберите класс автомобиля
                    </div>
                    <div class="m-1 lead" v-else-if="checkJobIds.length == 0">
                        Выберите услуги
                    </div>
                    <div class="m-1 lead" v-else>
                        Стоимость: {{cost}} ₽
                    </div>

                    <div class="btn-block btn-group">
                        <button type="button" class="btn btn-secondary "
                                v-for="carClassItem in carClassList"
                                :class="{'active': carClassId == carClassItem.id}"
                                @click="selectCarClass(carClassItem.id)"
                        >
                            {{carClassItem.name}}
                        </button>
                    </div>
                    <price-list
                            v-if="price.service_types !== undefined"
                            :price="price"
                            @return="returnPriceList"
                    ></price-list>
                    <div class="m-1 lead" v-else-if="carClassId > 0">
                        Загрузка...
                    </div>
                </div>
                <div class="col-12 col-xl-7">

                    <!--
                    <div class="mx-1 my-3 lead" v-else>
                        Заполните контактную информацию
                    </div>
                    -->
                    <div class="m-1 lead">
                        Выберите время
                            {{titleHoursCount}}
                    </div>
                    <!--
                    <div class="m-1 lead" v-else>
                        {{date}}
                    </div>
                    -->
                    <date-list
                            :dates="dateList"
                            :hours-count="appHoursCount"
                            @return="returnDateList"
                    ></date-list>
                </div>
<!--            </template>-->
            <button class="mx-3 mt-3 btn btn-block btn-secondary btn-lg"
                    :disabled="isDisabledRegister()"
                    @click="registerAppointment"
            >
                Записаться на приём *
            </button>

            <div class="mx-4 my-1 lead mr-auto" v-if="isDisabledRegister()">
                * {{message}}
            </div>
            <div class="mx-4 my-1 lead mr-auto" v-else>
                * для записи нажмите кнопку "Записаться на приём"
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
        props: [
            'carClassList',
            'dates',
        ],
        data() {
            return {
                // carClassList: [],
                canRegisterAppointment: true,
                priceList: [],
                dateList: this.dates,
                message: 'для записи заполните все поля',
                price: [],
                hoursCount: 0,
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
        computed: {
            appHoursCount(){
                return this.hoursCount || 1;
            },
            titleHoursCount(){
                if(!this.hoursCount) return '';
                let dictionary = ['часов', 'час', 'часа', 'часа', 'часа'];
                let hours = dictionary[this.hoursCount] || dictionary[0];
                return ' ('+this.hoursCount+' '+hours+')';
            },

        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {

                // axios.get('/appointments/price-list').then((response) => {
                //     this.priceList = response.data;
                //     if(this.carClassId){
                //         this.price = this.priceList[this.carClassId];
                //     }
                //     // console.log(this.priceList);
                // });

                if(this.carClassList[this.carClassId] !== undefined){
                    this.carClass = this.carClassList[this.carClassId];
                }
                // axios.get('/appointments/car-class-list').then((response) => {
                //     this.carClassList = response.data;
                //     if(this.carClassId){
                //         this.carClass = this.carClassList[this.carClassId];
                //     }
                //     // console.log(this.carClassList);
                // });
            },
            selectCarClass: function (carClassId) {
                this.carClassId = carClassId;
                this.carClass = this.carClassList[this.carClassId];

                if(this.priceList[this.carClassId] !== undefined){
                    this.price = this.priceList[this.carClassId];
                }else{
                    this.price = [];
                    axios.get('/appointments/price-list/car-class-id/'+this.carClassId).then((response) => {
                        this.priceList[this.carClassId] = response.data;
                        this.price = this.priceList[this.carClassId];
                        // console.log(this.priceList);
                    });
                }
            },
            reset(){
                this.carClassId = 0;
                this.carClass = [];
                this.price = [];
                this.hoursCount = 0;
                this.checkJobs = {};
                this.checkJobIds = [];
                this.cost = 0;
                this.client = '';
                this.contact = '';
                this.date = '';
            },
            showRegister(){
                // return !this.isDisabledRegister();
                return  this.date.length != 0 &&
                    this.client.length != 0 &&
                    this.contact.length != 0 &&
                    !~this.contact.indexOf('_') &&
                    this.checkJobIds.length != 0;
            },
            isDisabledRegister(){
                return !this.canRegisterAppointment ||
                    this.date.length == 0 ||
                    this.client.length == 0 ||
                    this.contact.length == 0 ||
                    ~this.contact.indexOf('_') ||
                    this.checkJobIds.length == 0;
            },
            returnPriceList(cost, checkJobIds, checkJobs, hoursCount){
                this.cost = cost;
                this.checkJobIds = checkJobIds;
                this.checkJobs = checkJobs;
                this.hoursCount = hoursCount;
            },
            returnDateList(date){
                this.date = date;

            },
            registerAppointment(){
                if(this.isDisabledRegister()) return;

                this.canRegisterAppointment = false;
                axios.post('/appointments/register', {

                    date: this.date,
                    cost: this.cost,
                    checkJobIds: this.checkJobIds,
                    checkJobs: this.checkJobs,
                    client: this.client,
                    contact: this.contact,
                })
                    .then(response => {
                        debugger;
                        this.reset();
                        this.message = "Запись на приём оформлена!";
                        console.log(this.dateList);
                        // this.dateList = response.data;
                        this.$set(this, 'dateList', response.data);
                        console.log(this.dateList);
                        this.canRegisterAppointment = true;

                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
                this.message = "Оформляем запись на приём...";

            }
        }
    }
</script>

<style lang="scss" scoped>
    /*.justify-content-evenly {*/
    /*    justify-content: evenly !important;*/
    /*}*/
    /*.tab{*/
    /*    height: 10%;*/
    /*}*/
    /*.tab {*/
    /*    min-width: 88px;*/
    /*    min-height: 36px;*/
    /*    margin: 6px 8px;*/
    /*    padding: 0 16px;*/
    /*    display: inline-block;*/
    /*    position: relative;*/
    /*    overflow: hidden;*/
    /*    -webkit-user-select: none;*/
    /*    -moz-user-select: none;*/
    /*    -ms-user-select: none;*/
    /*    user-select: none;*/
    /*    cursor: pointer;*/
    /*    background: none;*/
    /*    border: 0;*/
    /*    border-radius: 2px;*/
    /*    transition: all .4s cubic-bezier(.25,.8,.25,1);*/
    /*    color: currentColor;*/
    /*    font-family: inherit;*/
    /*    font-size: 14px;*/
    /*    font-style: inherit;*/
    /*    font-variant: inherit;*/
    /*    font-weight: 500;*/
    /*    letter-spacing: inherit;*/
    /*    line-height: 36px;*/
    /*    text-align: center;*/
    /*    text-transform: uppercase;*/
    /*    text-decoration: none;*/
    /*    vertical-align: top;*/
    /*    white-space: nowrap;*/
    /*}*/
</style>

