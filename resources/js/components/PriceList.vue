<template>
    <div>
        <div class="card" v-for="service_type in price.service_types">
            <div class="card-header">{{service_type.name}}</div>
            <div  class="card-body" v-for="job in service_type.jobs">
                <div data-entity="job" :data-id="job.id">
                    <input type="checkbox">
                    {{job.name}} = {{job.price}} $
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: [
            'price'
        ],
    }
</script>
