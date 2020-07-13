<template>    
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">    
            <div class="content-body">
                <section id="News"> 
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body card-dashboard" style="padding: 0px !important">
                                    <div class="main-body">
                                        <div class="title-main">
                                            <h3>Thông báo</h3>
                                        </div>
                                        <div class="list-data">
                                            <a :style="notification.status_notification ? '' : 'background: #E5E7E9'" class="d-flex justify-content-between border-botom" @click="updateStatus(notification.id_notification)" :href="`${notification.url}`" v-for="(notification,indexNotification) in notifications" :key="indexNotification">
                                                <div class="media d-flex align-items-start data-notification">
                                                    <div class="media-left">
                                                        <img src="/assets/img/logo.png" width="70">
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="notification-text" style="padding: 15px;padding-bottom: 3px;margin-bottom: 0px;">{{ notification.content }}</p>
                                                        <p style="padding-left: 15px;font-size: 13px;">{{notification.created_at}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                                <infinite-loading
                                                    v-if="notifications.length"
                                                    spinner="bubbles"
                                                    @infinite="infiniteScroll" style=" width:100%"
                                                >
                                                <div slot="no-more" style="font-size:15px; font-style: italic;display: none;"></div>    
                                                <div slot="no-results" style="font-size:15px; font-style: italic"></div>
                                            </infinite-loading>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>  
</template>

<script>       
    import moment from 'moment'    
    export default {
        name: 'Notification',
        layout: 'admin',
       
        data(){
            return {
                notifications: [],
                page:1
            }
        },        
        components:{
            
        },
        methods: {
            revertTime(time) {
                return moment(time).fromNow(true);
            },
            infiniteScroll: function($state) {
                setTimeout(() => {
                    this.page++
                    this.$axios
                    .get('/getNotification?page='+ this.page)
                    .then((response) => {
                        if (response.data.data.notifications.data.length > 1) {
                            response.data.data.notifications.data.forEach((item) => this.notifications.push(item))
                            $state.loaded()
                        } else {
                            $state.complete()
                        }
                    })
                    .catch((err) => {
                        console.log(err)
                    })
                }, 500)
            },
            updateStatus(id) {
                this.$axios.$post('readNotification',{id_notification: id}).then((response) => {
                })
            },
            fetchdata :function(){
                try {
                    this.$axios.$get('getNotification?page='+this.page)
                    .then(response => {                                                          
                        this.notifications = response.data.notifications.data
                        console.log(this.notifications)
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
                }
                catch (error) {
                    this.$swal(
                        'Lỗi!',
                        'Lỗi dữ liệu!',
                        'error')
                }            
             }
        },        
        mounted() {             
            this.fetchdata()
        }
    };
</script>
<style scoped>
    .border-botom {
        border-bottom: 1px solid #d8d8d8;
    }
    .data-notification {
        padding: 10px;
    }
    .main-body {
        padding: 15px;
    }
    .list-data {
         background-color: #F2F3F4;
         box-shadow: 0 1px 5px 0 rgba(0, 0, 0, 0.25)
    }
    .title-main {
        margin-bottom: 15px;
    }
    .title-main h3 {
        position: relative;
        border-bottom: 1px solid #eaeaea;
        padding-left: 0px !important;
        padding-bottom: 7px;
    }
    .title-main h3:before {
        position: absolute;
        background: rgb(255, 183, 1);
        height: 2px;
        content: '';    
        left: 0;
        width: 100px;
        bottom: -2px;
        border-radius: 12px;
    }
    
</style>