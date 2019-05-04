<template>
    <div>
        <div class="card" v-for="service_type in price.service_types">
            <div class="card-header">{{service_type.name}}</div>
            <div  class="card-body" v-for="job in service_type.jobs">
                <div data-entity="job"
                     :class="{active: isChecked(job.id)}"
                     :data-id="job.id"
                     @click="checkJob(job)"
                >
                    {{job.name}} = {{job.price}} $
                </div>
            </div>
        </div>
        <div>{{totalPrice}} $</div>
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
                totalPrice: 0,
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
                    this.totalPrice += job.price;
                } else {
                    this.checkJobIds.splice(index, 1);
                    this.totalPrice -= job.price;
                }
                // console.log(this.checkJobIds);
            },
            isChecked(jobId){
            }
        },
    }
</script>

<style scoped>
    .active {
        background: gray;
    }
</style>
