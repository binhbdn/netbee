<template>    
    <FullCalendar :locale="viLocale" :header="calHeader" @eventClick="eventClick"  defaultView="dayGridMonth"
   :plugins="calendarPlugins" :events="events"/>    
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import listPlugin from '@fullcalendar/list'
    import viLocale from '@fullcalendar/core/locales/vi'    

    export default {
        name: 'full-calendar',       
        components: {
            FullCalendar           
        },
        data() {            
            return {
                loading: true,
                viLocale: viLocale,
                events: [],
                calendarPlugins: [ dayGridPlugin,listPlugin ],
                calHeader:{
                    left:   'title',
                    center: '',
                    right:  'dayGridMonth,listMonth,today prev,next'
                }
            }
        },
        methods: {      
            eventClick(infomation) {                
                let info = {};
                let exinfo = infomation.event.extendedProps;
                console.log(exinfo);
                info.start = infomation.event.start;
                info.title = infomation.event.title; 
                var h = new Date(info.start);                        
                this.$swal({
                    title:'<p style="font-size: 20px;line-height: 2.5rem;">'+info.title+'</p>',
                    html:'<div class="row">'
                    +'<div class="col-md-4">'
                    +'<p style="text-align: right;"><b>Thời gian:</b></p>'
                    +'</div>'
                    +'<div class="col-md-8">'                   
                    +'<p style="text-align: left;">'+h+'</p>'
                    +'</div>'
                    +'</div >'
                    +'<div class="row">'
                    +'<div class="col-md-4">'
                    +'<p style="text-align: right;"><b>Công ty:</b></p>'
                    +'</div>'
                    +'<div class="col-md-8">'
                    +'<p style="text-align: left;">'+exinfo.name+'</p>'
                    +'</div>'
                    +'</div >'
                    +'<div class="row">'
                    +'<div class="col-md-4">'
                    +'<p style="text-align: right;"><b>Địa điểm:</b></p>'
                    +'</div>'
                    +'<div class="col-md-8">'
                    +'<p style="text-align: left;">'+exinfo.address+'</p>'
                    +'</div>'
                    +'</div >'
                    +'<div class="row">'
                    +'<div class="col-md-4">'
                    +'<p style="text-align: right;"><b>Số điện thoại:</b></p>'
                    +'</div>'
                    +'<div class="col-md-8">'
                    +'<p style="text-align: left;">'+exinfo.phone+'</p>'
                    +'</div>'
                    +'</div >'
                    +'<div class="row">'
                    +'<div class="col-md-4">'
                    +'<p style="text-align: right;"><b>Email:</b></p>'
                    +'</div>'
                    +'<div class="col-md-8">'
                    +'<p style="text-align: left;">'+exinfo.email+'</p>'
                    +'</div>'
                    +'</div >',
                    type: 'success',
                    showCancelButton: true,
                    showConfirmButton: false,                     
                    cancelButtonColor: '#d33',                    
                    cancelButtonText: 'Đóng'
                });
            },     
            fetchdata(){
                this.$axios.get('lichphongvan/fullCalendar')
                .then(response => {                                                                               
                    this.events = response.data;              
                    console.log(this.events); 
                 })
                 .catch(error => {
                    console.log(error.response);
                });    
            }
        },        
        mounted() {             
            this.fetchdata();         
        }
    }
</script>
<style src="../node_modules/@fullcalendar/core/main.css">    
</style>
<style src="../node_modules/@fullcalendar/list/main.css">    
</style>
<style>
.fc-content{
    color: #fff !important;
}
</style>