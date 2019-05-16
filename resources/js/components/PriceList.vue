<template>
    <div>

        <swiper :options="swiperOption">
            <swiper-slide class="text">
        <div class="content">
            <div class="mt-4 card" v-for="service_type in price.service_types">
                <div class="card-header">{{service_type.name}}</div>
                <div  class="pointer card-body"
                      v-for="job in service_type.jobs"
                      :class="{selected: isChecked(job.id)}"
                      :data-id="job.id"
                      @click="checkJob(job)"
                >
                    {{job.name}} = {{job.price}} ₽
                </div>
            </div>
        </div>
            </swiper-slide>
            <div class="swiper-scrollbar" slot="scrollbar"></div>
        </swiper>

    </div>
</template>

<script>
    export default {
        props: [
            'price'
        ],
        data(){
            return{
                jobs: {},
                checkJobs: {},
                checkJobIds: [],
                cost: 0,
                swiperOption: {
                    direction: 'vertical',
                    slidesPerView: 'auto',
                    freeMode: true,
                    scrollbar: {
                        el: '.swiper-scrollbar'
                    },
                    mousewheel: true
                }
            }
        },
        methods: {
            checkJob(job){
                let jobId = job.id;
                if(this.checkJobs[jobId]){
                    delete this.checkJobs[jobId];
                    // this.checkJobs[jobId] = undefined;
                }else{
                    this.checkJobs[jobId] = job;
                }
                let index = this.checkJobIds.indexOf(jobId);
                if (index === -1) {
                    this.checkJobIds.push(jobId);
                    this.cost += job.price;
                } else {
                    this.checkJobIds.splice(index, 1);
                    this.cost -= job.price;
                }
                // console.log(this.checkJobIds);
                this.$emit('return', this.cost, this.checkJobIds, this.checkJobs);
            },
            isChecked(jobId){
                return this.checkJobIds.indexOf(jobId) !== -1
            },
            isChecked(jobId){
                return this.checkJobIds.indexOf(jobId) !== -1
            }
        },
    }
</script>

<style lang="scss" scoped>
    .selected {
        background: #545b62;
        color: white;
        border: lightgray 1px;
    }
    .swiper-container {
        // TODO height auto from props
        height: 414px;
    }
    .swiper-slide.text {
        font-size: 18px!important;
        text-align: left!important;
        height: auto;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0 30px;
        > .content {
            > .title {
                margin: 0;
                text-align: center;
                margin-bottom: .75em;
            }
            > p,
            blockquote {
                line-height: 2;
                text-indent: 2em;
            }
            blockquote {
                background-color: #ddd;
                margin-left: 2em;
            }
        }
    }
</style>
