<template>
    <FullCalendar :locale="viLocale" :header="calHeader" @eventClick="eventClick"  defaultView="dayGridMonth"
   :plugins="calendarPlugins" :events="events" />
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