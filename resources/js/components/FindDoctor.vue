<template>
    <div>
        <div class="card">
            <div class="card-header">Find Doctors</div>
            <div class="card-body">
                <VueDatePicker class="my-VueDatePicker" calendar-class="my-VueDatePicker_calendar" :format="customDate" v-model="time"
                :min-date="new Date(Date.now() - 86400000)" :inline=true auto-apply style="--dp-menu-min-width: auto; "></VueDatePicker>
                 <!-- :disabled-dates="disabledDates" -->
            </div>
        </div>
        
<!-- {{ time }} -->
        <div class="card">
            <div class="card-header">Doctors</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Expertise</th>
                            <th>Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(d,index) in doctors">
                            <th scope="row">{{ index+1 }}</th>
                            <td>
                                <img :src="'/images/' + d.doctor.image" width="80">
                            </td>
                            <td>{{ d.doctor.name }}</td>
                            <td>{{ d.doctor.department }}</td>
                            <td>
                                <a :href=" '/new-appointment/' + d.user_id +'/' + d.date ">
                                    <button class="btn btn-success">Book Appointment</button>
                                </a>
                            </td>
                        </tr>
                        <td v-if="doctors.length == 0">No Doctors Available for {{ this.time }}</td>
                    </tbody>
                    
                </table>
                <div class="text-center">
                    <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css';
    
    
    // import datePicker from 'vuejs3-datepicker';
    import PulseLoader from 'vue-spinner/src/PulseLoader.vue'  
    import moment from 'moment';

    export default{
        data(){
            return{
                time: '',
                doctors: [],
                loading: false,
                // disabledDates: {
                //     to:new Date(Date.now() - 86400000)
                // }
            }
        },
        components:{
            VueDatePicker,
            // datePicker,
            PulseLoader
        },
        methods:{
            customDate(date){
                this.loading = true;
                
                this.time = moment(date).format('YYYY-MM-DD');
                axios.post('/api/finddoctors',{date: this.time}).
                then((response)=>{

                    setTimeout(()=>{
                        this.doctors = response.data
                        this.loading=false
                    },2000)
                    
                }).catch((error)=>{alert('error')})
            }
        },
        mounted(){
            this.loading=true
            axios.get('/api/doctors/today').then((response)=>{
                this.doctors = response.data
                this.loading=false
            })
        }
    }

    
</script>

<!-- <style scoped>
    .my-VueDatePicker ::v-deep(.my-VueDatePicker_calendar){
        --dp-menu-min-width: 1000px; 
        height: auto;
    }
</style> -->